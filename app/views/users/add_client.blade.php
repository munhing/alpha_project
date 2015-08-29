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
            User: {{ $user->fullname }} <small>{{ $user->client->name }}</small>
        </h1>
		
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>
                {{ link_to_route('users', 'Users')}}
            </li>
             <li>{{ link_to_route('user_show', $user->fullname, $user->id) }}</li>
             <li class="active">Add Client</li>       
        </ol>
    </section>

    <section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Select from client list
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    {{ Form::open(array('route' => ['users.client.add', $user->id], 'role' => 'form')) }}

                    <div class="form-group">
                        {{ Form::text('selectedClients', null,['id' => 'selectedClients', 'class' => 'form-control', 'autocomplete' => 'off']) }}
                        {{ $errors->first('selectedClients', '<span class="label label-danger">:message</span>') }}
                    </div>

                    <div class="form-group">                       

                        {{ Form::submit('Add Clients', ['class' => 'btn btn-primary']) }}
                      
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
                    <i class="fa fa-info-circle fa-fw"></i> Clients
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="list-group">
                        
                        @foreach($user->clients as $client)
                            <div  class="list-group-item">
                                {{ $client->name }}
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

             $("#selectedClients").select2({
                placeholder: 'Select Clients',
                multiple: true,
                data: {{ $clients->toJson() }}
             });

        });
    </script>
@stop