@extends('layouts/default')


@section('content')

    <section class="content-header">
        <h1>{{ $client->name }} <small>Edit</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('clients', 'Clients') }}</li>
            <li>{{ link_to_route('clients.show', $client->name, $client->id) }}</li>
             <li class="active">Edit</li>       
        </ol>           
    </section>

    <section class="content">

	{{ Form::open(array('route' => 'clients.update', 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) }}
		{{ Form::hidden('id', $client->id) }}
		<div class="form-group">
			{{-- Client Name field. ------------------------}}
			{{ Form::label('name', 'Client Name:', ['class' =>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				{{ Form::text('name', $client->name, ['class' =>'form-control', 'placeholder' => 'Client Name']) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-1">
				{{ $errors->first('name', '<span class="label label-danger">:message</span>') }}
			</div>			
		</div>

		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-2">
				
				{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
			</div>			
		</div>

	{{ Form::close() }}
	</section>

@stop
