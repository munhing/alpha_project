<?php namespace Alpha\Repositories;

interface ItemsRepository
{
	public function getAll();
	public function getById($id);
	public function addItem($input);
	public function updateItem($input);
	public function search($input);
}