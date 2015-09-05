@extends('layouts/default')

@section('content')

    <section class="content-header">
        <h1>Report No: {{ $report->report_no }} <small>{{ $report->client->name }}</small> 
            <span class="pull-right">           
                {{ Form::open(['route' => ['reports.delete', $report->id], 'style' => 'display:inline']) }}
                
                    {{ Form::hidden('report_id', $report->id) }}
                    <button class='btn btn-sm btn-danger' type='button' data-toggle="modal" data-target="#myModal" 
                            data-title="Delete Report" 
                            data-body="Are you sure you want to delete this Report?">
                        <i class='glyphicon glyphicon-trash'></i> Delete
                    </button>
                    
                {{ Form::close() }}        
                
                <a href="{{ URL::route('reports.edit', $report->id) }}" class="btn btn-sm btn-default">
                    <i class='fa fa-edit fa-fw'></i>Edit
                </a>
            </span>
        </h1>
		

        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>
                {{ link_to_route('reports', 'Reports')}}
            </li>
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
                        <dt>Client:</dt>
                        <dd><a href="{{ URL::route('clients.show' , $report->client_id) }}">{{ $report->client->name }}</a></dd>
                        <dt>Report Type:</dt>
                        <dd>{{ $report->type }}</dd>
                        <dt>Report Date:</dt>
                        <dd>{{ $report->date->format('d/m/Y') }}</dd>
                        <dt>Next Inspection:</dt>
                        <dd>
                            @if($report->next_inspection->year < 0)
                                -
                            @else
                                {{ $report->next_inspection->format('d/m/Y') }}
                            @endif
                        </dd>   
                        <dt>Status:</dt>
                        <dd>
                            @if($report->status == 0)
                                @if($report->next_inspection->year < 0)
                                    <small class="label label-warning"><i class="fa fa-clock-o"></i> No expiration date </small>
                                @else
                                    <small class="label label-danger"><i class="fa fa-clock-o"></i> Expired {{ $report->next_inspection->diffForHumans() }}</small>
                                @endif                            
                            @else
                                <small class="label label-success"><i class="fa fa-clock-o"></i> Expiring {{ $report->next_inspection->diffForHumans() }}</small>
                            @endif                         
                        </dd>
                        <dt>Location:</dt>
                        <dd>
                            @if($report->location_id != 0)
                                <a href="{{ route('locations') }}">{{ $report->location->location }}</a>
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
                        {{ Form::open(['route' => ['reports.file.remove', $report->id], 'style' => 'display:inline']) }}
                            <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#myModal" data-title="Remove File" data-body="Are you sure you want to remove this file?">
                                <i class='glyphicon glyphicon-trash'></i>  Remove File 
                            </button>
                        {{ Form::close() }}                        
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
	                    			<th>Actions</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
								@foreach($report->items as $item)
									<tr>
										<td>{{ link_to_route('items.show', $item->serial_no, $item->id)  }}</td>
										<td>{{ $itemTypes[$item->item_type_id] }}</td>
										<td>
                                            {{ Form::open(['route' => ['reports.item.remove', $report->id], 'style' => 'display:inline']) }}
                                            {{ Form::hidden('item_id', $item->id) }}
                                                <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#myModal" data-title="Remove Item" data-body="Are you sure you want to remove item # {{ $item->serial_no }} ?">
                                                    <i class='glyphicon glyphicon-trash'></i>
                                                </button>
                                            {{ Form::close() }}
                                        </td>
									</tr>
								@endforeach
	                    	</tbody>
						</table>
                        </div>
						

					@else
						No items found.								
					@endif
					<a href="{{ URL::route('reports.items.add', $report->id) }}" class="btn btn-default btn-block">Add Item</a>
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
										<td>{{ link_to_route('certificates.show', $certificate->cert_no, $certificate->id) }}</td>
                                        <td>
                                            @if($certificate->certificate_type_id == 0)
                                                -
                                            @else
                                                {{ $certificateTypes[$certificate->certificate_type_id] }}
                                            @endif
                                        </td>
                                        <td>{{ $certificate->date->format('d/m/Y') }}</td>
                                        <td>
                                            @if($certificate->next_inspection->year < 0)
                                                -
                                            @else
                                                {{ $certificate->next_inspection->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($certificate->next_inspection->year < 0)
                                                <small class="label label-warning"><i class="fa fa-clock-o"></i> No Status </small>
                                            @else
                                                @if($certificate->status == 0)
                                                    <small class="label label-danger"><i class="fa fa-clock-o"></i> Expired</small>
                                                @else
                                                    <small class="label label-success"><i class="fa fa-clock-o"></i> Active</small>
                                                @endif
                                            @endif                                                                                
                                        </td>
                                        <td>
                                            {{ Form::open(['route' => ['reports.certificate.remove', $report->id], 'style' => 'display:inline']) }}
                                            {{ Form::hidden('certificate_id', $certificate->id) }}
                                                <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#myModal" data-title="Remove Certificate" data-body="Are you sure you want to remove Certificate # {{ $certificate->cert_no }} ?">
                                                    <i class='glyphicon glyphicon-trash'></i>
                                                </button>
                                            {{ Form::close() }}

                                            @if(!is_dir(public_path(). '/certificate_files/' . $certificate->filename ) && file_exists(public_path(). '/certificate_files/' . $certificate->filename ))
                                                <a href="{{ URL::asset('/certificate_files/' . $certificate->filename) }}" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text-o"></i></a></p>
                                            @endif                                                                                 
                                        </td>
									</tr>
								@endforeach
	                    	</tbody>
						</table>
						</div>

					@else
						No certificate found.								
					@endif
					<a href="{{ URL::route('reports.certificates.add', $report->id) }}" class="btn btn-default btn-block">Add Certificate</a>
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

