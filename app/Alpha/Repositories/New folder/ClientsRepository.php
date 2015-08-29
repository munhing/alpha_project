<?php namespace Alpha\Repositories;

interface ClientsRepository
{
	public function getAll();
	public function getById($id);
	public function addClient($input);
	public function updateClient($input);
	public function search($input);
}