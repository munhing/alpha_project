@extends('layouts/default')

@section('content')

    <section class="content-header" style="padding-bottom:20px;">
    	<h1>Settings <small>Information</small></h1>
    </section>

    <section class="content">

	    <div class="row">
	        <div class="col-lg-6">    
	            <div class="box box-solid box-primary">
	                <div class="box-header">
	                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Report</h3>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="box-body">

				   		<div class="form-horizontal">

							<div class="form-group">
								{{ Form::label('new_report_days', 'Number of Days consider as New:', ['class' =>'col-sm-6 control-label']) }}

								<div class="col-sm-6">
									<div class="input-group">
									{{ Form::text('new_report_days', null, ['class' =>'form-control', 'placeholder' => '# of days']) }}
									<span class="input-group-addon">day(s)</span>
									</div>
									{{ $errors->first('new_report_days', '<span class="label label-danger">:message</span>') }}
								</div>			
							</div>

							<div class="form-group">
								{{ Form::label('exp_report_days', 'Number of Days before Expires:', ['class' =>'col-sm-6 control-label']) }}

								<div class="col-sm-6">
									<div class="input-group">
									{{ Form::text('exp_report_days', null, ['class' =>'form-control', 'placeholder' => '# of days']) }}
									<span class="input-group-addon">day(s)</span>
									</div>
									{{ $errors->first('exp_report_days', '<span class="label label-danger">:message</span>') }}
								</div>			
							</div>
							
							<div class="form-group">
					    		<div class="col-sm-offset-2 col-sm-6">

									{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6">    
	            <div class="box box-solid box-primary">
	                <div class="box-header">
	                    <i class="fa fa-info-circle fa-fw"></i> <h3 class="box-title">Certificates</h3>
	                </div>
	                <!-- /.panel-heading -->
	                <div class="box-body">

				   		{{ Form::open(array('route' => 'settings', 'class' => 'form-horizontal', 'role' => 'form')) }}

							<div class="form-group">
								{{ Form::label('new_cert_days', 'Number of Days consider as New:', ['class' =>'col-sm-6 control-label']) }}

								<div class="col-sm-6">
									<div class="input-group">
									{{ Form::text('new_cert_days', null, ['class' =>'form-control', 'placeholder' => '# of days']) }}
									<span class="input-group-addon">day(s)</span>
									</div>
									{{ $errors->first('new_cert_days', '<span class="label label-danger">:message</span>') }}
								</div>			
							</div>

							<div class="form-group">
								{{ Form::label('exp_cert_days', 'Number of Days before Expires:', ['class' =>'col-sm-6 control-label']) }}

								<div class="col-sm-6">
									<div class="input-group">
									{{ Form::text('exp_cert_days', null, ['class' =>'form-control', 'placeholder' => '# of days']) }}
									<span class="input-group-addon">day(s)</span>
									</div>
									{{ $errors->first('exp_cert_days', '<span class="label label-danger">:message</span>') }}
								</div>			
							</div>
							
							<div class="form-group">
					    		<div class="col-sm-offset-2 col-sm-6">

									{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
@stop
