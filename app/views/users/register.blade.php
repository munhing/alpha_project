@extends('layouts/default')

@section('css')
	@parent

    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2-bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header">
        <h1>Register New User<small>Form</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('users', 'Users') }}</li>
             <li class="active">New</li>       
        </ol>         
    </section>
    <!-- /.row -->

    <section class="content">
	{{ Form::open(array('route' => 'register', 'class' => 'form-horizontal', 'role' => 'form')) }}

		<div class="form-group">
			{{ Form::label('fullname', 'Full Name:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('fullname', null, ['class' =>'form-control', 'placeholder' => 'Full Name']) }}
				{{ $errors->first('fullname', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('role_id', 'Role:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::select('role_id', $roles, '3', ['class' =>'form-control', 'placeholder' => 'Role']) }}
				{{ $errors->first('role_id', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>
		
		<div class="form-group" id="client_div">
			{{ Form::label('client_id', 'Client:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('client_id', null,['id' => 'client_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
				{{ $errors->first('client_id', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>
		
		<div class="form-group">
			{{ Form::label('username', 'Username:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('username', null, ['class' =>'form-control', 'placeholder' => 'Username']) }}
				{{ $errors->first('username', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>		

		<div class="form-group">
			{{ Form::label('email', 'Email:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('email', null, ['class' =>'form-control', 'placeholder' => 'Email']) }}
				{{ $errors->first('email', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>	

		<div class="form-group">
			{{ Form::label('password', 'Password:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::password('password', ['class' =>'form-control', 'placeholder' => 'Password']) }}
				{{ $errors->first('password', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('password_confirmation', 'Confirm Password:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::password('password_confirmation', ['class' =>'form-control', 'placeholder' => 'Confirm Password']) }}
				{{ $errors->first('password_confirmation', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-6">
    			<a href="{{ URL::route('users') }}" class="btn btn-danger">Cancel</a>
				{{ Form::submit('Create User', ['class' => 'btn btn-primary']) }}
			</div>
		</div>

		<!-- <div class="form-group" id="test"></div> -->
		
	{{ Form::close() }}
	</section>

@stop

@section('js')
	@parent
	<script src="{{ URL::asset('assets/datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/select2-3.5.1/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>    

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

			$("#client_id").select2({
				placeholder: 'Select Client',
				data: {{ $clients->toJson() }}
			});
			
			$( "#role_id" ).change(function () {
				var str = "";
				$( "select option:selected" ).each(function() {
					str += $( this ).text() + " ";
				});
				//str = $( this ).text();
				
				//$( "#test" ).text( str );
				
				if(str.trim() === 'Admin' || str.trim() === 'Staff') {
					$('#client_div').hide();
				} else {
					$('#client_div').show();				
				}
				
			})
			.change();			

        });
    </script>
@stop
