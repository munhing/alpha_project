<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Alpha Testing | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/font-awesome-4.1.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        
        <!-- Theme style -->
        <link href="{{ URL::asset('assets/css/AdminLTE.css') }}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>


            {{ Form::open(array('route' => 'login')) }}           

                <div class="body bg-gray">
                    
                    @if(Session::get('error'))
                        <div class="form-group">
                        <div class="alert alert-danger">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('error') }}
                        </div></div>
                    @endif

                    @if(Session::get('notice'))
                        <div class="form-group">
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('notice') }}
                        </div></div>
                    @endif


                        <div class="alert alert-info">
                            <strong>Admin Page</strong><br />
                            Username: admin, Password: admin<br />
                            <strong>Client Page</strong><br />
                            Username: swire, Password: swire
                        </div>              

                    <div class="form-group">
                        {{ Form::text('email', null, ['class' =>'form-control', 'placeholder' => 'Username or Email']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['class' =>'form-control', 'placeholder' => 'Password']) }}
                    </div>          
                    <div class="form-group">
                        {{ Form::hidden('remember', '0') }}
                        {{ Form::checkbox('remember', '1') }}
                        Remember me
                        
                    </div>
                </div>
                <div class="footer">
                    {{ Form::submit('Login', ['class' => 'btn bg-olive btn-block']) }}                                                            
                    
                    <p>
                        {{ link_to_route('forgot_password', 'I forgot my password') }}
                    </p>
                    

                </div>

            {{ Form::close() }}





        </div>

        <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

    </body>
</html>
