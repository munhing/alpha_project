<?php

use Faker\Factory as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// App::bind('Alpha\Repositories\ClientsRepository', 'Alpha\Repositories\DbClientsRepository');
// App::bind('Alpha\Repositories\ReportsRepository', 'Alpha\Repositories\DbReportsRepository');
// App::bind('Alpha\Repositories\ItemsRepository', 'Alpha\Repositories\DbItemsRepository');
// App::bind('Alpha\Repositories\CertificatesRepository', 'Alpha\Repositories\DbCertificatesRepository');


 //  Event::listen('illuminate.query', function($sql)
 // {
 // 	var_dump('SQL: ' .$sql);
 // }); 

Route::get('/test', function(){

	// dd(getenv('APP_ENV') ?: 'LOCAL');

	// $item = Item::find(110);
	
	// $item->delete();

	// dd($item);
	//var_dump(Auth::user()->roles->first()->name);

	// $user = User::find(1);
// 	$admin = Role::find(2);
// 	$owner = Role::find(1);
// 	$user->attachRole($admin);

// $managePosts = new Permission;
// $managePosts->name = 'manage_posts';
// $managePosts->display_name = 'Manage Posts';
// $managePosts->save();

// $manageUsers = new Permission;
// $manageUsers->name = 'manage_users';
// $manageUsers->display_name = 'Manage Users';
// $manageUsers->save();

// $owner->perms()->sync(array($managePosts->id,$manageUsers->id));
// $admin->perms()->sync(array($managePosts->id));


// var_dump($user->hasRole("Owner"));    // false
// var_dump($user->hasRole("Admin"));    // true
// var_dump($user->can("manage_posts")); // true
// var_dump($user->can("manage_users")); // false

	// $owner = new Role;
	// $owner->name = 'Owner';
	// $owner->save();

	// $admin = new Role;
	// $admin->name = 'Admin';
	// $admin->save();

	// $faker = Faker::create_function(args, code)();

	// $report = Report::with('client')->find($faker->numberBetween(1,500));

	// dd($report->client->id);

	//DB::table('clients')->selectRaw(id from)

		// $id = DB::select(DB::raw("SELECT * FROM clients, 
  //   			(SELECT RAND() * (SELECT MAX(id) FROM clients) AS tid) AS tmp
		// 		WHERE clients.id = round(tmp.tid)"));

		// dd($id);

	//$type = "new_reports";
	//$type = "new_certificates";
	//$type = "expiring_reports";
	// $type = "expiring_certificates";
	// $arr = explode("_", $type);
	// $method = str_replace($arr[0], "get" . ucwords($arr[0]), $arr[0]) . ucwords($arr[1]);
	// echo $method;


	//Flash::success("Report has been successfully Added!");

	//return Redirect::route('home');

	// $reportRepo = App::make('Alpha\Repositories\ReportsRepository');
	// $reports = $reportRepo->getExpiringReports(100);

	// var_dump($reports->count());
	// var_dump($reports->toArray());

	// $certRepo = App::make('Alpha\Repositories\CertificatesRepository');
	// $certs = $certRepo->getExpiringCertificates(100);

	// var_dump($certs->count());
	// var_dump($certs->toArray());
	//Search which reports is expiring soon
	//Report::all();


	// $report = Report::find(501);
	// $cert = Certificate::find(501);
	// $report->certificates()->detach($cert);

	//$cert = Certificate::with('report')->find(8);

	//dd(count($cert->report));

		// $report = Report::with('client', 'items','certificates')->find(380);
		// $itemType = ItemType::lists('type', 'id');
		
		// $items = $report->items;

		// $relatedItems = Item::where('group', '=', $items->first()->group)->get();
		// //dd($relatedItems->toArray());


		// $certificates = $report->certificates;

		// var_dump('****** Items ******');

		// foreach($items as $item)
		// {

		// 	foreach($relatedItems as $key => $relatedItem)
		// 	{
		// 		if($item->serial_no == $relatedItem->serial_no)
		// 		{
		// 			unset($relatedItems[$key]);
		// 		}

		// 		//var_dump($relatedItem->serial_no . ' [' . $itemType[$relatedItem->item_type_id] . ']');
		// 	}
		// 	//$relatedItems->forget($item->id);
		// 	var_dump($key . " - ". $item->serial_no. ' [' . $itemType[$item->item_type_id] . ']');
		// 	//var_dump($itemType[$item->item_type_id]);
		// }

		// var_dump('****** Certificates ******');

		// foreach($certificates as $certificate)
		// {
		// 	var_dump($certificate->cert_no);
		// }

		// var_dump('****** Related Items ******');

		// foreach($relatedItems as $relatedItem)
		// {
		// 	var_dump($relatedItem->serial_no . ' [' . $itemType[$relatedItem->item_type_id] . ']');
		
		//var_dump($items->toArray());

		// foreach($report as $item){
		// 	var_dump($item);
		// }

/* 		$report = '123-1409802345_1SULAIMAN-20140827.pdf';
		
		if(file_exists(public_path(). '/report_files/' . $report )) {
			echo URL::asset('/report_files/' . $report);
		} else {
			echo 'File not exist';
		} */
		// $dataForm['id'] = null;

		// if(isset($dataForm['id'])) {
		// 	return "Is Set!";
		// } else {
		// 	return "Is not set";
		// }

		// $faker = Faker::create();
		// $validity = $faker->randomElement($array = array (12, 24, 36, 48));
		// $year = ['12'=>1, '24'=>2, '36'=>3, '48'=>4];
		
		// $fakerDate = $faker->dateTimeBetween('-10 years', 'now');
		// $last_inspection = Carbon::createFromFormat('Y-m-d', $fakerDate->format('Y-m-d'));

		

		// var_dump($last_inspection);
		// var_dump($last_inspection->addYears($year[$validity]));


});


	
Route::group(array('prefix' => 'admin', 'before' => 'auth | client'), function() {
	/*
	|--------------------------------------------------------------------------
	| Home
	|--------------------------------------------------------------------------
	*/
	Route::get('/', [
		'as' => 'home', 
		'uses' => 'PagesController@home'
	]);

	Route::get('/reporting/{type}', [
		'as' => 'reporting', 
		'uses' => 'PagesController@reporting'
	]);

	/*
	|--------------------------------------------------------------------------
	| Search
	|--------------------------------------------------------------------------
	*/
	Route::any('/search', [
		'as' => 'search', 
		'uses' => 'SearchController@index'
	]);

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	*/
	Route::get('/settings', [
		'as' => 'settings', 
		'uses' => 'SettingsController@index'
	]);

	Route::post('/settings', [
		'as' => 'settings', 
		'uses' => 'SettingsController@store'
	]);
	/*
	|--------------------------------------------------------------------------
	| Reports
	|--------------------------------------------------------------------------
	*/
	Route::get('/reports', [
		'as' => 'reports', 
		'uses' => 'ReportsController@index'
	]);

	Route::get('/reports/{id}/show', [
		'as' => 'reports.show',
		'uses' => 'ReportsController@show'
	]);

	Route::get('/reports/create', [
		'as' => 'reports.create', 
		'uses' => 'ReportsController@create'
	]);

	Route::post('/reports/create', [
		'as' => 'reports.create', 
		'uses' => 'ReportsController@store'
	]);

	Route::get('/reports/{id}/edit', [
		'as' => 'reports.edit',
		'uses' => 'ReportsController@edit'
	]);

	Route::put('/reports', 'ReportsController@update');

	Route::get('/reports/{id}/add_items', [
		'as' => 'reports.items.add',
		'uses' => 'ReportsController@add_items'
	]);

	Route::post('/reports/{id}/add_items', 'ReportsController@post_add_items');

	Route::post('/reports/{id}/create_item', [
		'as' => 'reports.item.create',
		'uses' => 'ReportsController@post_create_item'
		]);

	Route::get('/reports/{id}/add_certificates', [
		'as' => 'reports.certificates.add',
		'uses' => 'ReportsController@add_certificates'
	]);

	Route::post('/reports/{id}/add_certificates', 'ReportsController@post_add_certificates');

	Route::post('/reports/{id}/create_certificate', [
		'as' => 'reports.certificate.create',
		'uses' => 'ReportsController@post_create_certificate'
		]);

	Route::post('/reports/{id}/remove_file', [
		'as' => 'reports.file.remove',
		'uses' => 'ReportsController@post_remove_file'
		]);

	Route::post('/reports/{id}/remove_item', [
		'as' => 'reports.item.remove',
		'uses' => 'ReportsController@post_remove_item'
		]);

	Route::post('/reports/{id}/remove_certificate', [
		'as' => 'reports.certificate.remove',
		'uses' => 'ReportsController@post_remove_certificate'
		]);

	Route::get('/reporttypes', [
		'as' => 'reports.type',
		'uses' => 'ReportsController@report_type'
		]);

	Route::get('/reporttypes/{id}/edit', [
		'as' => 'reports.type.edit',
		'uses' => 'ReportsController@report_type_edit'
		]);

	Route::post('/reporttypes/{id}/update', [
		'as' => 'reports.type.update',
		'uses' => 'ReportsController@report_type_update'
		]);

	Route::post('/reporttypes/{id}/delete', [
		'as' => 'reports.type.delete',
		'uses' => 'ReportsController@report_type_delete'
		]);

	Route::get('/reporttypes/create', [
		'as' => 'reports.type.create',
		'uses' => 'ReportsController@report_type_create'
		]);

	Route::post('/reporttypes/create', [
		'as' => 'reports.type.create',
		'uses' => 'ReportsController@post_report_type_create'
		]);

	Route::post('/reports/{id}/delete', [
		'as' => 'reports.delete',
		'uses' => 'ReportsController@destroy'
		]);

	/*
	|--------------------------------------------------------------------------
	| Items
	|--------------------------------------------------------------------------
	*/
	Route::get('/items', [
		'as' => 'items', 
		'uses' => 'ItemsController@index'
	]);

	Route::get('/items/{id}/show', [
		'as' => 'items.show',
		'uses' => 'ItemsController@show'
	]);

	Route::get('/items/create', [
		'as' => 'items.create', 
		'uses' => 'ItemsController@create'
	]);

	Route::get('/items/{id}/edit', [
		'as' => 'items.edit',
		'uses' => 'ItemsController@edit'
	]);

	Route::get('/items/{id}/group', [
		'as' => 'item_group',
		'uses' => 'ItemsController@group'
	]);

	Route::post('/items', 'ItemsController@store');
	Route::put('/items', 'ItemsController@update');
	Route::post('/items/{id}/group', [
		'as' => 'item_group_update', 
		'uses' => 'ItemsController@groupUpdate'
	]);

	Route::get('/itemtypes', [
		'as' => 'items.type',
		'uses' => 'ItemsController@item_type'
		]);

	Route::get('/itemtypes/{id}/edit', [
		'as' => 'items.type.edit',
		'uses' => 'ItemsController@item_type_edit'
		]);

	Route::post('/itemtypes/{id}/update', [
		'as' => 'items.type.update',
		'uses' => 'ItemsController@item_type_update'
		]);

	Route::post('/itemtypes/{id}/delete', [
		'as' => 'items.type.delete',
		'uses' => 'ItemsController@item_type_delete'
		]);

	Route::get('/itemtypes/create', [
		'as' => 'items.type.create',
		'uses' => 'ItemsController@item_type_create'
		]);

	Route::post('/itemtypes/create', [
		'as' => 'items.type.create',
		'uses' => 'ItemsController@post_item_type_create'
		]);

	Route::post('/items/{id}/delete', [
		'as' => 'items.delete',
		'uses' => 'ItemsController@destroy'
	]);

	/*
	|--------------------------------------------------------------------------
	| Certificates
	|--------------------------------------------------------------------------
	*/
	Route::get('/certificates', [
		'as' => 'certificates', 
		'uses' => 'CertificatesController@index'
	]);

	Route::get('/certificates/{id}/show', [
		'as' => 'certificates.show',
		'uses' => 'CertificatesController@show'
	]);

	Route::get('/certificates/create', [
		'as' => 'certificates.create', 
		'uses' => 'CertificatesController@create'
	]);

	Route::get('/certificates/{id}/edit', [
		'as' => 'certificates.edit',
		'uses' => 'CertificatesController@edit'
	]);

	Route::post('/certificates', 'CertificatesController@store');
	Route::put('/certificates', 'CertificatesController@update');

	Route::post('/certificates/{id}/delete', [
		'as' => 'certificates.delete',
		'uses' => 'CertificatesController@destroy'
	]);

	Route::post('/certificates/{id}/remove_file', [
		'as' => 'certificates.file.remove',
		'uses' => 'CertificatesController@post_remove_file'
	]);

	Route::get('/certificates/{id}/add_items', [
		'as' => 'certificates.items.add',
		'uses' => 'CertificatesController@add_items'
	]);

	Route::post('/certificates/{id}/add_items', 'CertificatesController@post_add_items');

	Route::post('/certificates/{id}/create_item', [
		'as' => 'certificates.item.create',
		'uses' => 'CertificatesController@post_create_item'
		]);

	Route::post('/certificates/{id}/remove_item', [
		'as' => 'certificates.item.remove',
		'uses' => 'CertificatesController@post_remove_item'
		]);	

	Route::get('/certificatetypes', [
		'as' => 'certificates.type',
		'uses' => 'CertificateTypesController@index'
		]);	

	Route::get('/certificatetypes/create', [
		'as' => 'certificates.type.create',
		'uses' => 'CertificateTypesController@create'
		]);

	Route::post('/certificatetypes/create', [
		'as' => 'certificates.type.create',
		'uses' => 'CertificateTypesController@store'
		]);

	Route::get('/certificatetypes/{id}/edit', [
		'as' => 'certificates.type.edit',
		'uses' => 'CertificateTypesController@edit'
		]);

	Route::post('/certificatetypes/{id}/edit', [
		'as' => 'certificates.type.edit',
		'uses' => 'CertificateTypesController@update'
		]);	

	Route::post('/certificatetypes/{id}/delete', [
		'as' => 'certificates.type.delete',
		'uses' => 'CertificateTypesController@destroy'
		]);	

	
	/*
	|--------------------------------------------------------------------------
	| Clients
	|--------------------------------------------------------------------------
	*/
	Route::get('/clients', [
		'as' => 'clients', 
		'uses' => 'ClientsController@index'
	]);

	Route::get('/clients/{id}/show', [
		'as' => 'clients.show',
		'uses' => 'ClientsController@show'
	]);

	Route::get('/clients/{id}/items', [
		'as' => 'clients.items.list',
		'uses' => 'ClientsController@items_list'
	]);

	Route::get('/clients/{id}/reports', [
		'as' => 'clients.reports.list',
		'uses' => 'ClientsController@reports_list'
	]);

	Route::get('/clients/{id}/certificates', [
		'as' => 'clients.certificates.list',
		'uses' => 'ClientsController@certificates_list'
	]);

	Route::get('/clients/create', [
		'as' => 'clients.create',
		'uses' => 'ClientsController@create'
	]);

	Route::get('/clients/{id}/edit', [
		'as' => 'clients.edit',
		'uses' => 'ClientsController@edit'
	]);

	Route::post('/clients', 'ClientsController@store');

	Route::put('/clients', [
		'as' => 'clients.update',
		'uses' => 'ClientsController@update'
	]);

	Route::post('/clients/{id}/delete', [
		'as' => 'clients.delete',
		'uses' => 'ClientsController@destroy'
	]);	

	/*
	|--------------------------------------------------------------------------
	| Location
	|--------------------------------------------------------------------------
	*/
	Route::get('/locations', [
		'as' => 'locations', 
		'uses' => 'LocationsController@index'
	]);

	Route::get('/locations/create', [
		'as' => 'locations.create', 
		'uses' => 'LocationsController@create'
	]);

    Route::post('/locations/create', [
		'as' => 'locations.create', 
		'uses' => 'LocationsController@store'
	]);

    Route::get('/locations/{id}/show', [
		'as' => 'locations.show', 
		'uses' => 'LocationsController@show'
	]);

    Route::get('/locations/{id}/edit', [
		'as' => 'locations.edit', 
		'uses' => 'LocationsController@edit'
	]);

    Route::put('/locations', [
		'as' => 'locations.update', 
		'uses' => 'LocationsController@update'
	]);
    
	Route::post('/locations/{id}/delete', [
		'as' => 'locations.delete',
		'uses' => 'LocationsController@destroy'
	]);	

	Route::get('/locations/{id}/reports', [
		'as' => 'locations.reports.list',
		'uses' => 'LocationsController@reports'
	]);

	Route::get('/locations/{id}/certificates', [
		'as' => 'locations.certificates.list',
		'uses' => 'LocationsController@certificates'
	]);

	Route::get('/locations/{id}/items', [
		'as' => 'locations.items.list',
		'uses' => 'LocationsController@items'
	]);	
	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/

	Route::get('users', [
			'as' => 'users',
			'uses' => 'UsersController@index'
		]);

	Route::get('users/{id}/edit', [
			'as' => 'user_edit',
			'uses' => 'UsersController@edit'
		]);

	Route::get('users/{id}/show', [
			'as' => 'user_show',
			'uses' => 'UsersController@show'
		]);

	Route::post('users/{id}/update', [
			'as' => 'user_update',
			'uses' => 'UsersController@update'
		]);

	Route::post('users/{id}/delete', [
			'as' => 'user_delete',
			'uses' => 'UsersController@destroy'
		]);

	Route::get('users/register', [
			'as' => 'register',
			'uses' => 'UsersController@create'
		]);

	Route::post('users/register', [
			'as' => 'register',
			'uses' => 'UsersController@store'
		]);

	Route::get('/users/profile', [
			'as' => 'profile',
			'uses' => 'UsersController@profile'
		]);

	Route::get('/users/change_password', [
			'as' => 'change_password',
			'uses' => 'UsersController@changePassword'
		]);

	Route::post('/users/change_password', [
			'as' => 'change_password',
			'uses' => 'UsersController@doChangePassword'
		]);	

	Route::get('/users/{id}/change_password', [
			'as' => 'user_change_password',
			'uses' => 'UsersController@userChangePassword'
		]);

	Route::post('/users/{id}/change_password', [
			'as' => 'user_change_password',
			'uses' => 'UsersController@doUserChangePassword'
		]);	
	Route::get('/users/{id}/add_client', [
			'as' => 'users.client.add',
			'uses' => 'UsersController@addClient'
		]);		

	Route::post('/users/{id}/add_client', [
			'as' => 'users.client.add',
			'uses' => 'UsersController@addClientStore'
		]);	

	Route::post('/users/{id}/remove_client', [
			'as' => 'users.client.remove',
			'uses' => 'UsersController@removeClient'
		]);					
});
/*
|--------------------------------------------------------------------------
| Users - Confide
|--------------------------------------------------------------------------
*/
// Confide routes


