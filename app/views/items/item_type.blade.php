@extends('layouts/default')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatables/dataTables.bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header">
        <h1>Item Type<small>List</small>
            <a href="{{ URL::route('items.type.create') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i>New Item Type
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
             <li class="active">Item Types</li>       
        </ol>          
    </section>
    
    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($itemType->count())
                        @foreach($itemType as $type)
                            <!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                            <tr>
                                <!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                                <td>{{ $type->type }}</td>
                                <td>
                                    <a href="{{ URL::route('items.type.edit' , $type->id) }}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a> 

                                    {{ Form::open(['route' => ['items.type.delete', $type->id], 'style' => 'display:inline']) }}
                                    {{ Form::hidden('type_id', $type->id) }}
                                        <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#myModal" 
                                                data-title="Remove Item Type" 
                                                data-body="Are you sure you want to remove this Item Type?">
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