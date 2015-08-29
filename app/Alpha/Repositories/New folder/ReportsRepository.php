<?php namespace Alpha\Repositories;

interface ReportsRepository
{
	public function getAll();
	public function getById($id);
	public function addReport($input);
	public function updateReport($input);
	public function search($input);
	public function addItems($id, $items);
}