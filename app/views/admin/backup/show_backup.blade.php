@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>
		<i class="fa fa-inbox"></i>
        Show data backup
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Show data backup</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                	@foreach($list as $li)
                	<div class="callout callout-info">
                		<p><strong>{{$li}}</strong></p>
                	</div>
                	@endforeach
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
@stop