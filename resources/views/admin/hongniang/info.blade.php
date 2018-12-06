@extends('admin.master') @section('content')
<script src="/static/js/lightbox.js"></script>
<link href="/static/css/lightbox.css" rel="stylesheet">
<link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
<script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
<script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>

<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>单身圈资源详情</h3>
			</div>
			<a class="btn btn-default" style="float: right;" href="javascript:void(0);" onClick="window.history.go(-1);">返回</a>
		</div>
		<div class="clearfix"></div>
<form method="get" name="baseinfo" id="baseinfo">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>基本信息</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<!--
							<div class="col-sm-3">
								<input type="hidden" id="header_url_id"
									value="<?php echo $resourceInfo->header_url;?>">
								<div id="uploader-header_url">
									<div id="fileList-header_url" class="uploader-list">
							    <?php if(!empty($resourceInfo->header_url)) {?>
							    	<div class="toolBar" style="display:none;"><i class="fa fa-trash-o del_album del"></i></div>
							    	<div id="header_url" class="file-item thumbnail">
											　<a href="<?php echo $resourceInfo->header_url;?>" rel="lightbox"><img src="<?php echo $resourceInfo->header_url;?>" style="width:200px;height:200px;margin-top:-20px;"></a>
										</div>
							    <?php } ?>
							    	</div>
									<div id="filePicker-header_url">选择图片</div>
								</div>

							</div>-->
							<div class="col-sm-3">
								<div id="uploader-demo">
									<div id="fileList" class="uploader-list album">
										<div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
										<div id="file_List" val="0">
											<?php if(!empty($resourceInfo->header_url)) {?>
											<a class="example-image-link" data-lightbox="example-set"  href="<?php echo $resourceInfo->header_url;?>" rel="lightbox">
                                        <img width="200" height="200" src="<?php echo $resourceInfo->header_url;?>" >
                                    </a>
											<?php } ?>
                            	</div>
                    		</div>
									<input type="hidden" value="<?php echo $resourceInfo->header_url;?>" id="header_url" />
									<br>
									<div id="fileList-header_url" class="uploader-list"></div>
									<div id="filePicker-header_url">选择图片</div>
								</div>
							</div>
							<!-- /MAIL LIST -->

							<!-- CONTENT MAIL -->
							<div class="col-sm-4 ">
								<div class="inbox-body">
									<div class="mail_heading row">
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">资源ID:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="rid" name="rid"
													class="form-control col-md-3 col-xs-12" readonly = "readonly"
													value="<?php echo $resourceInfo->rid;?>">
											</div>
										</div>

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">昵称:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="nickname" name="nickname"
													class="form-control col-md-3 col-xs-12"
													value="<?php echo $resourceInfo->nickname;?>">
											</div>
										</div>

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">性别:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<select class="select2_single form-control" tabindex="-1"
													id="sex" name="sex">
													<option value="1"
														<?php if($resourceInfo->sex == 1) {echo "selected='selected'";}?>>男</option>
													<option value="2"
														<?php if($resourceInfo->sex == 2) {echo "selected='selected'";}?>>女</option>
													<option value="0"
														<?php if($resourceInfo->sex == 0) {echo "selected='selected'";}?>>未知</option>
												</select>
											</div>
										</div>

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">身高:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="high" name="high"
													class="form-control col-md-3 col-xs-12"
													value="<?php echo $resourceInfo->high;?>">
											</div>
										</div>
										
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">职业:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="position" name="position"
													class="form-control col-md-3 col-xs-12"
													value="<?php echo $resourceInfo->position;?>">
											</div>
										</div>
										

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">学历:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<select class="select2_single form-control" tabindex="-1" id="education" name="education">
													<option value="高中以下" <?php if($resourceInfo->education=='高中以下'){ ?>selected='selected'<?php }?>>高中以下</option>
		                            				<option value="大专" <?php if($resourceInfo->education=='大专'){ ?>selected='selected'<?php }?>>大专</option>
													<option value="本科" <?php if($resourceInfo->education=='本科'){ ?>selected='selected'<?php }?>>本科</option>
													<option value="研究生" <?php if($resourceInfo->education=='研究生'){ ?>selected='selected'<?php }?>>研究生</option>
													<option value="博士" <?php if($resourceInfo->education=='博士'){ ?>selected='selected'<?php }?>>博士</option>
													<option value="博士以上" <?php if($resourceInfo->education=='博士以上'){ ?>selected='selected'<?php }?>>博士以上</option>
                        						</select>
											</div>
										</div>
										
										<!--
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">点赞数量:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="like_num" name="like_num"
													class="form-control col-md-3 col-xs-12" disabled
													value="<?php echo $resourceInfo->like_num;?>">
											</div>
										</div>
										-->

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">创建时间:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="created_at" name="created_at"
													class="form-control col-md-3 col-xs-12" disabled
													value="<?php echo $resourceInfo->created_at;?>">
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="col-sm-5">
								<div class="inbox-body">
									<div class="mail_heading row">
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">UID:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8">
												<input type="text" id="uid" name="uid" class="form-control" readonly = "readonly"
													value="<?php echo $resourceInfo->uid;?>">
											</div>
										</div>
										<!--
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">关系:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<select class="select2_single form-control" tabindex="-1" id="marriage" name="relation">
													<option value="朋友" <?php if($resourceInfo->relation=='朋友'){ ?>selected='selected'<?php }?>>朋友</option>
                            						<option value="闺蜜" <?php if($resourceInfo->relation=='闺蜜'){ ?>selected='selected'<?php }?>>闺蜜</option>
                        						</select>
											</div>
										</div>
										-->
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3" 
												for="last-name" style="padding-top: 8px; text-align: right;">出生年月:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="birthday" name="birthday"
													class="form-control col-md-3 col-xs-12 form_datetime"
													value="<?php echo $resourceInfo->birthday;?>">
											</div>
										</div>

										

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">年收入:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<select class="select2_single form-control" tabindex="-1" id="income" name="income">
													<option value="10W以下" <?php if($resourceInfo->income=='10W以下'){?>selected='selected'<?php }?>>10W以下</option>
													<option value="10~20W" <?php if($resourceInfo->income=='10~20W'){?>selected='selected'<?php }?>>10~20W</option>
													<option value="20~30W" <?php if($resourceInfo->income=='20~30W'){?>selected='selected'<?php }?>>20~30W</option>
													<option value="30~50W" <?php if($resourceInfo->income=='30~50W'){?>selected='selected'<?php }?>>30~50W</option>
													<option value="50~100W" <?php if($resourceInfo->income=='50~100W'){?>selected='selected'<?php }?>>50~100W</option>
													<option value="100W以上" <?php if($resourceInfo->income=='100W以上'){?>selected='selected'<?php }?>>100W以上</option>
					                    		</select> 
											</div>
										</div>
										
										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">工作生活地:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<input type="text" id="workplace" name="workplace"
													class="form-control col-md-3 col-xs-12"
													value="<?php echo $resourceInfo->workplace;?>">
											</div>
										</div>
										

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">车信息:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<select class="select2_single form-control" tabindex="-1" id="car" name="car">
													<option value="有" <?php if($resourceInfo->car=='有'){?>selected='selected'<?php }?>>有</option>
                            						<option value="没有" <?php if($resourceInfo->car=='没有'){?>selected='selected'<?php }?>>没有</option>
                        						</select>
											</div>
										</div>

										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">房产信息:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<select class="select2_single form-control" tabindex="-1" id="house" name="house">
													<option value="有房" <?php if($resourceInfo->house=='有房'){?>selected='selected'<?php } ?>>有房</option>
                            						<option value="无房" <?php if($resourceInfo->house=='无房'){?>selected='selected'<?php } ?>>无房</option>
													<option value="计划购房" <?php if($resourceInfo->house=='计划购房'){?>selected='selected'<?php } ?>>计划购房</option>
                        						</select>
											</div>
										</div>


										<div class="form-group col-md-12">
											<label class="control-label col-md-3 col-sm-3 col-xs-3"
												for="last-name" style="padding-top: 8px; text-align: right;">推荐描述:
												<span class=""></span>
											</label>
											<div class="col-md-8 col-sm-8 col-xs-8" style="">
												<textarea rows="3" cols=""
													class="form-control col-md-5 col-xs-12" id="recommend"
													name="recommend"><?php echo $resourceInfo->recommend;?></textarea>
											</div>
										</div>

										<div class="form-group col-md-12">
											<label class="control-label col-md-8 col-sm-8 col-xs-8"
												for="last-name" style="padding-top: 8px; text-align: right;">
												<button id="compose" class="btn btn-sm btn-success" style="float: right;" type="button" onClick="modifyBaseInfo();">修改基本资料</button>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</form>
		<!--
