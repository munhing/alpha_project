<?php

use Alpha\Repositories\ClientsRepository;
use Alpha\Forms\ClientForm;
use Alpha\Forms\FormValidationException;

use Alpha\Clients\RegisterClientCommand;
use Alpha\Clients\UpdateClientCommand;

class ClientsController extends \BaseController {

	protected $clientsRepository;
	protected $clientForm;

	public function __construct(ClientsRepository $clientsRepository, ClientForm $clientForm)
	{
		$this->clientsRepository = $clientsRepository;
		$this->clientForm = $clientForm;
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
		    $sortby = 'name';
		    $order = 'asc';
	    }

	    $clients = $this->clientsRepository->getAllWithPagination();
		return View::make('clients/index', compact('clients', 'sortby', 'order'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('clients/create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$this->clientForm->validate(Input::all());

		$client = $this->execute(RegisterClientCommand::class);

		Flash::success("Client ".$client->name." has been registered!");

		return Redirect::route('clients.show', $client->id);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = $this->clientsRepository->getById($id);

		return View::make('clients/show', compact('client'));
	}

	public function items_list($id)
	{
		$client = $this->clientsRepository->getAllItems($id);

		return View::make('clients/items_list', compact('client'));
	}

	public function reports_list($id)
	{
		$client = $this->clientsRepository->getAllReports($id);

		return View::make('clients/reports_list', compact('client'));
	}

	public function certificates_list($id)
	{
		$client = $this->clientsRepository->getAllCertificates($id);

		return View::make('clients/certificates_list', compact('client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = $this->clientsRepository->getById($id);
		return View::make('clients/edit', compact('client'));
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

		$this->clientForm->validateUpdate($input, $input['id']);

		$client = $this->execute(UpdateClientCommand::class);

		Flash::success("Client ".$client->name." has been updated!");

		return Redirect::route('clients.show', $client->id);
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
			$c = Client::with('reports', 'items', 'certificates')->findOrFail($id);

			//dd($c->certificates()->count());

			if($c->reports()->count() == 0 && $c->items()->count() == 0 && $c->certificates()->count() == 0)
			{
				//dd('Delete this report');
				$c->delete();

				Flash::success("Client $c->name has been Deleted!");
				return Redirect::route('clients');	

			} else {

				Flash::error("Client $c->name is still active and cannot be deleted! Make sure you have deleted all reports, certificates and items that is asociated with this client.");
				return Redirect::back();

			}

		}
		catch (Exception $e)
		{
			Flash::error("There was an error!");
			return Redirect::back();
		}	

	}


}
