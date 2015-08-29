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
             <li class="active">Add Items</li>       
        </ol>
    </section>

    <section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Method 1: Select from listed items
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    {{ Form::open(array('route' => ['reports.items.add', $report->id], 'role' => 'form')) }}

                    <div class="form-group">
                        {{ Form::text('selectedItems', null,['id' => 'selectedItems', 'class' => 'form-control', 'autocomplete' => 'off']) }}
                        {{ $errors->first('selectedItems', '<span class="label label-danger">:message</span>') }}
                    </div>

                    <div class="form-group">                       

                        {{ Form::submit('Add Item', ['class' => 'btn btn-primary']) }}
                      
                    </div>                    

                    {{ Form::close() }}

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


            <div class="panel panel-default">
                <div class="panel-heading">
                    Method 2: Create New Item
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    {{ Form::open(array('route' => ['reports.item.create', $report->id], 'class' => 'form-horizontal', 'role' => 'form')) }}
                        {{ Form::hidden('client_id', $report->client_id) }}
                        <div class="form-group">

                            {{ Form::label('serial_no', 'Serial No:', ['class' =>'col-sm-3 control-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('serial_no', null, ['class' =>'form-control', 'placeholder' => 'Serial No']) }}
                                {{ $errors->first('serial_no', '<span class="label label-danger">:message</span>') }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('item_type_id', 'Type:', ['class' =>'col-sm-3 control-label']) }}
                            <div class="col-sm-6">
                                {{ Form::select('item_type_id', $itemTypes, null, ['class' =>'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('description', 'Description:', ['class' =>'col-sm-3 control-label']) }}
                            <div class="col-sm-6">
                                {{ Form::textarea('description', null, ['class' =>'form-control', 'placeholder' => 'Description']) }}
                                {{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
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
                    <i class="fa fa-info-circle fa-fw"></i> Items
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="list-group">
                        
                        @foreach($report->items as $item)
                            <div  class="list-group-item">
                                {{ $item->serial_no }}
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

    <script src="{{ URL::asset('assets/select2-3.5.1/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>
    

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

             $("#selectedItems").select2({
                placeholder: 'Select Items',
                multiple: true,
                data: {{ $items->toJson() }}
             });

        });
    </script>
@stop