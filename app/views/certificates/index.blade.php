@extends('layouts/default')

@section('css')
    @parent

@stop

@section('content')

    <section class="content-header">
        <h1>All Certificates<small>List</small>
            <a href="{{ URL::route('certificates.create') }}" class="btn btn-sm pull-right btn-default">
                <i class='fa fa-plus fa-fw'></i> New Certificate
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class='fa fa-home fa-fw'></i>Home</a>
            </li>
             <li class="active">Certificates</li>       
        </ol>        
    </section>
    
    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                @if ($sortby == 'cert_no' && $order == 'asc') 
                                    {{ link_to_action('CertificatesController@index','Certificate No',['sortby' => 'cert_no','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('CertificatesController@index','Certificate No',['sortby' => 'cert_no','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'clients.name' && $order == 'asc') 
                                    {{ link_to_action('CertificatesController@index','Client',['sortby' => 'clients.name','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('CertificatesController@index','Client',['sortby' => 'clients.name','order' => 'asc']) }}
                                @endif                            
                            </th>
                            <th>
                                @if ($sortby == 'certificates.date' && $order == 'asc') 
                                    {{ link_to_action('CertificatesController@index','Date',['sortby' => 'certificates.date','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('CertificatesController@index','Date',['sortby' => 'certificates.date','order' => 'asc']) }}
                                @endif
                            </th>
                            <th>
                                @if ($sortby == 'certificates.next_inspection' && $order == 'asc') 
                                    {{ link_to_action('CertificatesController@index','Next Inspection',['sortby' => 'certificates.next_inspection','order' => 'desc']) }}
                                @else 
                                    {{ link_to_action('CertificatesController@index','Next Inspection',['sortby' => 'certificates.next_inspection','order' => 'asc']) }}
                                @endif                                                      
                            </th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i = $certificates->getFrom(); ?>
                        @foreach($certificates as $cert)
                            <!--  link_to_route({name of the route}, {link name}, {value to pass to the route})  -->
                            <tr>
                                <!-- <td> link_to_route('client_show', $client->name, $client->id) </a></td> -->
                                <td>{{ $i++ }}</td>
                                <td>{{ link_to_route('certificates.show', $cert->cert_no, $cert->id) }}</a></td>
                                <td><a href="{{ URL::route('clients.show' , $cert->client_id) }}" >{{ $cert->client->name }}</td></a>
                                <td>{{ $cert->date->format('d/m/Y') }}</a></td>
                                <td>{{ sanitizeNextInspectionDate($cert->next_inspection) }}</td>
                                <td>{{ statusForNextInspectionDate($cert->next_inspection, $cert->status) }} </td>
                                <td>
                                    <a href="{{ URL::route('certificates.edit' , $cert->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    {{ isCertificateFileExist($cert->filename) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $certificates->appends(Request::except('page'))->links() }}
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</section>
@stop

@section('js')
    @parent

@stop