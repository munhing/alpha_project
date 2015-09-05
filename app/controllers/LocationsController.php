<?php

use Alpha\Forms\LocationForm;
use Alpha\Locations\RegisterLocationCommand;
use Alpha\Locations\UpdateLocationCommand;
use Alpha\Repositories\CertificatesRepository;
use Alpha\Repositories\ClientsRepository;
use Alpha\Repositories\ItemsRepository;
use Alpha\Repositories\LocationsRepository;
use Alpha\Repositories\ReportsRepository;

class LocationsController extends \BaseController {

	protected $locationsRepository;
    protected $clientsRepository;
	protected $locationForm;
	protected $reportsRepository;
	protected $certificatesRepository;
	Protected $itemsRepository;

	public function __construct(
		LocationsRepository $locationsRepository, 
		ClientsRepository $clientsRepository, 
		LocationForm $locationForm, 
		ReportsRepository $reportsRepository,
		CertificatesRepository $certificatesRepository,
		ItemsRepository $itemsRepository
	)
	{
		$this->locationsRepository = $locationsRepository;
        $this->clientsRepository = $clientsRepository;
		$this->locationForm = $locationForm;
		$this->reportsRepository = $reportsRepository;
		$this->certificatesRepository = $certificatesRepository;
		$this->itemsRepository = $itemsRepository;
	}
    
	/**
	 * Display a listing of the resource.
	 * GET /locations
	 *
	 * @return Response
	 */
	public function index()
	{
		// dd('Location');
        
		$locations = $this->locationsRepository->getAll();
		return View::make('locations/index', compact('locations'));        
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /locations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// dd('Create Location');
        $clients = $this->clientsRepository->getAllForSelectList();
        
        return View::make('locations/create', compact('clients'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /locations
	 *
	 * @return Response
	 */
	public function store()
	{       
		$this->locationForm->validate(Input::all());

		$location = $this->execute(RegisterLocationCommand::class);

		Flash::success("Location ".$location->location." has been registered!");

		return Redirect::route('locations');
	}

	/**
	 * Display the specified resource.
	 * GET /locations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($location_id)
	{
		$location = $this->locationsRepository->getById($location_id);

		return View::make('locations/show', compact('location'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /locations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        // dd();
		$location = $this->locationsRepository->getById($id);

		$clients = Client::selectRaw("id, name AS text")->orderBy('text')->get();

		return View::make('locations/edit', compact('location', 'clients'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /locations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$input = Input::all();
        
        // dd($input);

		$this->locationForm->validate($input);

		$location = $this->execute(UpdateLocationCommand::class);

		Flash::success("Location ".$location->location." has been updated!");

		return Redirect::route('locations');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /locations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$location = $this->locationsRepository->getById($id);

		if($location->reports->count() > 0 || $location->certificates->count() > 0 || $location->items->count() > 0) {

			Flash::error("Location $location->location is still active and cannot be deleted!");
			return Redirect::back();

		}

		$this->locationsRepository->destroy($location);

		Flash::success("Location $location->location has been Deleted!");
		return Redirect::route('locations');
	}
	
	public function reports($location_id)
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
	    $location = $this->locationsRepository->getById($location_id);
		$reports = $this->reportsRepository->getAllByLocationWithPagination($location_id, 40);

		// dd($reports->toArray());

		return View::make('locations/reports', compact('location', 'reports', 'input', 'count', 'sortby', 'order'));		// dd('Location');
	}

	public function certificates($location_id)
	{
		$input = Input::all();

	    $sortby = Input::get('sortby');
	    $order = Input::get('order');
	 
	    if (!$sortby || !$order) {
		    $sortby = 'cert_no';
		    $order = 'asc';
	    }

		$location = $this->locationsRepository->getById($location_id);
		$certificates = $this->certificatesRepository->getAllByLocationWithPagination($location_id, 40);
		       //dd($certificates->first()->toArray());

		return View::make('locations/certificates', compact('location', 'certificates', 'input', 'sortby', 'order'));       
	}

	public function items($location_id)
	{
	    $sortby = Input::get('sortby');
	    $order = Input::get('order');
	 
	    if (!$sortby || !$order) {
		    $sortby = 'serial_no';
		    $order = 'asc';
	    }

		$location = $this->locationsRepository->getById($location_id);
		$items = $this->itemsRepository->getAllByLocationWithPagination($location_id, 40);

		return View::make('locations/items', compact('location', 'items', 'sortby', 'order'));         
	}	
}