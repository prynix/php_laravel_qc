@extends('layout.main')
@section('content')
<script type="text/javascript">
    $(function(){
        CKEDITOR.replace('email_message');
    });
</script>
<section class="content-header no-margin">
	<h1 class="text-center width-100-percent">
		Mailbox
	</h1>
</section>
<section class="content">
	<!-- Mailbox begin -->
	<div class="mailbox row">
		<div class="col-xs-12">
			<div class="box box-solid">
				<div class="box-body">
					<div class="row">
						<div class="col-md-3 col-sm-4">
							<div class="box-header">
								<i class="fa fa-inbox"></i>
								<h3 class="box-title">INBOX</h3>
							</div>
                            <!-- get message btn -->
                            <a class="btn btn-block btn-success" data-toggle="modal" data-target="#get-modal">
                                <i class="fa  fa-envelope-o"></i>&nbsp;Get Message
                            </a>
							<!-- compose message btn -->
							<a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal">
								<i class="fa fa-pencil"></i>&nbsp;Compose Message
							</a>
							<!-- Navigation - folders -->
							<div style="margin-top: 15px;">
								<ul class="nav nav-pills nav-stacked">
									<li class="header">Folders</li>
									<li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox ({{$amount}})</a></li>
                                    <li><a href="#"><i class="fa fa-pencil-square-o"></i> Drafts (0)</a></li>
                                    <li><a href="#"><i class="fa fa-mail-forward"></i> Sent (0)</a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> Starred (0)</a></li>
                                    <li><a href="#"><i class="fa fa-folder"></i> Junk (0)</a></li>
								</ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                                <div class="col-sm-6 no-padding">
                                                    <!-- <label style="margin-right: 10px;">
                                                        <input type="checkbox" id="check-all"/>
                                                    </label> -->
                                                    <!-- Action button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Mark as read</a></li>
                                                            <li><a href="#">Mark as unread</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Move to junk</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- /.row -->

                                            <div class="table-responsive">
                                                <!-- THE MESSAGES -->
                                                <table id="example6" class="table table-bordered table-striped">
                                                	<thead>
			                                            <tr>
                                                            <th>ID</th>
			                                            	<th style="width:21px;"></th>
			                                                <th>Name</th>
			                                                <th>Subject</th>
			                                                <th>Time</th>
                                                            <th></th>
			                                            </tr>
			                                        </thead>
                                        			<tbody>
                                                        @if(isset($emails))<?php //$x=new SimpleXmlElement($curlData); //print_r($curlData); ?>
                                                        @foreach($emails as $email)
	                                                    <tr>
                                                            <td align="center">{{$email->email_id}}</td>
	                                                        <td align="center">{{($email->seen==0)?'<span class="label label-success">Read</span>':'<span class="label label-warning">Unread</span>'}}</td>
	                                                        <td class="name">{{$email->from}}</td>
	                                                        <td class="subject">{{$email->subject}}</td>
	                                                        <td class="time">{{$email->date}}</td>
                                                            <td align="center"><a title="Show" data-toggle="modal" data-target="#modal-{{$email->id}}"><button class="btn-sm btn-default">
                                                                <i class="fa fa-search-plus"></i>
                                                            </button></a></td>
	                                                    </tr>
                                                        <!-- GET MESSAGE MODAL -->
                                                        <div class="modal fade" id="modal-{{$email->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Show E-mail</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="callout callout-info">
                                                                            <p><strong>From:</strong>&nbsp;{{$email->from}}</p>
                                                                            <p><strong>Date:</strong>&nbsp;{{date("H:i:s",strtotime($email->date))}}&nbsp;{{date('eO',strtotime($email->date))}}&nbsp;{{date('Y-m-d',strtotime($email->date))}}</p>
                                                                            <p><strong>To:</strong>&nbsp;{{$email->to}}</p>
                                                                            <p><strong>Subject:&nbsp;{{$email->subject}}</strong></p>
                                                                        </div>
                                                                        <div class="callout callout-info">
                                                                            <p>{{$email->body}}</p>
                                                                            <p><a href="{{$email->html_iframe}}" target="_blank">{{$email->html_iframe}}</a></p>
                                                                            <p>{{HTML::image($email->filename,'File attach',array('width'=>'100%'))}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        @endforeach
                                                        @else
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
			                                            <tr>
                                                            <th>ID</th>
			                                            	<th></th>
			                                                <th>Name</th>
			                                                <th>Subject</th>
			                                                <th>Time</th>
                                                            <th></th>
			                                            </tr>
			                                        </tfoot>
                                                </table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- GET MESSAGE MODAL -->
        <div class="modal fade" id="get-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Get Email</h4>
                    </div>
                    {{Form::open(array('url'=>'admin/get-email','method'=>'post'))}}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Username:</span>
                                    <input name="username" type="text" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Password:</span>
                                    <input name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" class="btn-sm btn-success pull-left"><i class="fa fa-envelope"></i> Get Email</button>
                        </div>
                    {{Form::close()}}
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="width:60%;height:100%;overflow-y:scroll;overflow-x:hidden;">
                <div class="modal-content">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom no-margin-bottom">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab_1" data-toggle="tab">Config mail</a></li>
                        <li class="active"><a href="#tab_2" data-toggle="tab">Send mail</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Log e-mail</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab_1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Current config</h3>
                                        </div>
                                        {{Form::open(array('url'=>'admin/config_mail'))}}
                                        <div class="box-body">
                                            <div class="form-group">
                                                {{Form::label('username','Username')}}&nbsp;<font color="#FF0000">*</font>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    {{Form::text('username',Input::old('username',$username),array('class'=>'form-control'))}}
                                                </div>
                                                @if($errors->first('username'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                     {{$errors->first('username')}} 
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password','Password')}}&nbsp;<font color="#FF0000">*</font>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    {{Form::input('password','password',$password,array('class'=>'form-control'))}}
                                                </div>
                                                @if($errors->first('password'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                     {{$errors->first('password')}} 
                                                </div>
                                                @endif
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" class="btn-sm btn-primary btnSaveChanges">
                                                <i class="fa fa-check-circle-o"></i>&nbsp;Save changes
                                            </button>
                                        </div>
                                    {{Form::close()}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">File configs</h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="form-group">
                                                <pre/>
                                                {{trim($content)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <div class="tab-pane active" id="tab_2">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
                            </div>
                            {{Form::open(array('url'=>'admin/send_mail','files'=>true))}}
                                <div class="modal-body">
                                    <div class="col-md-12 no-padding">
                                        <div class="form-group"> 
                                            <label>
                                                <input type="radio" name="how-to-submit" id="how-to-submit" value="1" checked/>
                                                Delivery by hand
                                            </label>&nbsp;
                                            <label>
                                                <input type="radio" name="how-to-submit" id="how-to-submit" value="2"/>
                                                Send automatically
                                            </label>
                                            <input type="hidden" name="selection" value="2"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding-left email_to">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">TO:</span>
                                                    <input name="email_to" type="email" class="form-control" placeholder="Email TO">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding-left no-padding-right list_mail" style="display:none;">
                                            <div class="form-group">
                                                <label>Advertiser's emails</label>
                                                <select multiple class="form-control" name="advertiser_mail">
                                                    @foreach($advertisers as $advertiser)
                                                        <option value="{{$advertiser->email}}">{{$advertiser->email}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="mails"></div>
                                                <!-- <a href class="btn-sm btn-success" id="check-email_exists"><i class="fa fa-check-circle"></i>&nbsp;Check e-mail exists online</a> -->
                                                @if(isset($html))
                                                    {{$html}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding-left email_cc">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">CC:</span>
                                                    <input name="email_cc" type="email" class="form-control" placeholder="Email CC">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding-left no-padding-right email_bcc">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">BCC:</span>
                                                    <input name="email_bcc" type="email" class="form-control" placeholder="Email BCC">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Subject:</span>
                                                <input name="subject" type="text" class="form-control" placeholder="Subject to">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="email_message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;display:none !important;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="download_template" target="__blank" id="download_template"><u>Download template</u></a><br/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{Form::file('filename',array('id'=>'file-1a','multiple'=>true,'class'=>'file','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}}                             
                                            <!--<div class="btn-sm">
                                                <i class="fa fa-paperclip"></i> Attachment
                                                <input type="file" name="attachment"/>
                                            </div>-->
                                        <p class="help-block">Max. 32MB</p>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                                    <button type="submit" class="btn-sm btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                                </div>
                            {{Form::close()}}
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-bug"></i> Logs</h4>
                            </div>
                            <div class="modal-body">
                                <!-- button check e-mail exist -->
                                <button id="check-email_exists" name="check-email_exists" class="btn-sm btn-primary">Check e-mail</button>
                                <div class ="mails"></div>
                                <?php 
                                    
                                ?>
                            </div>
                        </div>
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script type="text/javascript">
            $(function() {

                "use strict";

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });

                //When unchecking the checkbox
                $("#check-all").on('ifUnchecked', function(event) {
                    //Uncheck all checkboxes
                    $("input[type='checkbox']", ".table-mailbox").iCheck("uncheck");
                });
                //When checking the checkbox
                $("#check-all").on('ifChecked', function(event) {
                    //Check all checkboxes
                    $("input[type='checkbox']", ".table-mailbox").iCheck("check");
                });
                //Handle starring for glyphicon and font awesome
                /*$(".fa-star, .fa-star-o, .glyphicon-star, .glyphicon-star-empty").click(function(e) {
                    e.preventDefault();
                    //detect type
                    var glyph = $(this).hasClass("glyphicon");
                    var fa = $(this).hasClass("fa");

                    //Switch states
                    if (glyph) {
                        $(this).toggleClass("glyphicon-star");
                        $(this).toggleClass("glyphicon-star-empty");
                    }

                    if (fa) {
                        $(this).toggleClass("fa-star");
                        $(this).toggleClass("fa-star-o");
                    }
                });*/
            });
        </script>
@stop