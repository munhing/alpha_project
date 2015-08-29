@extends('clientviews/default')


@section('content')

	<section class="content-header">
	    <div class="row">
	        <div class="col-lg-12">    
	            <div class="box box-solid box-primary">
	                <div class="box-header">
	                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">User Profile</h3>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="box-body">
	                    <dl class="dl-horizontal">
	                        <dt>Full Name:</dt>
	                        <dd>{{ Auth::user()->fullname }}</dd>
	                        <dt>Client:</dt>
	                        <dd>{{ Auth::user()->client->name }}</dd>
	                        <dt>Email:</dt>
	                        <dd>{{ Auth::user()->email }}</dd>	                                                                          
	                    </dl>                     	
	                </div>
	                <div class="box-footer">
	                	<a href="{{ URL::route('client_change_password') }}" class="btn btn-default btn-block">Change Password</a>
	                </div>
	            </div>
	        </div>
	    </div>
    </section>
@stop