Route::get('/login', [
		'as' => 'login',
		'uses' => 'UsersController@login'
	]);

Route::post('/login', [
		'as' => 'login',
		'uses' => 'UsersController@doLogin'
	]);

Route::get('users/confirm/{code}', 'UsersController@confirm');

Route::get('users/forgot_password', [
		'as' => 'forgot_password',
		'uses' => 'UsersController@forgotPassword'
	]);

Route::post('users/forgot_password', [
		'as' => 'forgot_password',
		'uses' => 'UsersController@doForgotPassword'
	]);

Route::get('users/reset_password/{token}', [
		'as' => 'reset_password',
		'uses' => 'UsersController@resetPassword'
	]);

Route::post('users/reset_password', [
		'as' => 'reset_password',
		'uses' => 'UsersController@doResetPassword'
	]);

Route::get('/logout', [
		'as' => 'logout',
		'uses' => 'UsersController@logout'
	]);

// Dashboard route 
Route::get('userpanel/dashboard', function(){ return View::make('userpanel.dashboard'); }); 
 
// Applies auth filter to the routes within admin/ 
Route::when('userpanel/*', 'auth');


/*
|--------------------------------------------------------------------------
| Clients View
|--------------------------------------------------------------------------
*/

Route::group(array('before' => 'auth'), function() {

	Route::get('/', [
			'as' => 'client_home',
			'uses' => 'ClientViewController@home'
		]);

	Route::get('/reporting/{type}', [
		'as' => 'client_reporting', 
		'uses' => 'ClientViewController@reporting'
	]);

	Route::get('/reports', [
			'as' => 'client_reports',
			'uses' => 'ClientViewController@reports'
		]);

	Route::get('/certificates', [
			'as' => 'client_certificates',
			'uses' => 'ClientViewController@certificates'
		]);	

	Route::get('/items', [
			'as' => 'client_items',
			'uses' => 'ClientViewController@items'
		]);

	Route::get('/users', [
			'as' => 'client_users',
			'uses' => 'ClientViewController@users'
		]);

	Route::get('/reports/{id}', [
			'before' => 'client_report_check',
			'as' => 'client_report_show',
			'uses' => 'ClientViewController@report_show'
		]);

	Route::get('/certificates/{id}', [
			'before' => 'client_certificate_check',
			'as' => 'client_certificate_show',
			'uses' => 'ClientViewController@certificate_show'
		]);

	Route::get('/items/{id}', [
			'before' => 'client_item_check',
			'as' => 'client_item_show',
			'uses' => 'ClientViewController@item_show'
		]);

	Route::get('/profile', [
			'as' => 'client_profile',
			'uses' => 'ClientViewController@profile'
		]);

	Route::get('/change_password', [
			'as' => 'client_change_password',
			'uses' => 'UsersController@clientChangePassword'
		]);

	Route::post('/change_password', [
			'as' => 'client_change_password',
			'uses' => 'UsersController@doClientChangePassword'
		]);

	Route::any('/search', [
		'as' => 'client_search', 
		'uses' => 'ClientViewController@search'
	]);	

	Route::any('/locations', [
		'as' => 'client_locations', 
		'uses' => 'ClientViewController@locations'
	]);	

	Route::any('/locations/{location_id}/reports', [
		'as' => 'client_location_reports_list', 
		'uses' => 'ClientViewController@locations_reports'
	]);

	Route::any('/locations/{location_id}/certificates', [
		'as' => 'client_location_certificates_list', 
		'uses' => 'ClientViewController@locations_certificates'
	]);	

	Route::any('/locations/{location_id}/items', [
		'as' => 'client_location_items_list', 
		'uses' => 'ClientViewController@locations_items'
	]);

});