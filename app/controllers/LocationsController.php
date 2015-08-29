<?php

use Alpha\Repositories\LocationsRepository;
use Alpha\Repositories\ClientsRepository;

use Alpha\Forms\LocationForm;

use Alpha\Locations\RegisterLocationCommand;
use Alpha\Locations\UpdateLocationCommand;

class LocationsController extends \BaseController {

	protected $locationsRepository;
    protected $clientsRepository;
	protected $locationForm;

	public function __construct(LocationsRepository $locationsRepository, ClientsRepository $clientsRepository, LocationForm $locationForm)
	{
		$this->locationsRepository = $locationsRepository;
        $this->clientsRepository = $clientsRepository;
		$this->locationForm = $locationForm;
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
	public function show($id)
	{
		//
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
        dd();
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

}