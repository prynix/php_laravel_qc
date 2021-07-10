@extends('layout.main') @section('content')
<!-- Content Header (Page header) -->
<script type="text/javascript">
    //$('.left-side').addClass('collapse-left');
    //$('.right-side').addClass('strech');
</script>
<section class="content-header">
	<h1 style="color: #f39c12;">
		RSS Feed
		<!-- <small>advanced tables</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="website"> Websites</a></li>
		<li class="active">RSS Feed</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-2">
			<div class="box box-warning">
				<div id="slide" class="well"
					style="display: none; top: 15%; width: 50%;">
					<div class="row">
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box">
								<div class="box-header" style="padding-bottom: 0;">
									<h3 class="box-title">Add new RSS - Feed</h3>
								</div>
								{{Form::open(array('url'=>'admin/rss-feed-'.$website_id))}}
								<div class="box-body">
									<div class="form-group">
										{{Form::label('feed_name','Feed Name')}}&nbsp;<font
											color="#FF0000">*</font>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-rss-square"></i></span>
											{{Form::text('feed_name',Input::old('feed_name'),array('class'=>'form-control','placeholder'=>'Enter
											...'))}}
										</div>
										<p class="help-block">Optional. No more than 20 characters</p>
									</div>
									<div class="form-group">
										{{Form::label('feed_address','Feed Address')}}&nbsp;<font
											color="#FF0000">*</font>
										<div class="input-group">
											<span class="input-group-addon"><i
												class="fa fa-external-link"></i></span>
											{{Form::text('feed_address',Input::old('feed_address'),array('class'=>'form-control','placeholder'=>'Enter
											...'))}}
										</div>
									</div>
									<div class="form-group">
										{{Form::label('category_id','Category')}} <select
											data-placeholder="-- Select --" class="chosen-select"
											tabindex="1" name="category_id">
											<option value="0">Other</option> @foreach($categories as
											$category)
											<option value="{{$category->id}}">{{$category->category_name}}
											</option> @endforeach()


										</select>
									</div>
									<div class="form-group">
										{{Form::label('period','Period')}} <select
											class="form-control" name="period" style="width: auto;">
											<option value="1">1 day</option>
											<?php
        for ($i = 2; $i <= 5; $i ++) {
            echo '<option value="' . $i . '">' . $i . '&nbsp;days</option>';
        }
        ?>
										</select>
									</div>
									{{Form::submit('Create',array('class'=>'btn
									bg-maroon','style'=>'margin-right:10px;'))}}
									<button class="slide_close btn bg-black">Close</button>
								</div>
								{{Form::close()}}
							</div>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
					<a href="#" style="display: inline-block; margin-bottom: 10px;"
						class="slide_open btn btn-block btn-social btn-warning"
						title="Add new RSS - Feed"><i class="fa fa-plus"></i>Add new RSS -
						Feed</a>
					<ul id="menu">
						<li><a href="#">Feed actived</a>
							<ul>
								@foreach($topics as $topic) <?php $count=0; ?> @if($topic->status==1)
								@foreach($number_adbanners as $number_adbanner)
									@if($number_adbanner->topic_id==$topic->id) <?php $count++; ?>
									@endif @endforeach 
								<li><a href="rss-banner-{{$website_id}}-{{$topic->id}}">{{$topic->feed_name}}&nbsp;<?php echo '('.$count.')'; ?></a></li>
								@endif @endforeach()
							</ul></li>
						<li><a href="#">Feed banned</a>
							<ul>
								@foreach($topics as $topic) @if($topic->status==0)
								<li><a href="rss-banner-{{$website_id}}-{{$topic->id}}">{{$topic->feed_name}}</a></li>
								@endif @endforeach()
							</ul></li>
						<li><a href="rss-feed-{{$website_id}}">All banners&nbsp;({{$all_actived_ads}})</a></li>
					</ul>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<a href="#code" style="display: inline-block; margin-bottom: 10px;"
						class="btn btn-block btn-social btn-warning"
						title="Recognized exchange code" data-toggle="modal"><i
						class="fa fa-code"></i>Recognized exchange code</a>
				</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- end box 2 -->
		<div class="col-xs-10">
			<div class="box box-warning">
				<div class="box-header" style="padding-bottom: 0;">
					<a href="#"
						style="display: inline-block; margin: 10px 10px 0 10px;"><button
							class="btn bg-yellow">Actived Ads&nbsp;({{$actived_ads}})</button></a>
					@if(is_string($topic_selected))
						<a href="rss-feed_banner_banned-{{$website_id}}-0"
						style="display: inline-block; margin: 10px 10px 0 0;"><button
							class="btn btn-default">Banned Ads&nbsp;({{$banned_ads}})</button></a>
					@else
						<a href="rss-feed_banner_banned-{{$website_id}}-{{$topic_selected->id}}"
						style="display: inline-block; margin: 10px 10px 0 0;"><button
							class="btn btn-default">Banned Ads&nbsp;({{$banned_ads}})</button></a>
					@endif
					@if(is_string($topic_selected))
						<a href="rss-feed_banner_stopped-{{$website_id}}-0"
						style="display: inline-block; margin: 10px 10px 0 0;"><button
							class="btn btn-default">Stopped Ads&nbsp;({{$stopped_ads}})</button></a>				
					@else
						<a href="rss-feed_banner_stopped-{{$website_id}}-{{$topic_selected->id}}"
						style="display: inline-block; margin: 10px 10px 0 0;"><button
							class="btn btn-default">Stopped Ads&nbsp;({{$stopped_ads}})</button></a>
					@endif
				</div>
				<div class="box-body table-responsive">
					<h4 style="color: #5087be;">
						<!-- kiá»ƒm tra xem Ä‘á»‘i tÆ°á»£ng cÃ³ pháº£i lÃ  1 chuá»—i hay khÃ´ng (is_string <> is_array) -->
						@if(is_string($topic_selected)) {{$topic_selected}} @else
						{{$topic_selected->feed_name}} @endif
						@if(is_string($topic_selected)) @else <span
							style="margin-left: 20px; color: #333; font-size: 14px; font-weight: normal;">
							Operating time of banner is</span> <span
							style="margin-left: 20px; color: #bd3a4c; font-size: 14px; font-weight: normal;">
							{{$topic_selected->period}}&nbsp;{{($topic_selected->period<2?'day':'days')}}</span>
						@endif
					</h4>
					<table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th align="left">Banner</th>
								<th>Status</th>
								<th>Expire Date</th>
								<th>CTR</th>
								<th>Click</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($adbanners as $adbanner)
							<tr>
								<td align="center">{{$adbanner->id}}</td>
								<td>{{HTML::image($adbanner->imagefile,'',array('onerror'=>"this.onerror=null;this.src='http://localhost/l4-bbad/public/assets/img/icon/no_image.jpg'",'width'=>'50px'))}}
<!-- 								<img src="{{$adbanner->imagefile}}" alt="" width="50px" />-->
									&nbsp;<a href="{{$adbanner->adbanner_link}}" target="_blank">{{$adbanner->adbanner_title}}</a></td>
								<!-- <td align="center">@if($adbanner->status==1) <span
									class="label label-success">Active</span> @elseif($adbanner->status==-1) <span
									class="label label-warning">Banned</span> @else <span
									class="label label-danger">Stopped</span> @endif
								</td> -->
								<td align="center">
									<p class="field switch" style="display:inherit;">
										@if($adbanner->status==1) 
											<label for="radio1" class="cb-enable selected radioButtonEnableBanner" id="{{$adbanner->id}}"><span>Enable</span></label>
											<label for="radio2" class="cb-disable radioButtonDisableBanner" id="{{$adbanner->id}}"><span>Disable</span></label>
										@else 
											<label for="radio1" class="cb-enable radioButtonEnableStatus" id="{{$adbanner->id}}"><span>Enable</span></label>
											<label for="radio2" class="cb-disable selected radioButtonDisableStatus" id="{{$adbanner->id}}"><span>Disable</span></label>
										@endif
									</p>
								</td>
								<td align="center">{{$adbanner->expire_date}}</td>
								<td align="center">{{$adbanner->CTR}}%</td>
								<td align="center">{{$adbanner->click}}</td>
								<td align="center"><a href="{{URL::to('admin/rss-deny_adbanner-'.$website_id.'-'.$adbanner->id)}}">{{HTML::image('assets/img/icon/block-20.png','Deny',array('title'=>'Deny','width'=>'20px'))}}</a></td>
								<td align="center"><a href="#myModal-{{$adbanner->id}}" title=""
									data-toggle="modal">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
								<td align="center"><a
									href="{{URL::to('admin/rss-delete_adbanner-'.$website_id.'-'.$adbanner->id)}}" title="" onclick="return confirm('Are you sure you want to move this banner to the Stopped Ads? \n{{str_replace('"','',$adbanner->adbanner_title)}} \nDate modified: {{$adbanner->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>
							</tr>
							<!-- Modal -->
							<div class="modal fade" id="myModal-{{$adbanner->id}}"
								tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
								aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box">
														<div class="box-header" style="padding-bottom: 0;">
															<h3 class="box-title">Edit Banner</h3>
														</div>
														<div class="box-body">
														{{Form::open(array('url'=>'admin/rss-banner-edit-'.$website_id.'-'.$adbanner->id,'files'=>true))}}
															<div class="form-group">
																<a href="{{$adbanner->adbanner_link}}" target="_blank">{{$adbanner->adbanner_link}}</a>
															</div>
															<div class="form-group">
																{{Form::label('adbanner_title','Banner title')}}
																<div class="input-group">
																	<span class="input-group-addon"><i
																		class="fa fa-rss-square"></i> </span>
																	{{Form::text('adbanner_title',Input::old('adbanner_title',$adbanner->adbanner_title),array('class'=>'form-control','placeholder'=>'Enter
																	...'))}}
																</div>
															</div>
															<div class="form-group">
																{{Form::label('imagefile','Banner Image')}}<br />
																{{HTML::image("$adbanner->imagefile",'',array('style'=>'margin-bottom:10px;','width'=>'106px'))}}
																{{Form::file('imagefile')}}
																<!-- ,array('id'=>'file-1a','multiple'=>true,'class'=>'file','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}} -->
																{{Form::input('hidden','image_name',Input::old('image_name'))}}
															</div>
															<div class="form-group">
																{{Form::label('expire_date','Expire Date')}}
																<div class="input-group">
																	<span class="input-group-addon"><i
																		class="fa fa-clock-o"></i></span>
																	<?php $expire_date=explode(' ',$adbanner->expire_date)[0]; ?>
																	{{Form::text('expire_date',Input::old('expire_date',$expire_date),array('class'=>'form-control expire_date','style'=>'width:auto;'))}}
																</div>
															</div>
															{{Form::submit('Edit',array('class'=>'btn
															bg-maroon','style'=>'margin-right:10px;'))}}
															<button class="slide_close btn bg-black"
																data-dismiss="modal">Close</button>
														{{Form::close()}}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
							@endforeach()
						</tbody>
						<tfoot>
							<tr>
								<th>ID</th>
								<th align="left">Banner</th>
								<th>Status</th>
								<th>Expire Date</th>
								<th>CTR</th>
								<th>Click</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="code" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:60%;height:90%;margin-top:0px;">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-6">
						<!-- general form elements -->
						<div class="box box-warning">
							<div class="box-header" style="padding-bottom: 0;">
								<h3 class="box-title">Receive code</h3>
							</div>
							{{Form::open(array('url'=>'','files'=>true))}}
							<div class="box-body">
								<div class="form-group">
									{{Form::label('display_style','Display style:')}}
									<div class="radio">
<!-- 										<label> -->
										{{HTML::image('assets/img/icon/size_vertical.png','vertical',array('id'=>'vertical_style','style'=>'cursor:pointer;'))}}&nbsp;Vertical
<!-- 										<input type="radio" name="display_style" -->
<!-- 											class="vertical flat-red" value="1" checked/>&nbsp;Theo hàng -->
<!-- 											dọc</label> -->
									</div>
									<div class="radio">
<!-- 										<label> -->
										{{HTML::image('assets/img/icon/size_horizontal.png','horizontal',array('id'=>'horizontal_style','style'=>'cursor:pointer;opacity:0.4;'))}}&nbsp;Horizontal
<!-- 										<input type="radio" name="display_style" -->
<!-- 											class="horizontal flat-red" value="1" />&nbsp;Theo hàng ngang</label> -->
									</div>
									<div class="radio">
										{{HTML::image('assets/img/icon/link-external-32.png','Ads Link',array('id'=>'ads_link_style','style'=>'cursor:pointer;opacity:0.4;'))}}&nbsp;Ads Link
									</div>
                                                                        <input type="hidden" name="style" id="style" value="2"/>
								</div>
								<div class="form-group">
									{{Form::label('number_ads','Number of ads: ')}} <select
										name="number_ads">
    											     <?php
                    for ($i = 3; $i <= 9; $i ++) {
                        if ($i == 6) {
                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                        } else {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                    ?>  
											         </select>
								</div>
							</div>
							{{Form::close()}}
						</div>
					</div>
					<!-- /.end col-xs-6 -->
					<div class="col-xs-6">
						<div class="box box-warning">
							<div class="box-body">
								<div class="form-group">{{Form::label('code_block','Code
									block')}}
									{{Form::textarea('code_block',Input::old('code_block'),array('class'=>'form-control','placeholder'=>'','rows'=>7,'style'=>'resize:none;'))}}
								</div>
							</div>
						</div>
					</div>
					<!-- /.end col-xs-6 -->
					<div class="col-xs-12">
						<div class="box box-warning box-display" style="overflow-x:hidden;overflow-y:hidden;">
							<div class="box-header" style="padding-bottom: 0;">
								<h3 class="box-title">Display banners</h3>
							</div>
							<div class="box-body clearfix">
							     <div class="vertical_display">
							         <ul class="clearfix" style="width:340px;height:414px;padding:0;overflow-y:scroll;">
							             <li style="float:left;width:100%;height:138px;padding:5px;border-bottom:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;height:138px;padding:5px;border-bottom:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;height:138px;padding:5px;border-bottom:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;height:138px;padding:5px;border-bottom:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;height:138px;padding:5px;border-bottom:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;height:138px;padding:5px;border-bottom:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							         </ul>
							     </div>
							     <div class="horizontal_display" style="display:none;">
							         <ul class="clearfix" style="width:1740px;padding:0;">
							             <li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;border-left:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;">
							                 <a href="" target="_blank" style="float:left;">{{HTML::image('assets/img/icon/picture.png','iLink')}}</a>
							                 <p style="margin-left:133px;margin-top:20px;">
							                     <a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							         </ul>
							     </div>
							     <div class="ads_link_display" style="display:none;">
							     	<ul class="clearfix" style="width:100%;padding:0;">
							             <li style="float:left;width:100%;padding:1% 0;">
							                 <p>
							                     {{HTML::image('assets/img/icon/link.png','iLink')}}&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;padding:1% 0;">
							                 <p>
							                     {{HTML::image('assets/img/icon/link.png','iLink')}}&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;padding:1% 0;">
							                 <p>
							                     {{HTML::image('assets/img/icon/link.png','iLink')}}&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;padding:1% 0;">
							                 <p>
							                     {{HTML::image('assets/img/icon/link.png','iLink')}}&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;padding:1% 0;">
							                 <p>
							                     {{HTML::image('assets/img/icon/link.png','iLink')}}&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							             <li style="float:left;width:100%;padding:1% 0;">
							                 <p>
							                     {{HTML::image('assets/img/icon/link.png','iLink')}}&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a>
							                 </p>
							             </li>
							        </ul>
							     </div>
							</div>
						</div>
					</div>
					<!-- /.end col-xs-12 -->
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop
