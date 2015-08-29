@extends('clientviews/default')

@section('content')

    <section class="content-header">
        <h1>Report No: {{ $report->report_no }} <small>{{ $report->client->name }}</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('client_home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
			<li>{{ link_to_route('client_reports', 'Reports') }}</li>
             <li class="active">{{ $report->report_no }}</li>       
        </ol>			
    </section>

<section class="content">

    <div class="row">
        <div class="col-lg-10">    
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Report Info</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

                    <dl class="dl-horizontal">
                        <dt>Report Type:</dt>
                        <dd>{{ $report->type }}</dd>
                        <dt>Report Date:</dt>
                        <dd>{{ $report->date->format('d/m/Y') }}</dd>
                        <dt>Next Inspection:</dt>
                        <dd>{{ $report->next_inspection->format('d/m/Y') }}</dd>   
                        <dt>Status:</dt>
                        <dd>
                            @if($report->status == 0)
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> Expired {{ $report->next_inspection->diffForHumans() }}</small>
                            @else
                                <small class="label label-success"><i class="fa fa-clock-o"></i> Expiring {{ $report->next_inspection->diffForHumans() }}</small>
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
                <div class="panel-body text-center">
					@if(!is_dir(public_path(). '/report_files/' . $report->filename ) && file_exists(public_path(). '/report_files/' . $report->filename ))

						<a href="{{ URL::asset('/report_files/' . $report->filename) }}" target="_blank"><h1><i class="fa fa-file"></i></h1></a></p>
					@else
						File not found!
					@endif             
                </div>
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

			 		@if(count($report->items) > 0)    
                    <div class="table-responsive">                
	                    <table class="table table-striped table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Serial No</th>
	                    			<th>Type</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
								@foreach($report->items as $item)
									<tr>
										<td>{{ link_to_route('client_item_show', $item->serial_no, $item->id)  }}</td>
										<td>{{ $itemType[$item->item_type_id] }}</td>
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
                    <i class="fa fa-info-circle fa-fw"></i>
                    <h3 class="box-title">Certificates</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">

			 		@if(count($report->certificates) > 0) 
                    <div class="table-responsive">                   
	                    <table class="table table-striped table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Certificate No</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Next Inspection</th>
                                    <th>Status</th>
                                    <th>Action</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
								@foreach($report->certificates as $certificate)
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
                                        <td>{{ isCertificateFileExist($certificate->filename) }}</td> 
									</tr>
								@endforeach
	                    	</tbody>
						</table>
						</div>

					@else
						No certificate found.								
					@endif
					
                </div>
                <!-- /.panel-body -->
            </div>

        </div>
        <!-- /.col-lg-8 -->

    </div>
</section>



@stop

@section('js')
    @parent

    @include('layouts/partials/_remove')

@stop

