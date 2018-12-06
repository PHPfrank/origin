@extends('admin.master') 
@section('content')
    <link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
    <link href="/static/css/lightbox.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/static/js/lightbox.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
			<div class="page-title">
				<div class="title_left">
					<h3>会员详情</h3>
				</div>
				<a class="btn btn-default" style="float: right;" href="javascript:void(0);" onClick="window.location.href=document.referrer;">返回</a>
				
			</div>
			<div class="row">
				<div id="info-content" >
			</div>
         </div>
        </div>
</div>
    <script type="text/html" id="info_tpl">
        <div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="x_title">
				<h2>基本信息</h2>
				<div class="clearfix"></div>
			</div>
            <div class="x_content">
        		<div class="row">
                    <div class="col-sm-3">
                        <div id="uploader-demo">
                            <div id="fileList" class="uploader-list album">
                                <div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
                                <div id="file_List" val="0">
                                    <%if(data.user.header_url){%>
                                    <a class="example-image-link" data-lightbox="example-set"  href="<%=data.user.header_url%>" rel="lightbox">
                                        <img width="200" height="200" src="<%=data.user.header_url%>" >
                                    </a>
                            		<%}%>
                            	</div>
                    		</div>
                    		<input type="hidden" value="<%=data.user.header_url%>" id="header_url" />
							<br>
                    		<div id="filePicker">选择图片</div>
                		</div>
            		</div>
            		<!--
            		<div class="col-sm-3">
                		<div id="uploader-demo">
                    		<div id="fileList" class="uploader-list album">
                        		<div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
                        			<div id="file_List" val="0">
										<%if(data.images[0]){%>
                            			<%if(data.images[0].img_url){%>
                        					<a class="example-image-link" data-lightbox="example-set"  href="<%=data.images[0].img_url%>" rel="lightbox">
                            					<img width="200" height="200" src="<%=data.images[0].img_url%>" >
                        					</a>
                            			<%}%>
										<%}%>
                            		</div>
                    			</div>
                    			<%if(data.images[0]){%>
									<input type="hidden" value="<%=data.images[0].id%>" id="header_url_id" />
									<input type="hidden" value="<%=data.images[0].img_url%>" id="header_url" />
                            	<%} else {%>
									<input type="hidden" value="" id="header_url_id" />
									<input type="hidden" value="" id="header_url" />
								<%}%>
							<br>
                    		<div id="filePicker">选择图片</div>
                		</div>
					</div>
                    -->
            		<div class="col-sm-4 ">
        				<div class="inbox-body">
            				<div class="mail_heading row">

                				<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">悬赏ID:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  id="fid" name="fid" class="form-control col-md-3 col-xs-12" disabled  value="<%=data.info.fid%>">
                    				</div>
                				</div>
                				<div class="form-group col-md-12">
                   					<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">类型:
                       					<span class=""></span>
                   					</label>
                   					<div class="col-md-8 col-sm-8 col-xs-8" style="">
                       					<input type="text"  name="user_source" id="user_source" class="form-control col-md-3 col-xs-12" disabled value="<%=data.user.user_source%>">
                   					</div>
               					</div>
								<div class="form-group col-md-12">
                   					<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">手机号:
                       					<span class=""></span>
                   					</label>
                   					<div class="col-md-8 col-sm-8 col-xs-8" style="">
                       					<input type="text"  name="phone" id="phone" class="form-control col-md-3 col-xs-12" disabled value="<%=data.user.phone%>">
                   					</div>
               					</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">昵称:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  id="nickname" name="nickname" class="form-control col-md-3 col-xs-12" value="<%=data.info.nickname%>">
                    				</div>
                				</div>
                                <!--
								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">悬赏金:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  id="matchmaker_gold" name="matchmaker_gold" class="form-control col-md-3 col-xs-12" <%if(data.user.vest == 0){%>disabled<% }%>  value="<%=data.info.matchmaker_gold%>">
                    				</div>
                				</div>
                                -->
								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">性别:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="sex" name="sex">
											<option value="0" <%if(data.info.sex=='0'){%>selected='selected'<%}%>>未知</option>
                            				<option value="1" <%if(data.info.sex==1){%>selected='selected'<%}%>>男</option>
                            				<option value="2" <%if(data.info.sex=='2'){%>selected='selected'<%}%>>女</option>
                        				</select>
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">身高:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  name="high" id="high" class="form-control col-md-3 col-xs-12" value="<%=data.info.high%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">收入:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
										<select class="select2_single form-control" tabindex="-1" id="income" name="income">
											<option value="10W以下" <%if(data.info.income=='10W以下'){%>selected='selected'<%}%>>10W以下</option>
											<option value="10~20W" <%if(data.info.income=='10~20W'){%>selected='selected'<%}%>>10~20W</option>
											<option value="20~30W" <%if(data.info.income=='20~30W'){%>selected='selected'<%}%>>20~30W</option>
											<option value="30~50W" <%if(data.info.income=='30~50W'){%>selected='selected'<%}%>>30~50W</option>
											<option value="50~100W" <%if(data.info.income=='50~100W'){%>selected='selected'<%}%>>50~100W</option>
											<option value="100W以上" <%if(data.info.income=='100W以上'){%>selected='selected'<%}%>>100W以上</option>
					                    </select>   				
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">学历:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
										<select class="select2_single form-control" tabindex="-1" id="education" name="education">
											<option value="高中以下" <%if(data.info.education=='高中以下'){%>selected='selected'<%}%>>高中以下</option>
                            				<option value="大专" <%if(data.info.education=='大专'){%>selected='selected'<%}%>>大专</option>
											<option value="本科" <%if(data.info.education=='本科'){%>selected='selected'<%}%>>本科</option>
											<option value="研究生" <%if(data.info.education=='研究生'){%>selected='selected'<%}%>>研究生</option>
											<option value="博士" <%if(data.info.education=='博士'){%>selected='selected'<%}%>>博士</option>
											<option value="博士以上" <%if(data.info.education=='博士以上'){%>selected='selected'<%}%>>博士以上</option>
                        				</select>					
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">职业:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  name="position" id="position" class="form-control col-md-3 col-xs-12" value="<%=data.info.position%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">自我介绍:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<textarea  name="introduce" id="introduce" class="form-control col-md-3 col-xs-12" style="width:150%;"><%=data.info.introduce%></textarea>
                    				</div>
                				</div>

							</div>
        				</div>
					</div>

        			<div class="col-sm-5">
            			<div class="inbox-body">
							<div class="mail_heading row">
								
								<div class="form-group col-md-12">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">UID:
                            			<span class=""></span>
                        			</label>
                        			<div class="col-md-8 col-sm-8 col-xs-8" style="">
                            			<input type="text" id="uid" name="uid" class="form-control col-md-3 col-xs-12 form_datetime" disabled value="<%=data.info.uid%>">
                        			</div>
                    			</div>
                                <div class="form-group col-md-12">
                   					<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">TOKEN:
                       					<span class=""></span>
                   					</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                       					<input type="text" id="token" name="token" class="form-control col-md-3 col-xs-12" disabled value="<%=data.user.token%>">
                   					</div>
								</div>
								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">是否单身:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="is_bounty" name="is_bounty">
											<option value="0" <%if(data.info.is_bounty=='0'){%>selected='selected'<%}%>>非单身</option>
                            				<option value="1" <%if(data.info.is_bounty=='1'){%>selected='selected'<%}%>>单身</option>
                        				</select>
                    				</div>
                				</div>
								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">单身信息状态:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="status" name="status">
											<option value="0" <%if(data.info.status=='0'){%>selected='selected'<%}%>>正常</option>
                            				<option value="-1" <%if(data.info.status=='-1'){%>selected='selected'<%}%>>关闭</option>
                        				</select>
                    				</div>
                				</div>

                    			<div class="form-group col-md-12">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">出生年月:
                            			<span class=""></span>
                        			</label>
                        			<div class="col-md-8 col-sm-8 col-xs-8" style="">
                            			<input type="text" id="birthday" name="birthday" class="form-control col-md-3 col-xs-12 form_datetime" value="<%=data.info.birthday%>">
                        			</div>
                    			</div>

								<div class="form-group col-md-12">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">工作生活地:
                            			<span class=""></span>
                        			</label>
                        			<div class="col-md-8 col-sm-8 col-xs-8" style="">
                            			<input type="text" id="workplace" name="workplace" class="form-control col-md-3 col-xs-12" value="<%=data.info.workplace%>">
                        			</div>
                    			</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">房产信息:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="house" name="house">
											<option value="有房" <%if(data.info.house=='有房'){%>selected='selected'<%}%>>有房</option>
                            				<option value="无房" <%if(data.info.house=='无房'){%>selected='selected'<%}%>>无房</option>
											<option value="计划购房" <%if(data.info.house=='计划购房'){%>selected='selected'<%}%>>计划购房</option>
                        				</select>
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">车信息:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="car" name="car">
											<option value="有" <%if(data.info.car=='有'){%>selected='selected'<%}%>>有</option>
                            				<option value="没有" <%if(data.info.car=='没有'){%>selected='selected'<%}%>>没有</option>
                        				</select>
                    				</div>
                				</div>

                                <!--
								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">婚史:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="marriage" name="marriage">
											<option value="有" <%if(data.info.marriage=='有'){%>selected='selected'<%}%>>有</option>
                            				<option value="无" <%if(data.info.marriage=='无'){%>selected='selected'<%}%>>无</option>
                        				</select>
                    				</div>
                				</div>
                                -->
								<div class="form-group col-md-12">
               						<label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                   						<button id="info_edit" class="btn btn-success" style="float: right;" >修改基本资料</button>
              						</label>
            					</div>

                			</div>
            			</div>
            		</div>
				</div>
        	</div>
		</div> 

