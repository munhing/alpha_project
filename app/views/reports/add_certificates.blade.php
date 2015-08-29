@extends('layouts/default')

@section('css')
 
     @parent   

    <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.core.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.tags.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.autocomplete.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.focus.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.prompt.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.arrow.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/select2-3.5.1/select2-bootstrap.css') }}" type="text/css" />

    <link href="{{ URL::asset('assets/datepicker/css/datepicker.css') }}" rel="stylesheet">

@stop

@section('content')

<section class="content-header">
    <h1>
        Report No: {{ $report->report_no }} <small>{{ $report->client->name }}</small> 
    </h1>
	
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>
                {{ link_to_route('reports', 'Reports')}}
            </li>
             <li>{{ link_to_route('reports.show', $report->report_no, $report->id) }}</li>
             <li class="active">Add Certificates</li>       
        </ol>    
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Method 1: Select from a list of certificates
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    {{ Form::open(array('route' => ['reports.certificates.add', $report->id], 'role' => 'form')) }}

                    <div class="form-group">
                        {{ Form::text('selectedCerts', null,['id' => 'selectedCerts', 'class' => 'form-control', 'autocomplete' => 'off']) }}
                        {{ $errors->first('selectedCerts', '<span class="label label-danger">:message</span>') }}
                    </div>

                    <div class="form-group">                       

                        {{ Form::submit('Add Certificates', ['class' => 'btn btn-primary']) }}
                      
                    </div>                    

                    {{ Form::close() }}

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


            <div class="panel panel-default">
                <div class="panel-heading">
                    Method 2: Create New Certificate
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    {{ Form::open(array('route' => ['reports.certificate.create', $report->id], 'class' => 'form-horizontal', 'role' => 'form')) }}
                        {{ Form::hidden('client_id', $report->client_id ) }}
                        <div class="form-group">
                            {{ Form::label('cert_no', 'Certificate No:', ['class' =>'col-sm-3 control-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('cert_no', null, ['class' =>'form-control', 'placeholder' => 'Certificate No']) }}
                                {{ $errors->first('cert_no', '<span class="label label-danger">:message</span>') }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('certificate_type_id', 'Type:', ['class' =>'col-sm-3 control-label']) }}
                            <div class="col-sm-6">
                                {{ Form::select('certificate_type_id', $certificateTypes, null,['id' => 'certificate_type_id', 'class' => 'form-control', 'autocomplete' => 'off']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('date', 'Date:', ['class' =>'col-sm-3 control-label']) }}
                            <div class="col-sm-3">
                                {{ Form::text('date', null, ['class' =>'form-control', 'placeholder' => 'Date']) }}
                                {{ $errors->first('date', '<span class="label label-danger">:message</span>') }}
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                {{ Form::text('validity', null, ['class' =>'form-control', 'placeholder' => 'Validity']) }}
                                <span class="input-group-addon">month(s)</span>
                                </div>
                                {{ $errors->first('validity', '<span class="label label-danger">:message</span>') }}
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>

                    {{ Form::close() }}

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>

        <div class="col-lg-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle fa-fw"></i> Certificates
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="list-group">
                        
                        @foreach($report->certificates as $cert)
                            <div  class="list-group-item">
                                {{ $cert->cert_no }}
                            </div>
                        @endforeach
                        
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('js')
    @parent

    <script src="{{ URL::asset('assets/listbuilder/js/textext.core.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.tags.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.autocomplete.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.suggestions.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.filter.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.focus.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.prompt.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.ajax.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('assets/listbuilder/js/textext.plugin.arrow.js') }}" type="text/javascript" charset="utf-8"></script>
    
    <script src="{{ URL::asset('assets/datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ URL::asset('assets/select2-3.5.1/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">   

        $(document).ready(function() {

            $( "#date" ).datepicker( 
                {format: "dd/mm/yyyy" }
            );

             $("#selectedCerts").select2({
                placeholder: 'Select Certificates',
                multiple: true,
                data: {{ $certificates->toJson() }}
             });
           
        });
    </script>
@stop