@extends('layout.main')
@section('content')

<section class="content-header">
                    <h1>
					<img src="../assets/img/icon/blue_external_drive_backup.png" alt="" width="26px"/>
                        Database backups
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Database backups</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-3">
                        <div class="box">
                                <div class="box-body">
                                	<a href="database-backups" class="btn btn-block btn-social btn-linkedin">
                                        <img src="../assets/img/icon/backup.png" alt="" width="16px"/> Start to backup
                                    </a>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop