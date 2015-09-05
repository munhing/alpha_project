@extends('clientviews/default')

@section('css')
	@parent
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatables/dataTables.bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
        <h1>All Locations</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('client_home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
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
                            <th>Locations</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($locations as $location)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                        		<td>
                                    {{ $location->location}}
                                    <span class="pull-right">
                                        @if($location->reports()->count() > 0)
                                            <a href="{{ URL::route('client_location_reports_list', $location->id)}}"> 
                                                <small class="badge bg-yellow">{{ $location->reports()->count() . " reports"}} </small>
                                            </a>
                                        @endif  

                                        @if($location->certificates()->count() > 0)
                                            <a href="{{ URL::route('client_location_certificates_list', $location->id)}}"> 
                                                <small class="badge bg-teal">{{ $location->certificates()->count() . " certs"}} </small>
                                            </a>
                                        @endif     

                                        @if($location->items()->count() > 0)
                                            <a href="{{ URL::route('client_location_items_list', $location->id)}}"> 
                                                <small class="badge bg-olive">{{ $location->items()->count() . " items"}} </small>
                                            </a>
                                        @endif
                                    </span>
                                </td>
                        	</tr>
                        @endforeach
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

    <script src="{{ URL::asset('assets/js/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins/datatables/jquery.dataTables.js') }}"></script>

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