@extends('layouts/default')


@section('content')

	<section class="content-header">
        <h1>Client: {{ $client->name }} <small>Information</small> 
            <span class="pull-right">           
                {{ Form::open(['route' => ['clients.delete', $client->id], 'style' => 'display:inline']) }}
                
                    {{ Form::hidden('client_id', $client->id) }}
                    <button class='btn btn-sm btn-danger' type='button' data-toggle="modal" data-target="#myModal" 
                            data-title="Delete Client" 
                            data-body="Are you sure you want to delete this Client?">
                        <i class='glyphicon glyphicon-trash'></i> Delete
                    </button>
                    
                {{ Form::close() }}        
                
                <a href="{{ URL::route('clients.edit', $client->id) }}" class="btn btn-sm btn-default">
                    <i class='fa fa-edit fa-fw'></i>Edit
                </a>
            </span>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('clients', 'Clients') }}</li>
             <li class="active">{{ $client->name }}</li>       
        </ol>          
    </section>

	<section class="content-header">
	    <div class="row">
	        <div class="col-lg-12">    
	            <div class="box box-solid box-primary">
	                <div class="box-header">
	                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Client Information</h3>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="box-body">
						No further information.                   	
	                </div>
	            </div>
	        </div>
	    </div>

		<div class="row">
			@if($client->reports()->count() > 0)
	        <div class="col-lg-4 col-xs-6">
	            <div class="small-box bg-yellow">
	                <div class="inner">
	                    <h3>{{ $client->reports()->count() }}</h3>
	                    <p>
	                        Reports
	                    </p>
	                </div>
	                <div class="icon">
	                    <i class="fa fa-file-o"></i>
	                </div>
	                <a href="{{ URL::route('clients.reports.list', $client->id) }}" class="small-box-footer">
	                    More info <i class="fa fa-arrow-circle-right"></i>
	                </a>
	            </div>
	        </div>
	        @endif 

	        @if($client->certificates()->count() > 0)
	        <div class="col-lg-4 col-xs-6">
	            <!-- small box -->
	            <div class="small-box bg-teal">
	                <div class="inner">
	                    <h3>
	                        {{ $client->certificates()->count() }}
	                    </h3>
	                    <p>
	                        Certificates
	                    </p>
	                </div>
	                <div class="icon">
	                    <i class="fa fa-file-text-o"></i>
	                </div>
	                <a href="{{ URL::route('clients.certificates.list', $client->id) }}" class="small-box-footer">
	                    More info <i class="fa fa-arrow-circle-right"></i>
	                </a>
	            </div>
	        </div><!-- ./col -->
	        @endif

	        @if($client->items()->count() > 0)
	        <div class="col-lg-4 col-xs-6">
	            <!-- small box -->
	            <div class="small-box bg-olive">
	                <div class="inner">
	                    <h3>
	                        {{ $client->items()->count() }}
	                    </h3>
	                    <p>
	                        Items
	                    </p>
	                </div>
	                <div class="icon">
	                    <i class="fa fa-gears"></i>
	                </div>
	                <a href="{{ URL::route('clients.items.list', $client->id) }}" class="small-box-footer">
	                    More info <i class="fa fa-arrow-circle-right"></i>
	                </a>
	            </div>
	        </div>
	        @endif

	    </div>	    

    </section>

@stop

@section('js')
    @parent

    @include('layouts/partials/_remove')

@stop