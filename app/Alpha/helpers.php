<?php

function convertToMySQLDate($date)
{
	$date = DateTime::createFromFormat('d/m/Y', $date);
	return $date->format('Y-m-d');

}

function convertMonthToMySQLDate($date)
{
	$date = DateTime::createFromFormat('m/Y', $date);
	return $date->format('Y-m');
}

function getNextInspection($date, $validity)
{
	if($validity != 0) {
		$dueDate = Carbon\Carbon::createFromFormat('d/m/Y', $date);
		return $dueDate->addMonths($validity)->subDay();
	}

	return '0000-00-00';
}

function uploadFile($file)
{
	return $file->move(public_path(). '/report_files/', time() . '_' .  $file->getClientOriginalName());
}

function uploadCertificateFile($file)
{
	return $file->move(public_path(). '/certificate_files/', time() . '_' .  $file->getClientOriginalName());
}

function sanitizeNextInspectionDate($date)
{
	if ($date->year < 0) {
		return '-';
	}
	return $date->format('d/m/Y');
}

function statusForNextInspectionDate($date, $status)
{
	if ($date->year < 0) {
		return '<small class="label label-warning"><i class="fa fa-clock-o"></i> No Status </small>';
	}

	if ($status == 0) {	
		return '<small class="label label-danger"><i class="fa fa-clock-o"></i> Expired</small>';
	}

	return '<small class="label label-success"><i class="fa fa-clock-o"></i> Active</small>';	
}

function isCertificateFileExist($filename)
{
    if(!is_dir(public_path(). '/certificate_files/' . $filename ) && file_exists(public_path(). '/certificate_files/' . $filename )) {
       return "<a href='". asset('/certificate_files/' . $filename) ."'' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-file-text-o'></i></a>";
    }

    return '';
}

function isReportFileExist($filename)
{
    if(!is_dir(public_path(). '/report_files/' . $filename ) && file_exists(public_path(). '/report_files/' . $filename )) {
       return "<a href='". asset('/report_files/' . $filename) ."'' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-file-text-o'></i></a>";
    }

    return '';
}