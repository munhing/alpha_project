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
    		Create Report <small>Form</small>
    	</h1>

        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>
                {{ link_to_route('reports', 'Reports')}}
            </li>
             <li class="active">New</li>       
        </ol>

    </section>

    <section class="content">

	{{ Form::open(array('files' => true, 'class' => 'form-horizontal', 'role' => 'form')) }}

		<div class="form-group">

			{{ Form::label('report_no', 'Report No:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('report_no', null, ['class' =>'form-control', 'placeholder' => 'Report No']) }}
				{{ $errors->first('report_no', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('type', 'Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::select('type', $types, null, ['class' =>'form-control', 'placeholder' => 'Type']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('client_id', 'Client:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('client_id', null,['id' => 'client_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('date', 'Date:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-3">
				{{ Form::text('date', null, ['class' =>'form-control', 'placeholder' => 'Date']) }}
				{{ $errors->first('date', '<span class="label label-danger">:message</span>') }}
			</div>
			<div class="col-sm-3">
				<div class="input-group">
				{{ Form::text('validity', null, ['class' =>'form-control', 'placeholder' => 'Validity']) }}
				<span class="input-group-addon">month(s)</span>
				</div>
				{{ $errors->first('validity', '<span class="label label-danger">:message</span>') }}
			</div>			
		</div>

		<div class="form-group">
			{{ Form::label('file', 'File:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::file('file', ['class' =>'form-control']) }}
				{{ $errors->first('file', '<span class="label label-danger">:message</span>') }}
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

	        $( "#date" ).datepicker( 
	        	{format: "dd/mm/yyyy" }
	        );

			$("#client_id").select2({
				placeholder: 'Select Client',
				data: {{ $clients->toJson() }}
			});

        });
    </script>
@stop