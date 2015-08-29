@extends('layouts/default')

@section('css')
	@parent

    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2-bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header">
		<h1>
			Location: {{ $location->location }} <small>{{ $location->client->name }}</small> 
		</h1>
        
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('locations', 'Location') }}</li>
             <li class="active">Edit</li>       
        </ol>     	
    </section>

    <section class="content">

	{{ Form::open(array('route' => 'locations.update', 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) }}
        {{ Form::hidden('id', $location->id) }}
		<div class="form-group">

			{{ Form::label('location', 'Location:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('location', $location->location, ['class' =>'form-control', 'placeholder' => 'Location']) }}
				{{ $errors->first('location', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

        <div class="form-group">
			{{ Form::label('client_id', 'Client:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('client_id', null,['id' => 'client_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
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

    <script src="{{ URL::asset('assets/select2-3.5.1/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>    

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

			$("#client_id").select2({
				placeholder: 'Select Client',
				data: {{ $clients->toJson() }}
			});
            
            $("#client_id").select2("val", "{{ $location->client_id }}" );

        });
    </script>
@stop