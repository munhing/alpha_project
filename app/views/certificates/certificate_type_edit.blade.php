@extends('layouts/default')

@section('content')

    <section class="content-header">
    	<h1>Certificate Type: {{ $certificateType->type }}<small>Edit</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('certificates.type', 'Certificate Types') }}</li>
             <li class="active">Edit</li>       
        </ol>       	
    </section>

    <section class="content">

	{{ Form::open(array('route' => ['certificates.type.edit', $certificateType->id], 'class' => 'form-horizontal', 'role' => 'form')) }}
		{{ Form::hidden('id', $certificateType->id) }}
		<div class="form-group">

			{{ Form::label('type', 'Certificate Type:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('type', $certificateType->type, ['class' =>'form-control', 'placeholder' => 'Certificate Type']) }}
				{{ $errors->first('type', '<span class="label label-danger">:message</span>') }}
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