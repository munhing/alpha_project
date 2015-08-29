<?php namespace Alpha\Repositories;

interface CertificatesRepository
{
	public function getAll();
	public function getById($id);
	public function addCertificate($input);
	public function updateCertificate($input);
	public function search($input);
}