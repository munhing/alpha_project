<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\Clients\Events\ClientWasRegistered;
use Alpha\Clients\Events\ClientWasUpdated;

class Client extends Eloquent implements SearchInterface{

	use EventGenerator;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';

	protected $fillable = array('name');

	public function reports()
	{
		return $this->hasMany('Report');
	}

	public function items()
	{
		return $this->hasMany('Item');
	}

	public function certificates()
	{
		return $this->hasMany('Certificate');
	}

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public static function register($name)
	{
		$client = new static(compact('name'));

		$client->raise(new ClientWasRegistered($client));

		return $client;
	}		

	public static function edit($id, $name)
	{
		$client = static::find($id);

		$client->name = $name;

		$client->raise(new ClientWasUpdated($client));

		return $client;
	}	

	public function getSearchName()
	{
		return $this->name;
	}

	public function getSearchUrl()
	{
		return 'clients.show';
	}
}
