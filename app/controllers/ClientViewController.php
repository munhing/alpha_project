<?php

use Alpha\Repositories\ReportsRepository;
use Alpha\Repositories\CertificatesRepository;
use Alpha\Repositories\UsersRepository;
use Alpha\Repositories\ItemsRepository;

class ClientViewController extends \BaseController {

	protected $reportsRepo;
	protected $certificatesRepo;
	protected $itemsRepo;
	protected $usersRepo;

	public function __construct(ReportsRepository $reportsRepo, CertificatesRepository $certificatesRepo, UsersRepository $usersRepo, ItemsRepository $itemsRepo)
	{
		$this->reportsRepo = $reportsRepo;
		$this->certificatesRepo = $certificatesRepo;
		$this->itemsRepo = $itemsRepo;
		$this->usersRepo = $usersRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function home()
	{
		$clientList = $this->getClientList();

		$newReportsCount = Report::selectRaw("COUNT(*) AS total")
						->whereRaw("(TO_DAYS(NOW()) - TO_DAYS(`date`)) BETWEEN 0 AND 7")
						->whereIn("client_id", $clientList)
                     	->get();

		$expReportsCount = Report::selectRaw("COUNT(*) AS total")
						->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND 60")
						->whereIn("client_id", $clientList)
                     	->get();

		$newCertsCount = Certificate::selectRaw("COUNT(*) AS total")
						->whereRaw("(TO_DAYS(NOW()) - TO_DAYS(`date`)) BETWEEN 0 AND 7")
						->whereIn("client_id", $clientList)
                     	->get();

		$expCertsCount = Certificate::selectRaw("COUNT(*) AS total")
						->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND 60")
						->whereIn("client_id", $clientList)
                     	->get();

		//dd($getExpiringReportsCount->first()->total);                

		return View::make('clientviews/home', compact('newReportsCount', 'newCertsCount', 'expReportsCount', 'expCertsCount'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function reporting($type)
	{
		$clientList = $this->getClientList();
		$info = explode("_", $type);
		$methodName = str_replace($info[0], "get" . ucwords($info[0]), $info[0]) . ucwords($info[1]);
		$repoName = $info[1] . "Repo";

		
		$reporting = $this->{$repoName}->{$methodName}($clientList);
		//dd($reporting);
		//dd($notify['new_reports']->first()->total);

		return View::make('clientviews/reporting', compact('reporting', 'info'));	

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function reports()
	{
		$clientList = $this->getClientList();
	
		$reports = $this->reportsRepo->getAllForClient($clientList);

		return View::make('clientviews/reports', compact('reports'));
	}

	public function certificates()
	{
		$clientList = $this->getClientList();
	
		$certificates = $this->certificatesRepo->getAllForClient($clientList);
		
		return View::make('clientviews/certificates', compact('certificates'));
	}

	public function items()
	{
		$clientList = $this->getClientList();
	
		$items = $this->itemsRepo->getAllForClient($clientList);

		return View::make('clientviews/items', compact('items'));
	}	

	public function users()
	{

		$users = User::with('roles')
						->where('client_id', '=', Auth::user()->client->id)
	                 	->get();    	


		//dd($reports->toArray());
		return View::make('clientviews/users', compact('users'));
	}

	public function report_show($id)
	{

		$report = Report::with([
			'client', 'reportType',
			'items' => function($query){
				$query->orderBy('serial_no', 'asc');
			},
			'certificates' => function($query){
				$query->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`")->orderBy('date', 'asc');
			}
		])->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`")->find($id);

		$itemType = ItemType::lists('type', 'id');

		//$reports = Report::with('client')->selectRaw("*, (`next_inspection`) > (NOW())  AS `status`")->find($id);    	


		//dd($report);
		return View::make('clientviews/report_show', compact('report', 'itemType'));
	}

	public function certificate_show($id)
	{

		$certificate = Certificate::with([
			'client', 'certificateType',
			'items' => function($query){
				$query->orderBy('serial_no', 'asc');
			},			
			'reports' => function($query){
				$query->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`")->orderBy('date', 'asc');
			}
		])->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`")->find($id);

		return View::make('clientviews/certificate_show', compact('certificate'));
	}

	public function item_show($id)
	{

		$item = Item::with([
			'client', 'itemType',
			'reports' => function($query){
				$query->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`");
			},
			'certificates' => function($query){
				$query->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`");
			},			
		])->find($id);

		return View::make('clientviews/item_show', compact('item'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function search()
	{
		//dd(Input::all());
		$search = Input::get('search');
		
		if (strlen($search) < 3) {
			Flash::error('Please enter minimum 3 characters in the search box.');
			return Redirect::route('client_home');
		}
		
		$clientList = $this->getClientList();

		$reports = $this->reportsRepo->getSearchResultsForClient($search, $clientList);

		$certs = $this->certificatesRepo->getSearchResultsForClient($search, $clientList);	

		$items = $this->itemsRepo->getSearchResultsForClient($search, $clientList);		
		
		foreach($certs as $cert)
		{
			$reports->add($cert);
		}

		foreach($items as $item)
		{
			$reports->add($item);
		}		

		$searchResults = $reports;

		//dd($searchResults);

		return View::make('clientviews/search', compact('searchResults', 'search'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function profile()
	{	
		$user = User::find(Auth::user()->id);

		return View::make('clientviews/profile', compact('user'));
	}

	public function getClientList()
	{
		$user = $this->usersRepo->getById(Auth::user()->id);
		
		$clientList = $user->clients->lists('id');
		$clientList[] = $user->client->id;
		
		return $clientList;
	}	

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
