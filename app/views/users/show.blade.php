@extends('layouts/default')

@section('content')

    <section class="content-header">
        <h1>User: {{ $user->fullname }} <small>{{ $user->client->name }}</small>
            <span class="pull-right">           
                {{ Form::open(['route' => ['user_delete', $user->id], 'style' => 'display:inline']) }}
                
                    {{ Form::hidden('user_id', $user->id) }}
                    <button class='btn btn-sm btn-danger' type='button' data-toggle="modal" data-target="#myModal" 
                            data-title="Delete User" 
                            data-body="Are you sure you want to delete this User?">
                        <i class='glyphicon glyphicon-trash'></i> Delete
                    </button>
                    
                {{ Form::close() }}

                <a href="{{ URL::route('user_edit', $user->id) }}" class="btn btn-sm btn-default">
                    <i class='fa fa-edit fa-fw'></i> Edit User
                </a>
            </span>
        </h1>
        
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('users', 'Users') }}</li>
             <li class="active">{{ $user->fullname }}</li>       
        </ol>          
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">    
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">User Information</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="box-body">

                        <dl class="dl-horizontal">                   
                            <dt>Username:</dt>
                            <dd>{{ $user->username }}</dd>
                            <dt>Email:</dt>
                            <dd>{{ $user->email }}</dd>                          
                        </dl>   
                     	
                    </div>
                    <div class="box-footer">
                        <a href="{{ URL::route('user_change_password', $user->id) }}" class="btn btn-default btn-block">Change Password</a>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">    
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Access to Client's Information</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="box-body">

                        @if(count($user->clients) > 0) 
                        <div class="table-responsive">                   
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>
                                                {{ Form::open(['route' => ['users.client.remove', $client->id], 'style' => 'display:inline']) }}
                                                {{ Form::hidden('user_id', $user->id) }}
                                                    <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#myModal" data-title="Remove Client" data-body="Are you sure you want to remove this client ?">
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
                            No Clients found.                               
                        @endif
                    </div>
                    <div class="box-footer">
                        <a href="{{ URL::route('users.client.add', $user->id) }}" class="btn btn-default btn-block">Add Client</a>
                    </div>
                    
                </div>
            </div>
        </div>        
    </section>
@stop

@section('js')
    @parent

    @include('layouts/partials/_remove')

@stop