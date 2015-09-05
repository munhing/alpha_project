@extends('clientviews/default')

@section('css')
	@parent
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatables/dataTables.bootstrap.css') }}" type="text/css" />
@stop

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
        <h1>All Reports for {{$location->location}}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('client_home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>
                <a href="{{ route('client_locations') }}">{{ $location->location }}</a>
            </li>
             <li class="active">Reports</li>       
        </ol>		
    </section>
    
    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Report No</th>
                            <th>Type</th>
							<th>Client</th>
                            <th>Date</th>
                            <th>Next Inspection</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($location->reports as $report)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                        		<td>{{ link_to_route('client_report_show', $report->report_no, $report->id) }}</td>
                                <td>{{ $report->type }}</td>
								<td>{{ $report->client->name }}</td>
                        		<td>{{ $report->date->format('d/m/Y') }}</td>
                        		<td>{{ sanitizeNextInspectionDate($report->next_inspection) }}</td>
                                <td>{{ statusForNextInspectionDate($report->next_inspection, $report->status) }}</td>
                                <td>{{ isReportFileExist($report->filename) }}</td>                                
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