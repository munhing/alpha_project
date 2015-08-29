<?php namespace Alpha\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	public function register()
	{
		//$this->app['events']->listen('LLPM.*', 'LLPM\Handlers\EmailNotifier');
		$this->app['events']->listen('Alpha.*', function(){
			//dd('User was registered!');
		});
	}
}