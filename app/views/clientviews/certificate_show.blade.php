@extends('clientviews/default')

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
        <h1>Certificate No: {{ $certificate->cert_no }} <small>{{ $certificate->client->name }}</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('client_home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
			<li>{{ link_to_route('client_certificates', 'Certificates') }}</li>
             <li class="active">{{ $certificate->cert_no }}</li>       
        </ol>		
    </section>

    <section class="content">

    <div class="row">
        <div class="col-lg-10">    
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Certificate Info</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

                    <dl class="dl-horizontal">
                        <dt>Client:</dt>
                        <dd>{{ $certificate->client->name }}</dd>                     
                        <dt>Date:</dt>
                        <dd>{{ $certificate->date->format('d/m/Y') }}</dd>
                        <dt>Next Inspection:</dt>
                        <dd>{{ $certificate->next_inspection->format('d/m/Y') }} </dd>
                        <dt>Status:</dt>
                        <dd>
                            @if($certificate->status == 0)
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> Expired {{ $certificate->next_inspection->diffForHumans() }}</small>
                            @else
                                <small class="label label-success"><i class="fa fa-clock-o"></i> Expiring {{ $certificate->next_inspection->diffForHumans() }}</small>
                            @endif                         
                        </dd>                                                 
                    </dl>                       
                </div>
            </div>
        </div>

        <div class="col-lg-2">    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle fa-fw"></i> Uploaded File
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body text-center"><p class="text-center">
                    @if(!is_dir(public_path(). '/certificate_files/' . $certificate->filename ) && file_exists(public_path(). '/certificate_files/' . $certificate->filename ))

                        <a href="{{ URL::asset('/certificate_files/' . $certificate->filename) }}" target="_blank"><h1><i class="fa fa-file"></i></h1></a></p>
                    @else
                        File not found!
                    @endif             
                </p></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

		    <div class="box box-solid box-info">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i>
                    <h3 class="box-title">Items</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

			 		@if(count($certificate->items) > 0)    
                    <div class="table-responsive">                
	                    <table class="table table-striped table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Serial No</th>
	                    			<th>Type</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
								@foreach($certificate->items as $item)
									<tr>
										<td>{{ link_to_route('client_item_show', $item->serial_no, $item->id)  }}</td>
										<td>{{ $item->itemType->type }}</td>
									</tr>
								@endforeach
	                    	</tbody>
						</table>
                        </div>
						

					@else
						No items found.								
					@endif
                </div>
                <!-- /.panel-body -->
            </div>
			
            <div class="box box-solid box-info">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Report</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

			 		@if(count($certificate->reports) > 0)
                    @foreach($certificate->reports as $report)
                    <div class="table-responsive"> 
	                    <table class="table table-striped table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Report No</th>
	                    			<th>Type</th>
	                    			<th>Date</th>
                                    <th>Next Inspection</th>
                                    <th>Status</th>
                                    <td>Action</td>
	                    		</tr>
	                    	</thead>
	                    	<tbody>

								<tr>
									<td>{{ link_to_route('client_report_show', $report->report_no, $report->id) }}</td>
									<td>{{ $report->type }}</td>
                                    <td>{{ $report->date->format('d/m/Y') }}</td>
                                    <td>{{ sanitizeNextInspectionDate($report->next_inspection) }}</td>
                                    <td>{{ statusForNextInspectionDate($report->next_inspection, $report->status) }}</td>
                                    <td>{{ isReportFileExist($report->filename) }}</td>                                    
								</tr>

	                    	</tbody>
						</table>
                    </div>
						
                    @endforeach
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