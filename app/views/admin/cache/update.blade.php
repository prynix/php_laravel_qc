@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>
		<i class="fa fa-adjust"></i>
        Update cache
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update cache</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Switch cache zone</h3>
                </div>
                <div class="box-body clearfix width-100-percent">
                    <button class="btn btn-primary width-100-percent"><i class="fa fa-refresh"></i>&nbsp;Re-update</button>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Switch cache website</h3>
                </div>
                <div class="box-body clearfix width-100-percent">
                    <button class="btn btn-primary width-100-percent"><i class="fa fa-refresh"></i>&nbsp;Re-update</button>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
@stop