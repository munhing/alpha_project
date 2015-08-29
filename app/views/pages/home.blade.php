@extends('layouts/default')

<!-- @section('css')
	@parent
	<link href="assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
@stop -->

@section('content')

    <section class="content-header">
        <h1>Dashboard</h1>
    </section>

    <section class="content">

	<div class="row">

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $newReportsCount->first()->total }}</h3>
                    <p>
                        New Reports!
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-o"></i>
                </div>
                <a href="{{ URL::route('reporting', 'new_reports') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        {{ $newCertsCount->first()->total }}
                    </h3>
                    <p>
                        New Certificates!
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-o"></i>
                </div>
                <a href="{{ URL::route('reporting', 'new_certificates') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        {{ $expReportsCount->first()->total }}
                    </h3>
                    <p>
                        Expiring Reports!
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-o"></i>
                </div>
                <a href="{{ URL::route('reporting', 'expiring_reports') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        {{ $expCertsCount->first()->total }}
                    </h3>
                    <p>
                        Expiring Certificates!
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-o"></i>
                </div>
                <a href="{{ URL::route('reporting', 'expiring_certificates') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

    </div>


    <div class="row">
        <div class="col-lg-12">
	<div class="jumbotron">
		<h1>Welcome to Alpha Testing!</h1>
		<p>
			This is a custom made web application to store and to track all our reports, certificates and items for easy
			access and retrieval.
		</p>
	</div>
	</div></div>

</section>
@stop