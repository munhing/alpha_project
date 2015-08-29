<?php

class Location extends \Eloquent {

    protected $table = 'locations';
    
	protected $fillable = ['location', 'client_id'];

	public function client()
	{
		return $this->belongsTo('Client');
	}    

    public function reports()
	{
		return $this->hasMany('Report', 'location_id', 'id');
	}
    
	public function certificates()
	{
		return $this->hasMany('Certificate', 'location_id', 'id');
	}

	public function items()
	{
		return $this->hasMany('Item', 'location_id', 'id');
	}
    
	public static function register($location, $client_id)
	{
		$local = new static(compact('location', 'client_id'));

		return $local;
	}

	public static function edit($id, $location, $client_id)
	{
		$local = static::find($id);

		$local->location = $location;
        $local->client_id = $client_id;

		return $local;
	}    
}