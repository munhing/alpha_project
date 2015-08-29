@extends('layouts/default')

@section('css')
	@parent

	<link href="{{ URL::asset('assets/css/plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
@stop

@section('content')
    <section class="content-header">
        <h1>All Users <small>List</small>
            <a href="{{ URL::route('register') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i>New User
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li class="active">Users</li>       
        </ol>          
    </section>

    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
				<?php $i = 1; ?>
                <table class="table table-striped table-bordered table-hover" id="dataTables-clients">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
							<th>Client</th>
							<th>Email</th>
							<th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($users->count())
    					@foreach($users as $user)
    					<tr>
    						<td>{{ $i++ }}</td>
    						<td>{{ link_to_route('user_show', $user->fullname, $user->id) }}</td>
                            <td>{{ $user->username }}</td>
    						<td>{{ $user->client->name }}</td>						
    						<td>{{ $user->email }}</td>
    						<td>{{ $user->roles->first()->name }}</td>
    					</tr>
    					@endforeach
                    @else
                        No users found!
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    </section>
@stop

@section('js')
	@parent

@stop