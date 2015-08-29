@extends('layouts/default')

@section('content')

    <section class="content-header">
        <h1>Item No: {{ $item->serial_no }} <small>{{ $item->client->name }}</small>
            <span class="pull-right">           
                {{ Form::open(['route' => ['items.delete', $item->id], 'style' => 'display:inline']) }}
                
                    {{ Form::hidden('item_id', $item->id) }}
                    <button class='btn btn-sm btn-danger' type='button' data-toggle="modal" data-target="#myModal" 
                            data-title="Delete Item" 
                            data-body="Are you sure you want to delete this Item?">
                        <i class='glyphicon glyphicon-trash'></i> Delete
                    </button>
                    
                {{ Form::close() }}

                <a href="{{ URL::route('items.edit', $item->id) }}" class="btn btn-sm btn-default">
                    <i class='fa fa-edit fa-fw'></i> Edit Item
                </a>
            </span>
        </h1>
        
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('items', 'Items') }}</li>
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
                            <dt>Type:</dt>
                            <dd>{{ $item->itemType->type }}</dd>
                            <dt>Description:</dt>
                            <dd>{{ $item->description }}</dd>                          
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
    										<td>{{ link_to_route('reports.show', $report->report_no, $report->id) }}</td>
    										<td>{{ $report->type }}</td>
                                            <td>{{ $report->date->format('d/m/Y') }}</td>
                                            <td>{{ sanitizeNextInspectionDate($report->next_inspection) }}</td>
                                            <td>{{ statusForNextInspectionDate($report->next_inspection, $report->status) }} </td>
                                            <th>{{ isReportFileExist($report->filename) }} </th>
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

        <div class="row">
            <div class="col-lg-12">

                <div class="box box-solid box-info">
                    <div class="box-header">
                        <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Certificates</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="box-body">

                        @if($item->certificates->count() > 0)
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
                                    @foreach($item->certificates as $certificate)
                                        <tr>
                                            <td>{{ link_to_route('certificates.show', $certificate->cert_no, $certificate->id) }}</td>
                                            <td>
                                                @if($certificate->certificate_type_id == 0)
                                                    -
                                                @else
                                                    {{ $itemTypes[$certificate->certificate_type_id] }} 
                                                @endif
                                            </td>
                                            <td>{{ $certificate->date->format('d/m/Y') }}</td>
                                            <td>{{ sanitizeNextInspectionDate($certificate->next_inspection) }}</td>
                                            <td>{{ statusForNextInspectionDate($certificate->next_inspection, $certificate->status) }} </td>
                                            <th>{{ isReportFileExist($certificate->filename) }} </th>
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

@section('js')
    @parent

    @include('layouts/partials/_remove')

@stop