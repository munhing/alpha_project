<?php

use Alpha\Repositories\CertificateTypesRepository;

use Alpha\Forms\CertificateTypeForm;

use Alpha\CertificateTypes\RegisterCertificateTypeCommand;
use Alpha\CertificateTypes\UpdateCertificateTypeCommand;

class CertificateTypesController extends \BaseController {

	protected $certificateTypesRepository;
	protected $certificateTypeForm;

	public function __construct(CertificateTypesRepository $certificateTypesRepository, CertificateTypeForm $certificateTypeForm)
	{
		$this->certificateTypesRepository = $certificateTypesRepository;
		$this->certificateTypeForm = $certificateTypeForm;
	}
	/**
	 * Display a listing of the resource.
	 * GET /certificatetypes
	 *
	 * @return Response
	 */
	public function index()
	{
		$certificateTypes = $this->certificateTypesRepository->getAll();
		return View::make('certificates/certificate_type', compact('certificateTypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /certificatetypes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('certificates/certificate_type_create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /certificatetypes
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->certificateTypeForm->validate(Input::all());

		$certificateType = $this->execute(RegisterCertificateTypeCommand::class);

		Flash::success("Certificate Type ".$certificateType->type." has been registered!");

		return Redirect::route('certificates.type');
	}

	/**
	 * Display the specified resource.
	 * GET /certificatetypes/{id}
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
	 * GET /certificatetypes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try
		{
			$certificateType = $this->certificateTypesRepository->getById($id);
			return View::make('certificates/certificate_type_edit', compact('certificateType'));
		}
		catch (Exception $e)
		{
			Flash::error("Type not found!");
			return Redirect::back();
		}	
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /certificatetypes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		//dd($input);
		$this->certificateTypeForm->validateUpdate($input, $input['id']);

		$certificateType = $this->execute(UpdateCertificateTypeCommand::class);

		Flash::success("Certificate Type ".$certificateType->type." has been updated!");

		return Redirect::route('certificates.type');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /certificatetypes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$certificateType = $this->certificateTypesRepository->getById($id);

		if($certificateType->certificates->count() > 0) {

			Flash::error("Certificate Type $certificateType->type is still active and cannot be deleted!");
			return Redirect::back();

		}

		$this->certificateTypesRepository->destroy($certificateType);

		Flash::success("Certificate Type $certificateType->type has been Deleted!");
		return Redirect::route('certificates.type'); 
	
	}

}