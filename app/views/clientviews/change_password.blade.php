@extends('clientviews/default')


@section('content')

	<section class="content-header">
	    <div class="row">
	        <div class="col-lg-12">    
	            <div class="box box-solid box-primary">
	                <div class="box-header">
	                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Change Password</h3>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="box-body">

					{{ Form::open(array('route' => 'client_change_password', 'role' => 'form')) }}

						<div class="form-group">
							{{ Form::password('password_old', ['class' =>'form-control', 'placeholder' => 'Old Password']) }}
						</div>

						<div class="form-group">
							{{ Form::password('password', ['class' =>'form-control', 'placeholder' => 'Password']) }}
						</div>

						<div class="form-group">
							{{ Form::password('password_confirmation', ['class' =>'form-control', 'placeholder' => 'Confirm Password']) }}
						</div>
						
						<div class="form-group">
							{{ Form::submit('Change', ['class' => 'btn btn-primary']) }}
						</div>

					{{ Form::close() }}
                   	
	                </div>
	            </div>
	        </div>
	    </div>
    </section>
@stop
