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
    		Certificate No: {{ $certificate->cert_no }} <small>{{ $certificate->client->name }}</small> 
    	</h1>
		
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('certificates', 'Certificates') }}</li>
            <li>{{ link_to_route('certificates.show', $certificate->cert_no , $certificate->id) }}</li>
             <li class="active">Edit</li>       
        </ol>    		
    </section>

    <section class="content">

	{{ Form::open(array('route' => 'certificates', 'method' => 'PUT', 'files' => 'true', 'class' => 'form-horizontal', 'role' => 'form')) }}
		{{ Form::hidden('id', $certificate->id) }}
		{{ Form::hidden('filename', $certificate->filename) }}
		<div class="form-group">

			{{ Form::label('cert_no', 'Certificate No:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('cert_no', $certificate->cert_no, ['class' =>'form-control', 'placeholder' => 'Certificate No']) }}
				{{ $errors->first('cert_no', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('client_id', 'Client:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('client_id', null,['id' => 'client_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('certificate_type_id', 'Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::select('certificate_type_id', $certificateTypes, $certificate->certificate_type_id,['id' => 'certificate_type_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('date', 'Date:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-3">
				{{ Form::text('date', $certificate->date->format('d/m/Y'), ['class' =>'form-control', 'placeholder' => 'Date']) }}
				{{ $errors->first('date', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('validity', 'Validity:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-3">
				<div class="input-group">
				{{ Form::text('validity', $certificate->validity, ['class' =>'form-control', 'placeholder' => 'Validity']) }}
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
    			
				{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
			</div>
		</div>

		@if(!is_dir(public_path(). '/certificate_files/' . $certificate->filename ) && file_exists(public_path(). '/certificate_files/' . $certificate->filename ))
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-6">
					<a class="btn btn-info btn-circle btn-xl" href="{{ URL::asset('/certificate_files/' . $certificate->filename) }}" target="_blank"><i class="fa fa-file"></i></a>
				</div>
			</div>
		@endif
									
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

			$("#client_id").select2("val", "{{ $certificate->client_id }}" );
        });
    </script>

@stop