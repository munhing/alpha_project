@extends('layouts/default')

@section('css')
	@parent
	<link href="{{ URL::asset('assets/datepicker/css/datepicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2-bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header">
    	<h1>
    		Item No: {{ $item->serial_no }} <small>{{ $item->client->name }}</small>
    	</h1>
    	
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('items', 'Items') }}</li>
            <li>{{ link_to_route('items.show', $item->serial_no, $item->id) }}</li>
             <li class="active">Edit</li>       
        </ol>        	
    </section>

    <section class="content">

	{{ Form::open(array('route' => 'items', 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) }}
		{{ Form::hidden('id', $item->id) }}
		<div class="form-group">

			{{ Form::label('serial_no', 'Serial No:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('serial_no', $item->serial_no, ['class' =>'form-control', 'placeholder' => 'Serial No']) }}
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
			{{ Form::label('location_id', 'Location:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('location_id', null,['id' => 'location_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Description:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::textarea('description', $item->description, ['class' =>'form-control', 'placeholder' => 'Description']) }}
				{{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
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

			$("#item_type_id").select2({
				placeholder: 'Select Item Type',
				data: {{ $itemTypes->toJson() }}
			});

			$("#item_type_id").select2("val", "{{ $item->item_type_id }}" );

			$("#client_id").select2({
				placeholder: 'Select Client',
				data: {{ $clients->toJson() }}
			});

			$("#client_id").select2("val", "{{ $item->client_id }}" );

			$("#location_id").select2({
				placeholder: 'Select Location',
				data: {{ $locations->toJson() }}
			});

			$("#location_id").select2("val", "{{ $item->location_id }}" );
        });
    </script>

@stop