<form method="get" name="baseinfo" id="mate_standard">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>择偶标准</h2>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; width: 34%;">年龄:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="width: 66%;">
										<input type="text" id="age" name="age"
											class="form-control col-md-12 col-xs-12"
											value="<?php if(isset($resourceInfo->mate_standard->age)) echo $resourceInfo->mate_standard->age;?>">
									</div>
								</div>
								
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; width: 34%;">身高:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="width: 66%;">
										<input type="text" id="high" name="high"
											class="form-control col-md-12 col-xs-12"
											value="<?php if(isset($resourceInfo->mate_standard->high)) echo $resourceInfo->mate_standard->high;?>">
									</div>
								</div>
								
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; width: 34%;">婚史信息:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="width: 66%;">
										<select class="select2_single form-control" tabindex="-1" id="marriage" name="marriage">
											<option value="有" <?php if(isset($resourceInfo->mate_standard->marriage) &&($resourceInfo->mate_standard->marriage=='不限')){ ?>selected='selected'<?php }?>>不限</option>
											<option value="有" <?php if(isset($resourceInfo->mate_standard->marriage) &&($resourceInfo->mate_standard->marriage=='有')){ ?>selected='selected'<?php }?>>有</option>
                            				<option value="无" <?php if(isset($resourceInfo->mate_standard->marriage) &&($resourceInfo->mate_standard->marriage=='无')){ ?>selected='selected'<?php }?>>无</option>
                        				</select>
									</div>
								</div>
								
								
								
							</div>
							<div class="col-sm-4">
								
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name" style="padding-top: 8px; text-align: right;">工作所在地:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="">
										<input type="text" id="workplace" name="workplace"
											class="form-control col-md-3 col-xs-12"
											value="<?php if(isset($resourceInfo->mate_standard->workplace)) echo $resourceInfo->mate_standard->workplace;?>">
									</div>
								</div>
								
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; ">年收入:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="">
										<select class="select2_single form-control" tabindex="-1" id="income" name="income">
											<option value="不限" <?php if(isset($resourceInfo->mate_standard->incom) && ($resourceInfo->mate_standard->income=='不限')){?>selected='selected'<?php }?>>不限</option>
											<option value="10W以下" <?php if(isset($resourceInfo->mate_standard->incom) &&($resourceInfo->mate_standard->income=='10W以下')){?>selected='selected'<?php }?>>10W以下</option>
											<option value="10~20W" <?php if(isset($resourceInfo->mate_standard->incom) &&($resourceInfo->mate_standard->income=='10~20W')){?>selected='selected'<?php }?>>10~20W</option>
											<option value="20~30W" <?php if(isset($resourceInfo->mate_standard->incom) &&($resourceInfo->mate_standard->income=='20~30W')){?>selected='selected'<?php }?>>20~30W</option>
											<option value="30~50W" <?php if(isset($resourceInfo->mate_standard->incom) &&($resourceInfo->mate_standard->income=='30~50W')){?>selected='selected'<?php }?>>30~50W</option>
											<option value="50~100W" <?php if(isset($resourceInfo->mate_standard->incom) &&($resourceInfo->mate_standard->income=='50~100W')){?>selected='selected'<?php }?>>50~100W</option>
											<option value="100W以上" <?php if(isset($resourceInfo->mate_standard->incom) &&($resourceInfo->mate_standard->income=='100W以上')){?>selected='selected'<?php }?>>100W以上</option>
					                    </select> 
									</div>
								</div>

								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; ">学历: <span
										class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="">
										<select class="select2_single form-control" tabindex="-1" id="education" name="education">
											<option value="不限" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='不限')){ ?>selected='selected'<?php }?>>不限</option>
											<option value="高中以下" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='高中以下')){ ?>selected='selected'<?php }?>>高中以下</option>
                            				<option value="大专" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='大专')){ ?>selected='selected'<?php }?>>大专</option>
											<option value="本科" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='本科')){ ?>selected='selected'<?php }?>>本科</option>
											<option value="研究生" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='研究生')){ ?>selected='selected'<?php }?>>研究生</option>
											<option value="博士" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='博士')){ ?>selected='selected'<?php }?>>博士</option>
											<option value="博士以上" <?php if( isset($resourceInfo->mate_standard->education) && ($resourceInfo->mate_standard->education=='博士以上')){ ?>selected='selected'<?php }?>>博士以上</option>
                        				</select>
									</div>
								</div>
								
								
							</div>
							
							<div class="col-sm-5">
							
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; width: 34%;">房产信息:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="width: 66%;">
										<select class="select2_single form-control" tabindex="-1" id="house" name="house">
											<option value="不限" <?php if(isset($resourceInfo->mate_standard->house) && ($resourceInfo->mate_standard->house=='不限')){?>selected='selected'<?php } ?>>不限</option>
											<option value="有房" <?php if(isset($resourceInfo->mate_standard->house) &&($resourceInfo->mate_standard->house=='有房')){?>selected='selected'<?php } ?>>有房</option>
                            				<option value="无房" <?php if(isset($resourceInfo->mate_standard->house) &&($resourceInfo->mate_standard->house=='无房')){?>selected='selected'<?php } ?>>无房</option>
											<option value="计划购房" <?php if(isset($resourceInfo->mate_standard->house) &&($resourceInfo->mate_standard->house=='计划购房')){?>selected='selected'<?php } ?>>计划购房</option>
                        				</select>
									</div>
								</div>
								
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-5 col-sm-5 col-xs-5"
										for="last-name"
										style="padding-top: 8px; text-align: right; width: 34%;">车信息:
										<span class=""></span>
									</label>
									<div class="col-md-7 col-sm-7 col-xs-7" style="width: 66%;">
										<select class="select2_single form-control" tabindex="-1" id="car" name="car">
											<option value="不限" <?php if(isset($resourceInfo->mate_standard->car) && ($resourceInfo->mate_standard->car=='不限')){?>selected='selected'<?php }?>>不限</option>
											<option value="有" <?php if(isset($resourceInfo->mate_standard->car) &&($resourceInfo->mate_standard->car=='有')){?>selected='selected'<?php }?>>有</option>
                            				<option value="没有" <?php if(isset($resourceInfo->mate_standard->car) &&($resourceInfo->mate_standard->car=='没有')){?>selected='selected'<?php }?>>没有</option>
                        				</select>
									</div>
								</div>
								
								<div class="form-group col-md-12" style="padding: 0px;">
									<label class="control-label col-md-12 col-sm-12 col-xs-12"
										for="last-name" style="padding-top: 8px; text-align: right;">
										<button id="compose" class="btn btn-info"
											style="margin-right: 20%;" type="button" onClick="modifyMateStand();">修改择偶资料</button>
									</label>
								</div>
								
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
</form>
-->
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>我的相册</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<div class="row">
							<?php if(isset($resourceInfo->bridgeImgs)) {?>
								<?php foreach ($resourceInfo->bridgeImgs as $k => $v) {?>
								<div class="col-sm-3 mail_list_column album">
									<div class="toolBar" style="display:none;"><i class="fa fa-trash-o del_album del" val="<?php echo $v->id;?>"></i></div>
									<a href="<?php echo $v->img_url;?>" data-rel="colorbox"
										data-lightbox="roadtrip" rel="lightbox[]"> <img width="200" height="200"
										src="<?php echo $v->img_url;?>" style="padding-bottom:10px;"></a>
								</div>
								<?php }?>
							<?php }?>
							<div class="col-sm-3 album" >
                        		<div id="uploader-bridgeimg">
									<div id="fileList-bridgeimg" class="uploader-list">
							    	</div>
									<div id="upload-bridgeimg" style="padding-top:80px;">添加图片</div>
                      			</div>
                      
                      
                      </div>
						</div>
					</div>
					
				</div>
			</div>
			
			<div class="row-fluid">
				<div id="uploader-two" class="wu-example">			
					<div class="queueList-two">                            
	            		<ul class="filelist-two unstyled"></ul>
						<div id="dndArea" class="placeholder">
							<div id="filePicker-two"></div>
            			</div>
	        		</div>
	    		</div>
			</div> 
		</div>

	 

	</div>
