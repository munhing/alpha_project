@extends('layouts/default')

@section('css')
	@parent

    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2-bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
    	<h1>
    		Create Item <small>Form</small>
    	</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('items', 'Items') }}</li>
             <li class="active">New</li>       
        </ol>  
    </section>

    <section class="content">
	{{ Form::open(array('route' => 'items', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form')) }}

		<div class="form-group">

			{{ Form::label('serial_no', 'Serial No:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('serial_no', null, ['class' =>'form-control', 'placeholder' => 'Serial No']) }}
				{{ $errors->first('serial_no', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('item_type_id', 'Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('item_type_id', null,['id' => 'item_type_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
				{{ $errors->first('item_type_id', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('client_id', 'Client:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('client_id', null,['id' => 'client_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Description:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::textarea('description', null, ['class' =>'form-control', 'placeholder' => 'Description']) }}
				{{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>
	
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-6">
    			
				{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
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

			$("#item_type_id").select2({
				placeholder: 'Select Item Type',
				data: {{ $itemTypes->toJson() }}
			});

			$("#client_id").select2({
				placeholder: 'Select Client',
				data: {{ $clients->toJson() }}
			});

        });
    </script>
@stop