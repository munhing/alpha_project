@extends('clientviews/default')

@section('css')
    @parent

@stop

@section('content')

    <section class="content-header">
        <h1>Search results for: {{ $search }} </h1>
    </section>

<section class="content">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">

            <div class="list-group">
                @foreach($searchResults as $result)
                    <a href="{{ URL::route($result->getClientReportingUrl(), $result->id) }}" class="list-group-item">{{ $result->getSearchName() }}
                        <small class="badge pull-right bg-maroon">{{ $result->getType() }} </small>
                    </a>
                @endforeach
            </div>
            <!-- /.list-group -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</section>
@stop

@section('js')
    @parent

@stop

<!-- //reports link  reports/{id}/show -->
<!-- //certificates link  certificates/{id}/show -->
<!-- //items link  items/{id}/show -->
<!-- //client link  clients/{id}/show -->