</div>

<script type="text/javascript">

	$('.form_datetime').datetimepicker({
	    minView: "month", //选择日期后，不会再跳转去选择时分秒
	    language:  'zh-CN',
	    format: 'yyyy-mm-dd',
	    todayBtn:  1,
	    autoclose: 1
	});

	var uploader = WebUploader.create({
	    auto: true,
	    swf: '/static/swf/Uploader.swf',
	    server: '/admin/upload',
	    pick: '#filePicker-header_url',
	    accept: {
	        title: 'Images',
	        extensions: 'gif,jpg,jpeg,bmp,png',
	        mimeTypes: 'image/*'
	    }
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $('<div id="" class="file-item thumbnail">'+'<a href="" rel="lightbox"><img style="width:200px;height:200px;margin-top:-20px;"></a>'+'</div>'),
				$img = $li.find('img');
		// $("#fileList-header_url").html($li);
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
			$li.find('a').attr('href',src);
			$img.attr( 'src', src );
		}, 500, 500 );
	});

	uploader.on( 'uploadSuccess', function( file,response ) {
		var html= '<a class="example-image-link" data-lightbox="example-set"  href="'+response.data+'" rel="lightbox" >'+'<img src="'+response.data+'" width="200" height="200" >'+'</a>';
		$("#file_List").html(html);
		$("#file_List").attr("val",1);
		$.post({
 	        url:'/admin/api/modify_resource',
 	        data:{header_url: response.data,rid:$("#rid").val()},
 	        success:function(result){
				if(result.error==0){
					layer.msg('修改成功',{icon:1,time:1000});
				}else{
					layer.msg(result.msg,{icon:2,time:1000});
				}
				$('#uploader-header_url').find('img').attr('src',response.data);
				$("#header_url").val(response.data);
				$( '#'+file.id ).addClass('upload-state-done');
 	        }
     	});
	});



	var uploader_img = WebUploader.create({
	    auto: true,
	    swf: '/static/swf/Uploader.swf',
	    server: '/admin/upload',
	    pick: '#upload-bridgeimg',
	    accept: {
	        title: 'Images',
	        extensions: 'gif,jpg,jpeg,bmp,png',
	        mimeTypes: 'image/*'
	    }
	});
	uploader_img.on( 'fileQueued', function( file ) {
	    var $li = $('<div id="" class="file-item thumbnail">'+'<a href="" rel="lightbox"><img style="width:200px;height:200px;margin-top:-20px;"></a>'+'</div>'),
	    $img = $li.find('img');
	    $("#fileList-bridgeimg").html($li);
	    uploader.makeThumb( file, function( error, src ) {
	        if ( error ) {
	            $img.replaceWith('<span>不能预览</span>');
	            return;
	        }
			$li.find('a').attr('href',src);
	        $img.attr( 'src', src );
	    }, 500, 500 );
	});

	uploader_img.on( 'uploadSuccess', function( file,response ) {
		var params = "img_url="+response.data+"&rid="+$("#rid").val()+"&uid="+$("#uid").val()+"&is_cover=0";
		$.post({
 	        url:'/admin/update_bridgeImg',
 	        data:params,
 	        success:function(result){
 	        	window.parent.location.reload();
 	        }
     	});
	});

	
    
	function modifyBaseInfo()
	{
		var param = $("#baseinfo").serialize();
		$.post({
			url:'/admin/api/modify_resource',
			data:param,
			success:function(result) {
				if(result.error == 0) {
					layer.msg('操作成功',{icon:1,time:1000});
				} else {
					layer.msg(result.msg,{icon:2,time:1000});
				}
			}
		});
	}

	//修改择偶标准
	function modifyMateStand()
	{
		var param = $("#mate_standard").serialize();
		param += "&rid="+$("#rid").val();
		$.post({
			url:'/admin/api/modify_matestand',
			data:param,
			success:function(result) {
				if(result.error == 0) {
					layer.msg('操作成功',{icon:1,time:1000});
				} else {
					layer.msg(result.msg,{icon:2,time:1000});
				}
			}
		});
	}
	$(function(){
		$("div.album").hover(function(){
	        $(this).find('.toolBar').show();
	    },function(){
	        $(this).find('.toolBar').hide();
	    });

		$(".del_album").on("click",function(e){
            var id =$(this).attr('val');
            $.ajax({
                url:'/admin/api/del_bridgeimg',
                dataType:"json",
                type:'post',
                data:{id:id},
                success:function(result){
                    if(result.error==0){
                        layer.msg('删除成功',{icon:1,time:1000});
                        window.parent.location.reload();
                    }else{
                        layer.msg(result.msg,{icon:2,time:1000});
                    }
                }
            });
        });
	 });
	
</script>
@endsection