<!--
		<div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="x_title">
				<h2>择偶要求</h2>
				<div class="clearfix"></div>
			</div>
            <div class="x_content">
        		<div class="row">
            		<div class="col-sm-3">
                		<div class="inbox-body">
            				<div class="mail_heading row">

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">年龄:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  name="standard_age" id="standard_age" class="form-control col-md-3 col-xs-12" value="<%=data.standard.age%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">身高:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  name="standard_high" id="standard_high" class="form-control col-md-3 col-xs-12" value="<%=data.standard.high%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">婚史信息:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="standard_marriage" name="standard_marriage">
											<option value="不限" <%if(data.standard.marriage=='不限'){%>selected='selected'<%}%>>不限</option>
											<option value="有" <%if(data.standard.marriage=='有'){%>selected='selected'<%}%>>有</option>
											<option value="无" <%if(data.standard.marriage=='无'){%>selected='selected'<%}%>>无</option>
					                    </select>   				
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">择偶要求:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<textarea  name="standard_message" id="standard_message" class="form-control col-md-3 col-xs-12" style="width:300%;"><%=data.standard.message%></textarea>
                    				</div>
                				</div>

								

							</div>
						</div>
					</div>

            		<div class="col-sm-4">
        				<div class="inbox-body">
            				<div class="mail_heading row">

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">工作生活地:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input  type="text" name="standard_workplace" id="standard_workplace" class="form-control col-md-3 col-xs-12" value="<%=data.standard.workplace%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">收入:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
										<select class="select2_single form-control" tabindex="-1" id="standard_income" name="standard_income">
											<option value="不限" <%if(data.standard.income=='不限'){%>selected='selected'<%}%>>不限</option>
											<option value="10W以下" <%if(data.standard.income=='10W以下'){%>selected='selected'<%}%>>10W以下</option>
											<option value="10~20W" <%if(data.standard.income=='10~20W'){%>selected='selected'<%}%>>10~20W</option>
											<option value="20~30W" <%if(data.standard.income=='20~30W'){%>selected='selected'<%}%>>20~30W</option>
											<option value="30~50W" <%if(data.standard.income=='30~50W'){%>selected='selected'<%}%>>30~50W</option>
											<option value="50~100W" <%if(data.standard.income=='50~100W'){%>selected='selected'<%}%>>50~100W</option>
											<option value="100W以上" <%if(data.standard.income=='100W以上'){%>selected='selected'<%}%>>100W以上</option>
					                    </select>   				
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name" style="padding-top: 8px; text-align: right;">学历:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
										<select class="select2_single form-control" tabindex="-1" id="standard_education" name="standard_education">
											<option value="不限" <%if(data.standard.education=='不限'){%>selected='selected'<%}%>>不限</option>
											<option value="高中以下" <%if(data.standard.education=='高中以下'){%>selected='selected'<%}%>>高中以下</option>
                            				<option value="大专" <%if(data.standard.education=='大专'){%>selected='selected'<%}%>>大专</option>
											<option value="本科" <%if(data.standard.education=='本科'){%>selected='selected'<%}%>>本科</option>
											<option value="研究生" <%if(data.standard.education=='研究生'){%>selected='selected'<%}%>>研究生</option>
											<option value="博士" <%if(data.standard.education=='博士'){%>selected='selected'<%}%>>博士</option>
											<option value="博士以上" <%if(data.standard.education=='博士以上'){%>selected='selected'<%}%>>博士以上</option>
                        				</select>					
                    				</div>
                				</div>

								

							</div>
        				</div>
					</div>

        			<div class="col-sm-5">
            			<div class="inbox-body">
							<div class="mail_heading row">
								
								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">房产信息:
                        				<span class=""></span>
                    				</label>
                    				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<select class="select2_single form-control" tabindex="-1" id="standard_house" name="standard_house">
											<option value="不限" <%if(data.standard.house=='不限'){%>selected='selected'<%}%>>不限</option>
											<option value="有房" <%if(data.standard.house=='有房'){%>selected='selected'<%}%>>有房</option>
                            				<option value="无房" <%if(data.standard.house=='无房'){%>selected='selected'<%}%>>无房</option>
											<option value="计划购房" <%if(data.standard.house=='计划购房'){%>selected='selected'<%}%>>计划购房</option>
                        				</select>
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">户籍:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input  type="text" name="standard_liveplace" id="standard_liveplace" class="form-control col-md-3 col-xs-12" value="<%=data.standard.liveplace%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
                    				<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">职业:
                       	 				<span class=""></span>
                    				</label>
                   	 				<div class="col-md-8 col-sm-8 col-xs-8" style="">
                        				<input type="text"  name="standard_position" id="standard_position" class="form-control col-md-3 col-xs-12" value="<%=data.standard.position%>">
                    				</div>
                				</div>

								<div class="form-group col-md-12">
               						<label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                   						<button id="standard_edit" class="btn btn-info" style="float: right;" >修改择偶资料</button>
              						</label>
            					</div>

                			</div>
            			</div>
            		</div>
				</div>
        	</div>
		</div> 

