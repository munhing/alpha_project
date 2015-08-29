@extends('layouts/default')


@section('content')

    <section class="content-header">
        <h1>Create New Client <small>Form</small>
        	<a href="{{ URL::previous() }}" class="btn btn-sm pull-right btn-default"><i class='fa fa-arrow-left fa-fw'></i> Back</a>
        </h1>
    </section>
    <!-- /.row -->

    <section class="content">
	{{ Form::open(array('route' => 'clients', 'class' => 'form-horizontal', 'role' => 'form')) }}

		<div class="form-group">
			{{-- Client Name field. ------------------------}}
			{{ Form::label('name', 'Client Name:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('name', null, ['class' =>'form-control', 'placeholder' => 'Client Name']) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				{{ $errors->first('name', '<span class="label label-danger">:message</span>') }}
			</div>			
		</div>

		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-6">
    			<a href="{{ URL::route('clients') }}" class="btn btn-danger">Cancel</a>
				{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
			</div>
		</div>

	{{ Form::close() }}
	</section>

@stop
