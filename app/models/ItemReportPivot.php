<?php

class ItemReportPivot extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item_report';

	public $timestamps = false; 

	protected $fillable = array('item_id', 'report_id');

}
