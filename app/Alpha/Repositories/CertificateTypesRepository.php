<?php namespace Alpha\Repositories;

use CertificateType;

class CertificateTypesRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return CertificateType::orderBy('type')->get();
	}

	public function getById($id)
	{
		return CertificateType::findOrFail($id);
	}

	public function save(CertificateType $certificateType)
	{
		return $certificateType->save();
	}

	public function destroy(CertificateType $certificateType)
	{
		return $certificateType->delete();
	}

	public function getAllForSelectList()
	{
		return CertificateType::selectRaw("id, type AS text")->orderBy('text')->get();
	}
		
}