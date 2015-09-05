@extends('clientviews/default')

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
        <h1>Item No: {{ $item->serial_no }} <small>{{ $item->client->name }}</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('client_home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
			<li>{{ link_to_route('client_items', 'Items') }}</li>
             <li class="active">{{ $item->serial_no }}</li>       
        </ol>			
    </section>

    <section class="content">
    <div class="row">
        <div class="col-lg-12">    
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Item Info</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

                    <dl class="dl-horizontal">
                        <dt>Client:</dt>
                        <dd>{{ $item->client->name }}</dd>                    
                        <dt>Type:</dt>
                        <dd>{{ $item->itemType->type }}</dd>
                        <dt>Description:</dt>
                        <dd>{{ $item->description }}</dd>   
                        <dt>Location:</dt>
                        <dd>
                            @if($item->location_id != 0)
                                <a href="{{ route('client_locations') }}">{{ $item->location->location }}</a>
                            @endif
                        </dd>                                                 
                    </dl>                     	
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="box box-solid box-info">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Reports</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

			 		@if(count($item->reports) > 0)
                    <div class="table-responsive">                 
	                    <table class="table table-striped table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Report No</th>
	                    			<th>Type</th>
	                    			<th>Date</th>
                                    <th>Next Inspection</th>
                                    <th>Status</th>
                                    <th>Action</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
								@foreach($item->reports as $report)
									<tr>
										<td>{{ link_to_route('client_report_show', $report->report_no, $report->id) }}</td>
										<td>{{ $report->type }}</td>
                                        <td>{{ $report->date->format('d/m/Y') }}</td>
										<td>{{ sanitizeNextInspectionDate($report->next_inspection) }}</td>
										<td>{{ statusForNextInspectionDate($report->next_inspection, $report->status) }}</td>
										<td>{{ isReportFileExist($report->filename) }}</td> 
									</tr>
								@endforeach
	                    	</tbody>
						</table>
                    </div>
						

					@else
						No reports found.								
					@endif
                </div>
                <!-- /.panel-body -->
            </div>
			
            <div class="box box-solid box-info">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Certificates</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

			 		@if(count($item->certificates) > 0)
                    <div class="table-responsive">                 
	                    <table class="table table-striped table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Cert No</th>
	                    			<th>Type</th>
	                    			<th>Date</th>
                                    <th>Next Inspection</th>
                                    <th>Status</th>
                                    <th>Action</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
								@foreach($item->certificates as $certificate)
									<tr>
										<td>{{ link_to_route('client_certificate_show', $certificate->cert_no, $certificate->id) }}</td>
										<td>
                                            @if($certificate->certificate_type_id != 0)
                                                {{ $certificate->certificateType->type }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $certificate->date->format('d/m/Y') }}</td>
										<td>{{ sanitizeNextInspectionDate($certificate->next_inspection) }}</td>
										<td>{{ statusForNextInspectionDate($certificate->next_inspection, $certificate->status) }}</td>
										<td>{{ isReportFileExist($certificate->filename) }}</td> 										
									</tr>
								@endforeach
	                    	</tbody>
						</table>
                    </div>
						

					@else
						No reports found.								
					@endif
                </div>
                <!-- /.panel-body -->
            </div>			
        </div>
        <!-- /.col-lg-8 -->

    </div>
    </section>
@stop