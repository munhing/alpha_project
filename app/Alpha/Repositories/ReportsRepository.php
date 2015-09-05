<?php namespace Alpha\Repositories;

use Report;
use Item;
use Type;
use Certificate;
use Carbon\Carbon;
use DB;

class ReportsRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return Report::with('client')->orderBy('report_no')->get();
	}

	public function getAllWithPagination($row = 20)
	{
		return Report::with('client')->selectRaw("reports.*, clients.name, (`next_inspection`) > (NOW())  AS `status`")
		       ->join('clients', 'reports.client_id', '=', 'clients.id')
		       ->orderBy('reports.report_no')
		       ->paginate($row);
	}

	public function getAllByLocationWithPagination($location_id, $row = 20)
	{
		return Report::with('client')->selectRaw("reports.*, clients.name, (`next_inspection`) > (NOW())  AS `status`")
		       ->join('clients', 'reports.client_id', '=', 'clients.id')
		       ->where('location_id', $location_id)
		       ->orderBy('reports.report_no')
		       ->paginate($row);
	}

	public function save(Report $report)
	{
		return $report->save();
	}

	public function getById($id)
	{
		return Report::with('client', 'items', 'certificates', 'location')->find($id);
	}

	public function getByIdWithDetails($id)
	{
		return Report::with([
			'client' => function($query){
				$query->orderBy('name', 'asc');
			}, 
			'items' => function($query){
				$query->orderBy('serial_no', 'asc');
			},
			'certificates' => function($query){
				$query->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`")->orderBy('date', 'asc');
			}
		])->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`")->findOrFail($id);
	}

	public function removeFile($id)
	{
		$report = $this->getById($id);
		$report->filename = '';
		$this->save($report);
	}


	public function search($input)
	{
		return Report::where('report_no', 'LIKE', '%' . $input . '%')->orderBy('report_no')->get();
	}

	public function addItems($id, $items)
	{
		//dd($items);
		$listedItems = Report::find($id)->items()->lists('serial_no', 'id');

		//dd($listedItems);

		if($items) {
			foreach ($items as $item) {

				if (!array_key_exists($item, $listedItems)) {

					$i = Item::find($item);
					$i->reports()->attach($id);

				}
			}
		}
		//return Report::where('report_no', 'LIKE', '%' . $input . '%')->orderBy('report_no')->get();
	}

	public function removeItem($id, $item_id)
	{
		$i = Item::find($item_id);
		$i->reports()->detach($id);
	}

	public function createItem($input)
	{
		//dd($input);
		$item = new Item;
		$item->serial_no = $input['serial_no'];
		$item->item_type_id = $input['item_type_id'];
		$item->client_id = $input['client_id'];
		$item->description = $input['description'];
	
		$item->save();

		return $item;
	}

	public function addCertificates($id, $certificates)
	{
		
		$listedCertificates = Report::find($id)->certificates()->select('certificates.*')->lists('cert_no', 'id');


		if($certificates) {
			foreach ($certificates as $certificate) {

				if (!array_key_exists($certificate, $listedCertificates)) {

					$c = Certificate::find($certificate);
					$c->reports()->attach($id);

				}
			}
		}

	}

	public function createCertificate($id, $input)
	{

		//dd($input);

		$certificate = new Certificate;
		$certificate->cert_no = $input['cert_no'];
		$certificate->report_id = $id;
		$certificate->client_id = $input['client_id'];
		$certificate->date = $this->mysqlDate($input['date']);
		$certificate->validity = $input['validity'];
		$certificate->next_inspection = $this->dueDate($this->mysqlDate($input['date']), $input['validity']);
	
		$certificate->save();

		return $certificate;

	}

	public function removeCertificate($id, $certificate_id)
	{
		$c = Certificate::find($certificate_id);
		//dd($c->toArray());
		$c->reports()->detach($id);
	}

	public function getNewReports($whereClientId = NULL, $days = 7)
	{
		if(isset($whereClientId)) {
			$reports = Report::with('client')->selectRaw("*, TO_DAYS(NOW()) - TO_DAYS(`date`)  AS `Days`")
							->whereRaw("TO_DAYS(NOW()) - TO_DAYS(`date`) BETWEEN 0 AND $days")
							->whereIn('client_id', $whereClientId)
	                     	->get();
		} else {
			$reports = Report::with('client')->selectRaw("*, TO_DAYS(NOW()) - TO_DAYS(`date`)  AS `Days`")
							->whereRaw("TO_DAYS(NOW()) - TO_DAYS(`date`) BETWEEN 0 AND $days")
	                     	->get();
        }
        return $reports;
	}

	public function getNewReportsCount($whereClientId = NULL, $days = 7)
	{
		if(isset($whereClientId)) {
			$reports = Report::selectRaw("COUNT(*) AS total")
							->whereRaw("(TO_DAYS(NOW()) - TO_DAYS(`date`)) BETWEEN 0 AND $days")
							->where('client_id', '=', $whereClientId)
	                     	->get();
		} else {			
			$reports = Report::selectRaw("COUNT(*) AS total")
							->whereRaw("(TO_DAYS(NOW()) - TO_DAYS(`date`)) BETWEEN 0 AND $days")
	                     	->get();
	    }

        return $reports;
	}

	public function getExpiringReports($whereClientId = NULL, $days = 60)
	{
		if(isset($whereClientId)) {
			$reports = Report::with('client')->selectRaw("*, TO_DAYS(`next_inspection`) - TO_DAYS(NOW())  AS `Days`")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
							->whereIn('client_id', $whereClientId)
	                     	->get();
		} else {
			$reports = Report::with('client')->selectRaw("*, TO_DAYS(`next_inspection`) - TO_DAYS(NOW())  AS `Days`")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
	                     	->get();
		}

        return $reports;
	}

	public function getExpiringReportsCount($whereClientId = NULL, $days = 60)
	{
		if(isset($whereClientId)) {
			$reports = Report::selectRaw("COUNT(*) AS total")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
							->where('client_id', '=', $whereClientId)
	                     	->get();
		} else {

			$reports = Report::selectRaw("COUNT(*) AS total")
							->whereRaw("TO_DAYS(`next_inspection`) - TO_DAYS(NOW()) BETWEEN 0 AND $days")
	                     	->get();
		}

        return $reports;
	}

	public function mysqlDate($date)
	{
		$arr = explode("/", $date);
		return $arr[2] . "-" . $arr[1] . "-" . $arr[0];
	}

	public function addType($input)
	{

		$type = new Type;
		$type->type = $input['type'];

		$type->save();

		return $type;
	}

	public function updateType($input)
	{
		//dd($input);
		$type = Type::find($input['id']);
		$type->type = $input['type'];
		$type->save();

		return $type;
	}	
	
	public function getAllForClient($clientList)
	{
		return Report::with('client', 'reportType')->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`")
						->whereIn('client_id', $clientList)
						->get();
	}	
	
	public function getByIdWithDetailsForClient($clientList)
	{
		return Report::with('client', 'reportType')->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`")
						->whereIn('client_id', $clientList)
						->get();
	}	
	
	public function getSearchResultsForClient($search, $clientList)
	{
		return Report::whereIn('client_id', $clientList)
			->where('report_no', 'like' , '%'. $search .'%')
			->orderBy('report_no')
			->get();
	}
}