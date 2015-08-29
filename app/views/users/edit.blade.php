@extends('layouts/default')

@section('css')
	@parent
	<link href="{{ URL::asset('assets/datepicker/css/datepicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2-bootstrap.css') }}" type="text/css" />

@stop

@section('content')

	<section class="content-header">
		<h1>User: {{ $user->fullname }} <small>{{ $user->client->name }}</small></h1>
		
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('users', 'Users') }}</li>
            <li>{{ link_to_route('user_show', $user->fullname, $user->id ) }}</li>
             <li class="active">Edit</li>       
        </ol> 		
	</section>

	<section class="content">

	{{ Form::open(array('route' => ['user_update', $user->id], 'class' => 'form-horizontal', 'role' => 'form')) }}
		{{ Form::hidden('id', $user->id) }}
		<div class="form-group">

			{{ Form::label('fullname', 'Fullname:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('fullname', $user->fullname, ['class' =>'form-control', 'placeholder' => 'Fullname']) }}
				{{ $errors->first('fullname', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('client_id', 'Client:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('client_id', null,['id' => 'client_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>

		<div class="form-group">

			{{ Form::label('username', 'Username:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('username', $user->username, ['class' =>'form-control', 'placeholder' => 'Username']) }}
				{{ $errors->first('username', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">

			{{ Form::label('email', 'Email:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('email', $user->email, ['class' =>'form-control', 'placeholder' => 'Email']) }}
				{{ $errors->first('email', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-6">
    			
				{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
								
	{{ Form::close() }}

	</section>
	

@stop

@section('js')

	@parent

	<script src="{{ URL::asset('assets/datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/select2-3.5.1/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>    

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

	        $( "#date" ).datepicker( 
	        	{format: "dd/mm/yyyy" }
	        );

			$("#client_id").select2({
				placeholder: 'Select Client',
				data: {{ $clients->toJson() }}
			});

			$("#client_id").select2("val", "{{ $user->client_id }}" );

        });
    </script>

@stop