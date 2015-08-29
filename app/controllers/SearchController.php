<?php

use Alpha\Repositories\ReportsRepository;
use Alpha\Repositories\ItemsRepository;
use Alpha\Repositories\CertificatesRepository;
use Alpha\Repositories\ClientsRepository;

class SearchController extends \BaseController {

	protected $reportsRepo;
	protected $itemsRepo;
	protected $certsRepo;
	protected $clientsRepo;


	function __construct(ReportsRepository $reportsRepo, ItemsRepository $itemsRepo,  CertificatesRepository $certsRepo, ClientsRepository $clientsRepo)
	{
		$this->reportsRepo = $reportsRepo;
		$this->itemsRepo = $itemsRepo;
		$this->certsRepo = $certsRepo;
		$this->clientsRepo = $clientsRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$input = Input::all();
		//dd($input);
		if(! array_key_exists("s_type",$input)) 
		{
			$input['s_type'] = 'report';
		}

		$repoClass = $this->getRepoClass($input['s_type']);

		$searchResults = $this->$repoClass->search($input['search']);

		//dd($this->getRepoClass($input['s_type']));

		//$searchResults = $this->reportsRepo->search($input['search']);

		//dd($searchResults);
		return View::make('search/index', compact('input', 'searchResults'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	public function getRepoClass($type)
	{
		if($type == 'report') {
			return 'reportsRepo';
		} elseif ($type == 'item') {
			return 'itemsRepo';
		} elseif ($type == 'cert') {
			return 'certsRepo';
		} elseif ($type == 'client') {
			return 'clientsRepo';
		}
	}


}
