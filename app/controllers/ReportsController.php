<?php
use Alpha\Repositories\ReportsRepository;
use Alpha\Repositories\ReportTypesRepository;
use Alpha\Repositories\ClientsRepository;
use Alpha\Repositories\ItemTypesRepository;
use Alpha\Repositories\ItemsRepository;
use Alpha\Repositories\CertificatesRepository;
use Alpha\Repositories\CertificateTypesRepository;

use Alpha\Forms\ReportForm;
use Alpha\Forms\ReportTypeForm;
use Alpha\Forms\ReportAddItemsForm;
use Alpha\Forms\ReportCreateItemForm;
use Alpha\Forms\ItemForm;
use Alpha\Forms\CertificateForm;

use Alpha\Forms\reportAddCertificatesForm;
use Alpha\Forms\reportCreateCertificateForm;
use Alpha\Forms\FormValidationException;

use Alpha\Reports\RegisterReportCommand;
use Alpha\Reports\UpdateReportCommand;
use Alpha\Certificates\RegisterCertificateCommand;
use Alpha\Reports\RegisterReportTypeCommand;
use Alpha\Reports\UpdateReportTypeCommand;

use Alpha\Items\RegisterItemCommand;

class ReportsController extends \BaseController {

	protected $reportsRepository;
	protected $reportTypesRepository;
	protected $clientsRepository;
	protected $itemTypesRepository;
	protected $itemsRepository;
	protected $certificatesRepository;
	protected $certificateTypesRepository;

	protected $reportForm;
	protected $reportTypeForm;
	protected $reportAddItemsForm;
	protected $reportCreateItemForm;
	protected $reportCreateCertificateForm;
	protected $certificateForm;

	protected $itemForm;	

