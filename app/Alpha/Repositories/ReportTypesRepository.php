<?php namespace Alpha\Repositories;

use ReportType;

class ReportTypesRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return ReportType::all();
	}

	public function save(ReportType $reportType)
	{
		return $reportType->save();
	}
}