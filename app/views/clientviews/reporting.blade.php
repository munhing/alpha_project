@extends('clientviews/default')

@section('css')
	@parent
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatables/dataTables.bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
        <h1>{{ ucwords($info[0]) . " " . ucwords($info[1]) }}</h1>
    </section>
    
    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ str_replace('s', '', ucwords($info[1])) }} No</th>
                            <th>Type</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Next Inspection</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($reporting as $report)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                        		<td>{{ link_to_route($report->getClientReportingUrl(), $report->getReportingNo(), $report->id) }}</td>
                                <td>{{ $report->getReportingType() }}</td>
                                <td>{{ $report->client->name }}</td>
                        		<td>{{ $report->date->format('d/m/Y') }}</td>
                                <td>{{ sanitizeNextInspectionDate($report->next_inspection) }}</td>
                                <td>
                                    @if($info[0] == 'expiring')
                                        <small class="label label-warning"><i class="fa fa-clock-o"></i> Expiring {{ $report->next_inspection->diffForHumans() }}</small>
                                    @else
                                        <small class="label label-success"><i class="fa fa-clock-o"></i> Created {{ $report->date->diffForHumans() }}</small>
                                    @endif                                     
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