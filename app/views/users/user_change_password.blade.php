@extends('layouts/default')

@section('content')

    <section class="content-header">
        <h1>User: {{ $user->fullname }} <small>{{ $user->client->name }}</small></h1>
        
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>
                {{ link_to_route('users', 'Users')}}
            </li>
             <li>{{ link_to_route('user_show', $user->fullname, $user->id) }}</li>
             <li class="active">Change Password</li>       
        </ol>        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">    
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Password Change</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="box-body">

                    {{ Form::open(array('route' => ['user_change_password', $user->id], 'role' => 'form')) }}

                        <div class="form-group">
                            {{ Form::password('password', ['class' =>'form-control', 'placeholder' => 'Password']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::password('password_confirmation', ['class' =>'form-control', 'placeholder' => 'Confirm Password']) }}
                        </div>
                        
                        <div class="form-group">
                            
                            {{ Form::submit('Change', ['class' => 'btn btn-primary']) }}
                        </div>

                    {{ Form::close() }}
                     	
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