@extends('layout.main')
@section('content') 
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> <i class="fa fa-globe"></i>&nbsp;Ad Networks <!-- <small>advanced tables</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Ad Networks
		</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="form-group" style="float:right;width:40%;">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success alert-dismissable">
                                                <i class="fa fa-check"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        @if(Session::has('warning'))
                                            <div class="alert alert-warning alert-dismissable">
                                                <i class="fa fa-warning"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('warning')}}
                                            </div>
                                        @endif
                                        @if(Session::has('danger'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('danger')}}
                                            </div>
                                        @endif
                                    </div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-body table-responsive">
					<ul class="cbp-ig-grid">
					@foreach($websites as $website)
					<li>
						<a>
							<span class="cbp-ig-icon"><img src="{{$website->logo}}" alt="{{$website->name}}" width="90%"/></span>
							<h3 class="cbp-ig-title">{{$website->name}}</h3>
							<span class="cbp-ig-category">{{$website->website}}</span>
						</a>
					</li>
					@endforeach
				</ul>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section><!-- /.content -->
@stop