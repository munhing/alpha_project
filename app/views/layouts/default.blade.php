<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alpha Testing</title>

    @section('css')

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('assets/css/AdminLTE.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('assets/font-awesome-4.1.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show

</head>

<body class="skin blue pace-done skin-blue">

    @include('layouts/partials/_top')

    <div class="wrapper row-offcanvas row-offcanvas-left">

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts/partials/_side')


        <aside class="right-side">
        
            @include('layouts/notification')
            @yield('content')

        </aside>

    </div>



    @section('js')
    <!-- jQuery Version 2.1.1 -->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>

    <!-- jQuery UI Version 1.11.1 -->
    <script src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset('assets/js/AdminLTE/app.js') }}"></script>


    <script src="{{ URL::asset('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins/datatables/date-uk.js') }}"></script>


    <script type="text/javascript">
$(document).ready(function () {
        $('#flash-modal').modal();

        $("#s_report").click(function() {
            $('#form_search').append("<input type='hidden' name='s_type' value='report' />");
            $("#form_search").submit();
        });

        $("#s_cert").click(function() {
            $('#form_search').append("<input type='hidden' name='s_type' value='cert' />");
            $("#form_search").submit();
        });

        $("#s_item").click(function() {
            $('#form_search').append("<input type='hidden' name='s_type' value='item' />");
            $("#form_search").submit();
        });

        $("#s_client").click(function() {
            $('#form_search').append("<input type='hidden' name='s_type' value='client' />");
            $("#form_search").submit();
        });

});
    </script>

    @show

</body>

</html>
