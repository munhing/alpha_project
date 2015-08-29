@extends('layouts/default')

@section('css')
	@parent

	<link href="{{ URL::asset('assets/css/plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.core.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.tags.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.autocomplete.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.focus.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.prompt.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('assets/listbuilder/css/textext.plugin.arrow.css') }}" type="text/css" />


@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Group Items</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
   
    <textarea id="textarea" class="example" rows="1"></textarea>

    {{ Form::open(['route' => ['item_group_update', $item->id]]) }}
    <div class="row">
        <div class="col-lg-6">

            <div class="panel panel-green">
                <div class="panel-heading">
                    <i class="fa fa-info-circle fa-fw"></i> Assign Items as Group
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-items">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Serial No</th>
                            <th>Type</th>
                            <th>Group</th>

                        </tr>
                    </thead>
                    <tbody>

                    	@foreach($items as $item)
                    		<!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                        	<tr>
                        		<!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                                <td>{{ Form::checkbox("selected[$item->id]", $item->id) }}</td>
                        		<td>{{ link_to_route('item_show', $item->serial_no, $item->id) }}</a></td>
                                <td>{{ $item->itemType->type }}</a></td>
                        		<td>{{ $item->group }}</a></td>
                        	</tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
                    {{ link_to_route('items', 'Cancel') }}
                {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}




    

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

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#dataTables-items').dataTable();
		} );

    $('#textarea')
        .textext({
            plugins : 'autocomplete tags filter'
        })
        .bind('getSuggestions', function(e, data)
        {
            var list = [ 
            
            @foreach ($itemList as $item)
                {{ "'" . $item . "'," }}
            @endforeach 
            ],
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || ''
                ;

            $(this).trigger(
                'setSuggestions',
                { result : textext.itemManager().filter(list, query) }
            );
        })
        ;

	</script>
@stop