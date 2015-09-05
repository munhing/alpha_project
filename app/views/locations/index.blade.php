@extends('layouts/default')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatables/dataTables.bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header">
        <h1>Location<small>List</small>
            <a href="{{ URL::route('locations.create') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i>New Location
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
             <li class="active">Locations</li>       
        </ol>          
    </section>
    
    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Client</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($locations->count())
                        @foreach($locations as $location)
                            <!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                            <tr>
                                <!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                                <td>
                                    {{ $location->location }}
                                    <span class="pull-right">
                                        @if($location->reports()->count() > 0)
                                            <a href="{{ URL::route('locations.reports.list', $location->id)}}"> 
                                                <small class="badge bg-yellow">{{ $location->reports()->count() . " reports"}} </small>
                                            </a>
                                        @endif  

                                        @if($location->certificates()->count() > 0)
                                            <a href="{{ URL::route('locations.certificates.list', $location->id)}}"> 
                                                <small class="badge bg-teal">{{ $location->certificates()->count() . " certs"}} </small>
                                            </a>
                                        @endif     

                                        @if($location->items()->count() > 0)
                                            <a href="{{ URL::route('locations.items.list', $location->id)}}"> 
                                                <small class="badge bg-olive">{{ $location->items()->count() . " items"}} </small>
                                            </a>
                                        @endif
                                    </span>                                    
                                </td>
                                <td>{{ $location->client->name }}</td>
                                <td>
                                    <a href="{{ URL::route('locations.edit' , $location->id) }}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a> 

                                    {{ Form::open(['route' => ['locations.delete', $location->id], 'style' => 'display:inline']) }}
                                    {{ Form::hidden('location_id', $location->id) }}
                                        <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#myModal" 
                                                data-title="Remove Location" 
                                                data-body="Are you sure you want to remove this Location?">
                                            <i class='glyphicon glyphicon-trash'></i>
                                        </button>
                                    {{ Form::close() }} 

                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</section>
@stop

@section('js')
    @parent
    @include('layouts/partials/_remove')
    <script type="text/javascript">

        $('#data-table').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });        
        
    </script>
@stop