-->



	<div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="x_title">
				<h2>我的相册</h2>
				<div class="clearfix"></div>
			</div>
            <div class="x_content">
        		<div class="row">
					<%if(data.images[0]){%>
					<%for(var i = 0; i < data.images.length; i++) {%>
					<div class="col-sm-3 mail_list_column album">
						<div class="toolBar" style="display:none;"><i class="fa fa-trash-o del_album del" val="<%=data.images[i].id %>"></i></div>
						<a href="<%=data.images[i].img_url %>" data-rel="colorbox" data-lightbox="roadtrip" rel="lightbox[]"> <img width="200" height="200" src="<%=data.images[i].img_url %>" style="padding-bottom:10px;"></a>
					</div>
					<%}}%>
					<div class="col-sm-3 album" >
                        <div id="uploader-bridgeimg">
							<div id="fileList-bridgeimg" class="uploader-list"></div>
							<div id="upload-bridgeimg" style="padding-top:80px;">添加图片</div>
                      	</div>
					</div>
        			
				</div>
        	</div>
		</div> 


	</script>
	
	
	
	
	
    <script type="text/javascript">

        $(function(){
            var uid ='<?=$uid?>';
            var init = function() {
                $.ajax({
	                url:'/admin/bountyInfoData',
	                dataType:"json",
	                type:'get',
	                data:{uid:uid},
	                success:function(result){
	                    console.log(result);
	                    var tpl = $("#info_tpl").html();
	                    $("#info-content").html(template(tpl,{data:result.data}));
	                    render();
	                }
           	 	});
            }
            init();
            render=function(){
                $('.form_datetime').datetimepicker({
                    minView: "month", //选择日期后，不会再跳转去选择时分秒
                    language:  'zh-CN',
                    format: 'yyyy-mm-dd',
                    todayBtn:  1,
                    autoclose: 1
                });
                $("#house").on("change",function(e){
                    if($(this).val()==0){
                        $(".house_show").hide();
                    }else{
                        $(".house_show").show();
                    }
                });
                $("#info_edit").on("click",function(){
                   var _this={};
                    _this.fid =$("#fid").val();
                    _this.uid = $.trim($("#uid").val());
                    _this.nickname =$.trim($("#nickname").val());
                    _this.status = $.trim($("#status").val());
                    _this.matchmaker_gold =$.trim($("#matchmaker_gold").val());
                    _this.birthday =$.trim($("#birthday").val());
                    _this.sex =$.trim($("#sex").val());
                    _this.workplace = $.trim($("#workplace").val());
                    _this.high = $.trim($("#high").val());
                    _this.house = $.trim($("#house").val());
                    _this.income =$.trim($("#income").val());
                    _this.car =$.trim($("#car").val());
                    _this.education =$.trim($("#education").val());
                    _this.marriage =$.trim($("#marriage").val());
                    _this.position =$.trim($("#position").val());
                    _this.introduce =$.trim($("#introduce").val());
                    _this.is_bounty =$.trim($("#is_bounty").val());
                    $.ajax({
                        url:'/admin/bountyEdit',
                        dataType:"json",
                        type:'post',
                        data:_this,
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                                $('.del_avater').parents('#fileList').children("#file_List").attr("val",0);
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
                        }
                    });
                });
                $("#standard_edit").on("click",function(){
                    var _this={};
                    _this.uid =$("#uid").val();
                    _this.fid =$("#fid").val();
                    if(_this.fid==''){
                        layer.msg("请先完成资料修改",{icon:2,time:1000});
                        return false;
                    }
                    _this.age = $.trim($("#standard_age").val());
                    _this.high = $.trim($("#standard_high").val());
                    _this.marriage = $.trim($("#standard_marriage").val());
                    _this.message =$.trim($("#standard_message").val());
                    _this.workplace = $.trim($("#standard_workplace").val());
                    _this.income =$.trim($("#standard_income").val());
                    _this.education =$.trim($("#standard_education").val());
                    _this.liveplace =$.trim($("#standard_liveplace").val());
                    _this.house = $.trim($("#standard_house").val());
                    _this.position = $.trim($("#standard_position").val());
                    $.ajax({
                        url:'/admin/api/standard_edit',
                        dataType:"json",
                        type:'post',
                        data:_this,
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
                        }
                    });
                });

                var uploader = WebUploader.create({
                    auto: true,
                    swf: '/static/swf/Uploader.swf',
                    server: '/admin/upload',
                    pick: '#filePicker',
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,bmp,png',
                        mimeTypes: 'image/*'
                    }
                });

                uploader.on( 'uploadSuccess', function( file,response ) {
                    var html= '<a class="example-image-link" data-lightbox="example-set"  href="'+response.data+'" rel="lightbox" >'+'<img src="'+response.data+'" width="200" height="200" >'+'</a>';
                    $("#file_List").html(html);
                    $("#file_List").attr("val",1);
            		$.post({
             	        url:'/admin/UserDetailEdit',
             	        data:{header_url: response.data,uid:$("#uid").val()},
             	        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
             	        }
                 	});
                    $("#header_url").val(response.data);
                    $( '#'+file.id ).addClass('upload-state-done');

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
            		var params = "img_url="+response.data+"&fid="+$("#fid").val()+"&uid="+$("#uid").val()+"&is_cover=0";
            		$.post({
             	        url:'/admin/update_findImg',
             	        data:params,
             	        success:function(result){
                 	        init();
             	        }
                 	});
            	});
                
                $("div.album").hover(function(){
                    $(this).find('.toolBar').show();
                },function(){
                    $(this).find('.toolBar').hide();
                });
                $(".del_album").on("click",function(e){
                    var id =$(this).attr('val');
                    layer.confirm('您确定要删除该照片吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                        $.ajax({
                            url: '/admin/api/user_del_album',
                            dataType: "json",
                            type: 'post',
                            data: {id: id},
                            success: function (result) {
                                if(result.error==0){
                                    layer.msg('删除成功', {icon: 1, time: 1000});
                                    window.parent.location.reload();
                                }else{
                                    layer.msg(result.msg, {icon: 2, time: 1000});
                                }

                            }
                        });
                    },function(){

                    })
                });
                $(".del_avater").on("click",function(e){
                    var id =$("#header_url_id").val();
                    var dom =$(this);
                    var falg=$(this).parents('#fileList').children("#file_List").attr("val");
                    layer.confirm('您确定要删除此头像吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                        if(falg==1){
                            layer.msg('删除成功', {icon: 1, time: 1000});
                            dom.parents('#fileList').children("#file_List").html('');
                            return false;
                        }
                        $.ajax({
                            {{--url: '/admin/api/user_del_album',--}}
                            url: '/admin/api/user_del_avater',
                            dataType: "json",
                            type: 'post',
                            data: {id: id},
                            success: function (result) {
                               if(result.error==0){
                                   layer.msg('删除成功', {icon: 1, time: 1000});
                                   dom.parents('#fileList').children("#file_List").html('');
                                   init();
                               }else{
                                   layer.msg(result.msg, {icon: 2, time: 1000});
                               }
                            }
                        });
                    },function(){

                    })
                });
            }

        });


        
    </script>
@endsection
