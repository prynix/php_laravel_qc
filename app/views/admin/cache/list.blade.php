@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>
		<i class="fa fa-adjust"></i>
        List cache
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List cache</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-body">
                	@foreach($list as $li)
                    <div class="callout callout-danger">
                        <p><strong>zone_{{$li}}</strong></p>
                    </div>
                    @endforeach
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
@stop