@extends('layouts/default')

@section('css')
	@parent

	<link href="{{ URL::asset('assets/css/plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
@stop

@section('content')
    <section class="content-header">
        <h1>All Clients <small>List</small>
            <a href="{{ URL::route('clients.create') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i>New Client
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
             <li class="active">Clients</li>       
        </ol>        
    </section>

    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-clients">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                @if ($sortby == 'name' && $order == 'asc') 
                                    {{ link_to_action('ClientsController@index','Client',['sortby' => 'name','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ClientsController@index','Client',['sortby' => 'name','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i = $clients->getFrom(); ?>
                    	@foreach($clients as $client)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                                <td>{{ $i++ }}</td>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                        		<td>
                                    <a href="{{ URL::route('clients.show', $client->id)}}">{{ $client->name}}</a>
                                    <span class="pull-right">
                                        @if($client->reports()->count() > 0)
                                            <a href="{{ URL::route('clients.reports.list', $client->id)}}"> 
                                                <small class="badge bg-yellow">{{ $client->reports()->count() . " reports"}} </small>
                                            </a>
                                        @endif  

                                        @if($client->certificates()->count() > 0)
                                            <a href="{{ URL::route('clients.certificates.list', $client->id)}}"> 
                                                <small class="badge bg-teal">{{ $client->certificates()->count() . " certs"}} </small>
                                            </a>
                                        @endif     

                                        @if($client->items()->count() > 0)
                                            <a href="{{ URL::route('clients.items.list', $client->id)}}"> 
                                                <small class="badge bg-olive">{{ $client->items()->count() . " items"}} </small>
                                            </a>
                                        @endif
                                    </span>
                                </td>
                        		<td>
                                    <a href="{{ URL::route('clients.edit' , $client->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                </td>
                        	</tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->appends(Request::except('page'))->links() }}
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    </section>
@stop

@section('js')
	@parent

@stop