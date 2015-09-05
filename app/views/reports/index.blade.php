@extends('layouts/default')

@section('css')
	@parent

@stop

@section('content')

    <section class="content-header">
        <h1>All Reports <small>List</small>
            <a href="{{ URL::route('reports.create') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i>New Report
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
             <li class="active">Reports</li>       
        </ol>

    </section>
    
    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                @if ($sortby == 'report_no' && $order == 'asc') 
                                    {{ link_to_action('ReportsController@index','Report No',['sortby' => 'report_no','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ReportsController@index','Report No',['sortby' => 'report_no','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'type' && $order == 'asc') 
                                    {{ link_to_action('ReportsController@index','Type',['sortby' => 'type','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ReportsController@index','Type',['sortby' => 'type','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'clients.name' && $order == 'asc') 
                                    {{ link_to_action('ReportsController@index','Client',['sortby' => 'clients.name','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ReportsController@index','Client',['sortby' => 'clients.name','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'date' && $order == 'asc') 
                                    {{ link_to_action('ReportsController@index','Date',['sortby' => 'date','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ReportsController@index','Date',['sortby' => 'date','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'next_inspection' && $order == 'asc') 
                                    {{ link_to_action('ReportsController@index','Next Inspection',['sortby' => 'next_inspection','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('ReportsController@index','Next Inspection',['sortby' => 'next_inspection','order' => 'asc']) }}
                                @endif                                                    
                            </th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i = $reports->getFrom(); ?>
                    	@foreach($reports as $report)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                                <td>{{ $i++ }}</td>
                        		<td>{{ link_to_route('reports.show', $report->report_no, $report->id) }}</a></td>
                                <td>{{ $report->type }}</td>
                        		<td><a href="{{ URL::route('clients.show' , $report->client_id) }}" >{{ $report->client->name }}</td></a>
                        		<td>{{ $report->date->format('d/m/Y') }}</td>
                        		<td>{{ sanitizeNextInspectionDate($report->next_inspection) }}</td>
                                <td>{{ statusForNextInspectionDate($report->next_inspection, $report->status) }} </td>
                        		<td>
                                    <a href="{{ URL::route('reports.edit' , $report->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    {{ isReportFileExist($report->filename) }}
								</td>
                        	</tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            {{ $reports->appends(Request::except('page'))->links() }}
        </div>
        <!-- /.col-lg-12 -->
    </div>
</section>
@stop

@section('js')
	@parent

@stop