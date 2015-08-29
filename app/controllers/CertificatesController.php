<?php
use Alpha\Repositories\CertificatesRepository;
use Alpha\Repositories\CertificateTypesRepository;
use Alpha\Repositories\ClientsRepository;
use Alpha\Repositories\ItemsRepository;
use Alpha\Repositories\ItemTypesRepository;

use Alpha\Forms\CertificateForm;
use Alpha\Forms\CertificateAddItemsForm;
use Alpha\Forms\ItemForm;

use Alpha\Forms\FormValidationException;

use Alpha\Certificates\RegisterCertificateCommand;
use Alpha\Certificates\UpdateCertificateCommand;

use Alpha\Items\RegisterItemCommand;

class CertificatesController extends \BaseController {

	protected $certificateForm;
	protected $certificateAddItemsForm;
	protected $itemForm;

	protected $certificatesRepository;
	protected $certificateTypesRepository;
	protected $clientsRepository;
	protected $itemsRepository;
	protected $itemTypesRepository;

	public function __construct(CertificatesRepository $certificatesRepository, CertificateTypesRepository $certificateTypesRepository, ClientsRepository $clientsRepository, ItemsRepository $itemsRepository, ItemTypesRepository $itemTypesRepository, CertificateForm $certificateForm, CertificateAddItemsForm $certificateAddItemsForm, ItemForm $itemForm)
	{
		//parent::__construct();
		$this->certificateForm = $certificateForm;
		$this->certificateAddItemsForm = $certificateAddItemsForm;
		$this->itemForm = $itemForm;

		$this->certificatesRepository = $certificatesRepository;
		$this->certificateTypesRepository = $certificateTypesRepository;
		$this->clientsRepository = $clientsRepository;
		$this->itemsRepository = $itemsRepository;
		$this->itemTypesRepository = $itemTypesRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$input = Input::all();
		// //$notify = $this->notify();

		// //$count = 1;
		// if(! isset($input['orderby'])) { $input['orderby'] = 'cert_no'; }

		// if($input['orderby']) {
		// 	$certificates = Certificate::with('client')->selectRaw("*, (`next_inspection`) > (NOW())  AS `status`")
		// 		->orderBy($input['orderby'])->paginate(20);
		// } else {
		// 	$certificates = Certificate::with('client')->selectRaw("*, (`next_inspection`) > (NOW())  AS `status`")->paginate(20);
		// }


	    $sortby = Input::get('sortby');
	    $order = Input::get('order');
	 
	    if (!$sortby || !$order) {
		    $sortby = 'cert_no';
		    $order = 'asc';
	    }

		// $certificates = Certificate::with('client', 'report')->selectRaw("certificates.*, (certificates.next_inspection) > (NOW())  AS `status`")
		//        ->join('clients', 'certificates.client_id', '=', 'clients.id')
		//        ->orderBy($sortby, $order)
		//        ->paginate(20);

		$certificates = $this->certificatesRepository->getAllWithPagination();
		       //dd($certificates->first()->toArray());

		return View::make('certificates/index', compact('certificates', 'input', 'sortby', 'order'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$certificateTypes = $this->certificateTypesRepository->getAll()->lists('type', 'id');
		$clients = $this->clientsRepository->getAllForSelectList();

		return View::make('certificates/create', compact('certificateTypes', 'clients'));		

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//dd(Input::all());

		$this->certificateForm->validate(Input::all());

		$certificate = $this->execute(RegisterCertificateCommand::class);

		Flash::success("Certificate ".$certificate->cert_no." has been registered!");

		return Redirect::route('certificates.show', $certificate->id);

		//$input = Input::all();

		//dd($input);

		// try
		// {
		// 	$this->certificateForm->validate($input);
		// 	$report = $this->certificatesRepository->addCertificate($input);

		// 	Flash::success("Certificate has been successfully Added!");

		// 	return Redirect::route('certificates');
		// 	//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
		// 	//return 'Success!';
		// }
		// catch (FormValidationException $e)
		// {
		// 	return Redirect::back()->withInput()->withErrors($e->getErrors());
		// }

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
			$certificate = $this->certificatesRepository->getByIdWithDetails($id);
			$itemTypes = $this->itemTypesRepository->getAll()->lists('type', 'id');

			return View::make('certificates/show', compact('certificate', 'itemTypes'));
		}
		catch (Exception $e)
		{
			Flash::error("Certificate not found!");
			return Redirect::route('certificates');
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
		$certificate = $this->certificatesRepository->getById($id);

		$certificateTypes = $this->certificateTypesRepository->getAll()->lists('type', 'id');
		$clients = $this->clientsRepository->getAllForSelectList();

		return View::make('certificates/edit', compact('certificate', 'clients', 'certificateTypes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{


		//dd($input);

		$input = Input::all();

		$this->certificateForm->validateUpdate($input, $input['id']);

		$certificate = $this->execute(UpdateCertificateCommand::class);

		Flash::success("Certificate ".$certificate->cert_no." has been updated!");

		return Redirect::route('certificates.show', $certificate->id);

		// try
		// {
		// 	$this->certificateForm->validate($input);
		// 	$certificate = $this->certificatesRepository->updateCertificate($input);

		// 	Flash::success("Certificate has been successfully Updated!");

		// 	return Redirect::route('certificate_show', $certificate->id);
		// 	//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
		// 	//return 'Success!';
		// }
		// catch (FormValidationException $e)
		// {
		// 	return Redirect::back()->withInput()->withErrors($e->getErrors());
		// }	
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
			$c = Certificate::findOrFail($id);
			$c->delete();

			Flash::success("Certificate No: $c->cert_no has been Deleted!");

			return Redirect::route('certificates');
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (Exception $e)
		{
			Flash::error("Unable to delete Certificate No: $c->cert_no.");
			return Redirect::back();
		}	
		
	}

	public function post_remove_file($id)
	{

		$this->certificatesRepository->removeFile($id);

		Flash::success("File has been updated!");

		return Redirect::route('certificates.show', $id);

	}

	public function add_items($id)
	{
		$certificate = $this->certificatesRepository->getById($id);
		$items = $this->itemsRepository->getAllForSelectListByClientId($certificate->client_id);
		$itemTypes = $this->itemTypesRepository->getAll()->lists('type', 'id');

		return View::make('certificates/add_items', compact('certificate', 'items', 'itemTypes'));
	}

	public function post_add_items($id)
	{

		$selectedItems = explode(",", Input::get('selectedItems'));

		//dd($selectedItems);

		try
		{
			$this->certificateAddItemsForm->validate(Input::all());
			$certificate = $this->certificatesRepository->addItems($id, $selectedItems);

			Flash::success("Items successfully associated with this certificate!");

			return Redirect::route('certificates.show', $id);
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors());
		}		

		//return 'Items added to report';
	}	

	public function post_remove_item($id)
	{

		try
		{
			$certificate = $this->certificatesRepository->removeItem($id, Input::get('item_id'));

			Flash::success("Item successfully removed from this Certificate!");

			return Redirect::route('certificates.show', $id);
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors());
		}	

	}

	public function post_create_item($id)
	{

		$input = Input::all();

		$certificate = $this->certificatesRepository->getById($id);

		$input['client_id'] = $certificate->client_id;

		$this->itemForm->validate($input);

		$item = $this->execute(RegisterItemCommand::class, $input);

		$certificate = $this->certificatesRepository->addItems($id, [$item->id]);

		Flash::success("Item ".$item->serial_no." has been registered!");

		return Redirect::route('certificates.show', $id);

	}	
}
