@extends('layouts/default')

@section('css')
	@parent

@stop

@section('content')

    <section class="content-header">
        <h1>All Items <small>List</small>
            <a href="{{ URL::route('items.create') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i> New Item
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
             <li class="active">Items</li>       
        </ol>        
    </section>

    <section class="content">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-items">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                @if ($sortby == 'serial_no' && $order == 'asc') 
                                    {{ link_to_action('ItemsController@index','Serial No',['sortby' => 'serial_no','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ItemsController@index','Serial No',['sortby' => 'serial_no','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'item_type.type' && $order == 'asc') 
                                    {{ link_to_action('ItemsController@index','Type',['sortby' => 'item_type.type','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ItemsController@index','Type',['sortby' => 'item_type.type','order' => 'asc']) }}
                                @endif                            
                            </th>
                            <th>
                                @if ($sortby == 'clients.name' && $order == 'asc') 
                                    {{ link_to_action('ItemsController@index','Client',['sortby' => 'clients.name','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ItemsController@index','Client',['sortby' => 'clients.name','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i = $items->getFrom(); ?>
                    	@foreach($items as $item)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                                <td>{{ $i++ }}</td>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                        		<td>{{ link_to_route('items.show', $item->serial_no, $item->id) }}</td>
                                <td>{{ $item->itemType->type }}</td>
                                <td><a href="{{ URL::route('clients.show' , $item->client_id) }}" >{{ $item->client->name }}</td></a>
                        		<td>
                                    <a href="{{ URL::route('items.edit' , $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
								</td>
                        	</tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->appends(Request::except('page'))->links() }}
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    </section>
@stop

@section('js')
	@parent

@stop