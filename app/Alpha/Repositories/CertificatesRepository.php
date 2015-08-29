<?php namespace Alpha\Repositories;

use Certificate;
use Item;
use Carbon\Carbon;

class CertificatesRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return Certificate::with('reports', 'items', 'client', 'certificateType')->get();
	}

	public function save(Certificate $certificate)
	{
		return $certificate->save();
	}

	public function getAllWithPagination($row = 20)
	{
		return Certificate::with('reports', 'items', 'client', 'certificateType')->selectRaw("certificates.*, (certificates.next_inspection) > (NOW())  AS `status`")
		       ->join('clients', 'certificates.client_id', '=', 'clients.id')
		       ->orderBy('certificates.cert_no')
		       ->paginate($row);
	}

	public function getById($id)	
	{
		return Certificate::find($id);
	}

	public function getByIdWithDetails($id)
	{
		return Certificate::with([
					'client', 
					'reports' => function($query){
							$query->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`");
						},
					'items' => function($query){
							$query->orderBy('serial_no');
						},
					'certificateType'
				])->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`")->findOrFail($id);
	}

	public function getAllForSelectListByClientId($client_id)
	{
		return Certificate::selectRaw("id, cert_no AS text")->where('client_id', '=', $client_id)->orderBy('text')->get();
	}

	public function removeFile($id)
	{
		$certificate = $this->getById($id);
		$certificate->filename = '';
		$this->save($certificate);
	}

	public function addItems($id, $items)
	{
		//dd($items);
		//$listedItems = Certificate::find($id)->items()->lists('serial_no', 'id');
		$listedItems = Certificate::find($id)->items()->select('items.*')->lists('serial_no','id');

		//dd($listedItems);

		if($items) {
			foreach ($items as $item) {

				if (!array_key_exists($item, $listedItems)) {

					$i = Item::find($item);
					$i->certificates()->attach($id);

				}
			}
		}
		//return Report::where('report_no', 'LIKE', '%' . $input . '%')->orderBy('report_no')->get();
	}

	public function removeItem($id, $item_id)
	{
		$i = Item::find($item_id);
		$i->certificates()->detach($id);
	}

	public function addCertificate($input)
	{
		$mysql_date = $this->mysqlDate($input['date']);

		$certificate = new Certificate;
		$certificate->cert_no = $input['cert_no'];
		$certificate->report_id = $input['report_id'];
		$certificate->client_id = $input['client_id'];
		$certificate->date = $mysql_date;
		$certificate->validity = $input['validity'];
		$certificate->next_inspection = $this->dueDate($mysql_date, $input['validity']);

		if($input['file'])
		{
			$file = $input['file'];

			$file = $file->move(public_path(). '/certificate_files/', time() . '_' .  $file->getClientOriginalName());

			$certificate->filename = $file->getFilename();
		}
		
		$certificate->save();

		return $certificate;
	}

	public function updateCertificate($input)
	{
		$mysql_date = $this->mysqlDate($input['date']);
		
		$certificate = $this->getById($input['id']);
		$certificate->cert_no = $input['cert_no'];
		$certificate->report_id = $input['report_id'];
		$certificate->client_id = $input['client_id'];
		$certificate->date = $mysql_date;
		$certificate->validity = $input['validity'];
		$certificate->next_inspection = $this->dueDate($mysql_date, $input['validity']);

		if($input['file'])
		{
			$file = $input['file'];

			$file = $file->move(public_path(). '/certificate_files/', time() . '_' .  $file->getClientOriginalName());

			$certificate->filename = $file->getFilename();
		}

		$certificate->save();

		return $certificate;
	}

	public function dueDate($date, $validity)
	{
		$dueDate = Carbon::createFromFormat('Y-m-d', $date);
		return $dueDate->addMonths($validity)->subDay();
	}

	public function search($input)
	{
		return Certificate::where('cert_no', 'LIKE', '%' . $input . '%')->orderBy('cert_no')->get();
	}

	public function getNewCertificates($whereClientId = NULL, $days = 7)
	{
		if(isset($whereClientId)) {
			$certs = Certificate::selectRaw("*, TO_DAYS(NOW()) - TO_DAYS(`date`)  AS `Days`")
							->whereRaw("TO_DAYS(NOW()) - TO_DAYS(`date`) BETWEEN 0 AND $days")
							->whereIn('client_id', $whereClientId)
	                     	->get();
		} else {
			$certs = Certificate::with('certificateType', 'client')->selectRaw("*, TO_DAYS(NOW()) - TO_DAYS(`date`)  AS `Days`")
							->whereRaw("TO_DAYS(NOW()) - TO_DAYS(`date`) BETWEEN 0 AND $days")
	                     	->get();
		}

        return $certs;
	}

	public function getNewCertificatesCount($whereClientId = NULL, $days = 7)
	{
		if(isset($whereClientId)) {
			$certs = Certificate::selectRaw("COUNT(*) AS total")
							->whereRaw("(TO_DAYS(NOW()) - TO_DAYS(`date`)) BETWEEN 0 AND $days")
							->whereIn('client_id', '=', $whereClientId)
	                     	->get();
		} else {
			$certs = Certificate::selectRaw("COUNT(*) AS total")
							->whereRaw("(TO_DAYS(NOW()) - TO_DAYS(`date`)) BETWEEN 0 AND $days")
	                     	->get();
		}

        return $certs;
	}

	public function getExpiringCertificates( $whereClientId = NULL, $days = 60)
	{
		if(isset($whereClientId)) {
			$certs = Certificate::selectRaw("*, TO_DAYS(`next_inspection`) - TO_DAYS(NOW())  AS `Days`")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
							->whereIn('client_id', $whereClientId)
	                     	->get();
		} else {
			$certs = Certificate::with('certificateType', 'client')->selectRaw("*, TO_DAYS(`next_inspection`) - TO_DAYS(NOW())  AS `Days`")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
	                     	->get();
		}

        return $certs;
	}

	public function getExpiringCertificatesCount($whereClientId = NULL, $days = 60)
	{
		if(isset($whereClientId)) {
			$certs = Certificate::selectRaw("COUNT(*) AS total")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
							->whereIn('client_id', '=', $whereClientId)
	                     	->get();
		} else {
			$certs = Certificate::selectRaw("COUNT(*) AS total")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
	                     	->get();
		}

        return $certs;
	}

	public function mysqlDate($date)
	{
		$arr = explode("/", $date);
		return $arr[2] . "-" . $arr[1] . "-" . $arr[0];
	}
	
	public function getAllForClient($clientList)
	{
		return Certificate::with('client', 'certificateType')->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`")
						->whereIn('client_id', $clientList)
						->get();

	}	
	
	public function getByIdWithDetailsForClient($clientList)
	{
		return Certificate::with('client', 'certificateType')->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`")
						->whereIn('client_id', $clientList)
						->get();

	}	

	public function getSearchResultsForClient($search, $clientList)
	{
		return Certificate::whereIn('client_id', $clientList)
			->where('cert_no', 'like' , '%'. $search .'%')
			->orderBy('cert_no')
			->get();
	}	
}