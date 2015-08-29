@extends('layouts/default')

@section('content')

    <section class="content-header">
    	<h1>
    		Create Report Type <small>Form</small>
    	</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('reports.type', 'Report Types')}}</li>          
            <li class="active">New</li>       
        </ol>    	
    </section>

    <section class="content">

	{{ Form::open(array('route' => 'reports.type.create', 'class' => 'form-horizontal', 'role' => 'form')) }}

		<div class="form-group">

			{{ Form::label('type', 'Report Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('type', null, ['class' =>'form-control', 'placeholder' => 'Report Type']) }}
				{{ $errors->first('type', '<span class="label label-danger">:message</span>') }}
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