	public function __construct(ReportsRepository $reportsRepository, ReportTypesRepository $reportTypesRepository, ClientsRepository $clientsRepository, ItemTypesRepository $itemTypesRepository, ItemsRepository $itemsRepository, CertificatesRepository $certificatesRepository, CertificateTypesRepository $certificateTypesRepository,ReportForm $reportForm, ReportTypeForm $reportTypeForm, ReportAddItemsForm $reportAddItemsForm, ReportCreateItemForm $reportCreateItemForm, ItemForm $itemForm,ReportAddCertificatesForm $reportAddCertificatesForm, ReportCreateCertificateForm $reportCreateCertificateForm, CertificateForm $certificateForm)
	{
		$this->reportsRepository = $reportsRepository;
		$this->reportTypesRepository = $reportTypesRepository;
		$this->clientsRepository = $clientsRepository;
		$this->itemTypesRepository = $itemTypesRepository;
		$this->itemsRepository = $itemsRepository;
		$this->certificatesRepository = $certificatesRepository;
		$this->certificateTypesRepository = $certificateTypesRepository;

		$this->reportForm = $reportForm;
		$this->reportTypeForm = $reportTypeForm;
		$this->reportAddItemsForm = $reportAddItemsForm;
		$this->reportCreateItemForm = $reportCreateItemForm;
		$this->reportAddCertificatesForm = $reportAddCertificatesForm;
		$this->reportCreateCertificateForm = $reportCreateCertificateForm;
		$this->certificateForm = $certificateForm;

		$this->itemForm = $itemForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	    $sortby = Input::get('sortby');
	    $order = Input::get('order');
	 
	    if (!$sortby || !$order) {
		    $sortby = 'report_no';
		    $order = 'asc';
	    }

		// $reports = Report::with('client')->selectRaw("reports.*, clients.name, (`next_inspection`) > (NOW())  AS `status`")
		//        ->join('clients', 'reports.client_id', '=', 'clients.id')
		//        ->orderBy($sortby, $order)
		//        ->paginate(20);	    	

		$reports = $this->reportsRepository->getAllWithPagination(40);	

		//return View::make('items/index', compact('items', 'sortby', 'order'));

		//dd($reports);
		return View::make('reports/index', compact('reports', 'input', 'count', 'sortby', 'order'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//$types = Type::lists('type', 'type'); //this one may need to be injected from the repository

		$types = $this->reportTypesRepository->getAll()->lists('type', 'type');
		//$clients = Client::lists('name', 'id'); //this one may need to be injected from the repository
		//$clients = Client::selectRaw("id, name AS text")->orderBy('text')->get();

		$clients = $this->clientsRepository->getAllForSelectList();

		return View::make('reports/create', compact('types', 'clients'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$this->reportForm->validate(Input::all());

		$report = $this->execute(RegisterReportCommand::class);

		Flash::success("Report ".$report->report_no." has been registered!");

		return Redirect::route('reports.show', $report->id);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
			$report = $this->reportsRepository->getByIdWithDetails($id);
			$certificateTypes = $this->certificateTypesRepository->getAll()->lists('type', 'id');
			$itemTypes = $this->itemTypesRepository->getAll()->lists('type', 'id');

			return View::make('reports/show', compact('report', 'itemTypes', 'certificateTypes'));
		}
		catch (Exception $e)
		{
			Flash::error("Report not found!");
			return Redirect::route('reports');
		}			

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$report = $this->reportsRepository->getById($id);
		$types = ReportType::lists('type', 'type'); //this one may need to be injected from the repository
		//$clients = Client::lists('name', 'id'); //this one may need to be injected from the repository

		$clients = Client::selectRaw("id, name AS text")->orderBy('text')->get();

		//dd($report->date->format('d/m/Y'));

		return View::make('reports/edit', compact('report', 'types', 'clients'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{

		$input = Input::all();

		$this->reportForm->validateUpdate($input, $input['id']);

		$report = $this->execute(UpdateReportCommand::class);

		Flash::success("Report ".$report->report_no." has been updated!");

		return Redirect::route('reports.show', $report->id);
	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		try
		{
			$r = Report::with('certificates')->findOrFail($id);
			//var_dump($r->toArray());
			$r->delete();

			foreach($r->certificates as $cert) {
				$c = Certificate::findOrFail($cert->id);
				$c->report_id = 0;
				$c->save();
				//var_dump($c->toArray());
			}

			//die();

			Flash::success("Report No: $r->report_no has been Deleted!");
			return Redirect::route('reports');
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (Exception $e)
		{
			Flash::error("Unable to delete Report No: $r->report_no.");
			return Redirect::back();
		}	

	}

	public function post_remove_file($id)
	{

		$this->reportsRepository->removeFile($id);

		Flash::success("File has been updated!");

		return Redirect::route('reports.show', $id);

	}

	public function add_items($id)
	{
		$report = $this->reportsRepository->getById($id);


		$items = $this->itemsRepository->getAllForSelectListByClientId($report->client_id);

		//dd($report->client_id);

		$itemTypes = $this->itemTypesRepository->getAll()->lists('type', 'id');

		return View::make('reports/add_items', compact('report', 'items', 'itemTypes'));
	}

	public function post_add_items($id)
	{

		$selectedItems = explode(",", Input::get('selectedItems'));

		// associate the selected items with the report id

		try
		{
			$this->reportAddItemsForm->validate(Input::all());
			$report = $this->reportsRepository->addItems($id, $selectedItems);

			Flash::success("Items successfully associated with this report!");

			return Redirect::route('reports.show', $id);
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors());
		}		

		//return 'Items added to report';
	}

	public function post_create_item($id)
	{

		$input = Input::all();

		$report = $this->reportsRepository->getById($id);

		$input['client_id'] = $report->client_id;

		$this->itemForm->validate(Input::all());

		$item = $this->execute(RegisterItemCommand::class, $input);

		$report = $this->reportsRepository->addItems($id, [$item->id]);

		Flash::success("Item ".$item->serial_no." has been registered!");

		return Redirect::route('reports.show', $id);

	}

	public function add_certificates($id)
	{

		$report = $this->reportsRepository->getById($id);
		$certificates = $this->certificatesRepository->getAllForSelectListByClientId($report->client_id);
		$certificateTypes = $this->certificateTypesRepository->getAll()->lists('type', 'id');

		return View::make('reports/add_certificates', compact('report', 'certificates', 'certificateTypes'));
	}

	public function post_add_certificates($id)
	{
		//dd(Input::all());

		$selectedCerts = explode(",", Input::get('selectedCerts'));
		// associate the selected items with the report id
		//dd($selectedCerts);

		$this->reportAddCertificatesForm->validate(Input::all());

		$report = $this->reportsRepository->addCertificates($id, $selectedCerts);

		Flash::success("Certificates successfully associated with this report!");

		return Redirect::route('reports.show', $id);
		//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
		//return 'Success!';


	}

	public function post_create_certificate($id)
	{

		$input = Input::all();

		$report = $this->reportsRepository->getById($id);

		$input['client_id'] = $report->client_id;

		$this->certificateForm->validate(Input::all());

		//dd($input);

		$certificate = $this->execute(RegisterCertificateCommand::class, $input);

		$this->reportsRepository->addCertificates($id, [$certificate->id]);

		Flash::success("Certificate ".$certificate->cert_no." has been registered!");

		return Redirect::route('reports.show', $id);
		
	}

	public function post_remove_item($id)
	{

		try
		{
			$report = $this->reportsRepository->removeItem($id, Input::get('item_id'));

			Flash::success("Item successfully removed from this report!");

			return Redirect::route('reports.show', $id);
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors());
		}	

	}

	public function post_remove_certificate($id)
	{
		//dd($id);
		try
		{
			$report = $this->reportsRepository->removeCertificate($id, Input::get('certificate_id'));

			Flash::success("Certificate successfully removed from this report!");

			return Redirect::route('reports.show', $id);
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors());
		}
	}	

	public function report_type()
	{
		$reportType = ReportType::orderBy('type')->get();
		return View::make('reports/report_type', compact('reportType'));
	}

	public function report_type_create()
	{
		//$reportType = Type::orderBy('type')->get();
		return View::make('reports/report_type_create');
	}

	public function post_report_type_create()
	{

		$this->reportTypeForm->validate(Input::all());

		$type = $this->execute(RegisterReportTypeCommand::class);

		Flash::success("Report Type ".$type->type." has been registered!");

		return Redirect::route('reports.type');

	}	

	public function report_type_edit($id)
	{
		try
		{
			$reportType = ReportType::findOrFail($id);
			return View::make('reports/report_type_edit', compact('reportType'));
		}
		catch (Exception $e)
		{
			Flash::error("Type not found!");
			return Redirect::back();
		}	
	}	

	public function report_type_update($id)
	{

		$input = Input::all();

		$this->reportTypeForm->validateUpdate($input, $input['id']);
		
		$reportType = $this->execute(UpdateReportTypeCommand::class);

		Flash::success("Report Type ".$reportType->type." has been updated!");

		return Redirect::route('reports.type');

		//$input = Input::all();

	}

	public function report_type_delete($id)
	{

		try
		{
			$type = ReportType::with('reports')->findOrFail($id);
			//dd($type->reports()->count());

			if($type->reports()->count() > 0) {
				Flash::error("Report Type $type->type is still active and cannot be deleted!");
				return Redirect::back();				
			} else {
				$type->delete();
				Flash::success("Report Type $type->type has been Deleted!");
				return Redirect::route('reports.type');				
			}
			
		}
		catch (Exception $e)
		{
			Flash::error("Unable to delete Report Type.");
			return Redirect::back();
		}	

	}		
}
