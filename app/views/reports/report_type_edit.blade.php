@extends('layouts/default')

@section('content')

    <section class="content-header">
    	<h1>Report Type: {{ $reportType->type }}<small>Edit</small>
    		<a href="{{ URL::previous() }}" class="btn btn-sm pull-right btn-default"><i class='fa fa-arrow-left fa-fw'></i> Back</a>
    	</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('reports.type', 'Report Types')}}</li>          
            <li class="active">Edit</li>       
        </ol>    	
    </section>

    <section class="content">

	{{ Form::open(array('route' => ['reports.type.update', $reportType->id], 'class' => 'form-horizontal', 'role' => 'form')) }}
		{{ Form::hidden('id', $reportType->id) }}
		<div class="form-group">

			{{ Form::label('type', 'Report Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('type', $reportType->type, ['class' =>'form-control', 'placeholder' => 'Report Type']) }}
				{{ $errors->first('type', '<span class="label label-danger">:message</span>') }}
			</div>
		</div>
	
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-6">
    			<a href="{{ URL::route('reports.type') }}" class="btn btn-danger">Cancel</a>
				{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
			</div>
		</div>

	{{ Form::close() }}
	</section>
@stop