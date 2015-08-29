@extends('layouts/default')

@section('content')

    <section class="content-header">
    	<h1>Create Certificate Type <small>Form</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('certificates.type', 'Certificate Types') }}</li>
             <li class="active">New</li>       
        </ol>      	
    </section>

    <section class="content">

	{{ Form::open(array('route' => 'certificates.type.create', 'class' => 'form-horizontal', 'role' => 'form')) }}

		<div class="form-group">

			{{ Form::label('type', 'Certificate Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('type', null, ['class' =>'form-control', 'placeholder' => 'Certificate Type']) }}
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