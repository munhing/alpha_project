@extends('layouts/default')

@section('css')
	@parent

	<link rel="stylesheet" href="{{ URL::asset('assets/css/datatables/dataTables.bootstrap.css') }}" type="text/css" />
@stop

@section('content')
    <section class="content-header">
        <h1>Client: {{ $client->name }} <small>Certificates Listing</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
            <li>{{ link_to_route('clients', 'Clients') }}</li>
            <li>{{ link_to_route('clients.show', $client->name, $client->id) }}</li>
             <li class="active">Certificates Listing</li>       
        </ol>    
    </section>

    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($client->certificates as $cert)
                            <!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                            <tr>
                                <!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                                <td>
                                    {{ link_to_route('certificates.show', $cert->cert_no, $cert->id)  }}
                                </td>

                            </tr>
                        @endforeach
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
    <script src="{{ URL::asset('assets/js/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins/datatables/jquery.dataTables.js') }}"></script>

    <script type="text/javascript">
        $('#data-table').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    </script>
@stop