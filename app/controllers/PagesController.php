<?php
use Alpha\Repositories\ReportsRepository;
use Alpha\Repositories\CertificatesRepository;

class PagesController extends \BaseController {

	protected $reportsRepo;
	protected $certificatesRepo;

	public function __construct(ReportsRepository $reportsRepo, CertificatesRepository $certificatesRepo)
	{
		$this->reportsRepo = $reportsRepo;
		$this->certificatesRepo = $certificatesRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function home()
	{
		$newReportsCount = $this->reportsRepo->getNewReportsCount();
		$newCertsCount = $this->certificatesRepo->getNewCertificatesCount();
		$expReportsCount = $this->reportsRepo->getExpiringReportsCount();
		$expCertsCount = $this->certificatesRepo->getExpiringCertificatesCount();

		return View::make('pages/home', compact('newReportsCount', 'newCertsCount', 'expReportsCount', 'expCertsCount'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function reporting($type)
	{
		//dd($type);
		//$reporting = $this->reportsRepo->getNewReports(7);
		//$notify = $this->notify();
		$info = explode("_", $type);
		$methodName = str_replace($info[0], "get" . ucwords($info[0]), $info[0]) . ucwords($info[1]);
		$repoName = $info[1] . "Repo";

		//dd($methodName);

		$reporting = $this->{$repoName}->{$methodName}();
		
		//dd($notify['new_reports']->first()->total);

		return View::make('pages/reporting', compact('reporting', 'info'));	
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
