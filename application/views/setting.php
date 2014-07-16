<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="tabbable" id="tabs-975778">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-574400" data-toggle="tab">地点通讯录</a>
					</li>
					<li>
						<a href="#panel-574401" data-toggle="tab">头像设置</a>
					</li>
					<li>
						<a href="#panel-771637" data-toggle="tab">详细设置</a>
					</li>
					<li>
						<a href="#panel-771638" data-toggle="tab">安全设置</a>
					</li>
				</ul>

				<div class="tab-content">

				<div class="tab-pane active" id="panel-574400">
					<div class="row">
						<div class="span8">
							<?php
								if($is_edit==0)
								{
							?>

				  <?=form_open('personal/add_location','class="form-horizontal"') ?>
				    <fieldset>
				      <div id="legend" class="">
				        <legend class="">添加—我的据点</legend>
				      </div>


				<div class="span12 map" id="setting_map" style="margin-bottom:20px;">
				            <script type="text/javascript">

				      			// 百度地图API功能
				      			var map = new BMap.Map("setting_map");            // 创建Map实例
				      			map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
								map.enableScrollWheelZoom(true);
								map.centerAndZoom("北京",12);                   // 初始化地图,设置城市和地图级别。

				      			map.addEventListener("click",function(e){
				                map.clearOverlays();
				                var point = new BMap.Point(e.point.lng,e.point.lat);
				                var marker = new BMap.Marker(point);  // 创建标注
				                map.addOverlay(marker); 
				                document.getElementById("locpoint").value=e.point.lng+","+e.point.lat;
				      			});
				      		</script>
					</div>


				<div class="control-group">
						
				          <!-- Text input-->
				          <label class="control-label" for="input01">选择城市</label>
				          <div class="controls">
				             <select id="city_select" onchange="city_to_map()">
								<option value="北京">北京市</option>
								<option value="上海">上海市</option>
								<option value="西安">西安市</option>
								<option value="南京">南京市</option>
								<option value="武汉">武汉市</option>
								<option value="广州">广州市</option>
								<option value="沈阳">沈阳市</option>
								<option value="天津">天津市</option>
								<option value="重庆">重庆市</option>
								<option value="长春">长春市</option>	
							</select>
							<input type="hidden" id="selected_city" name="selected_city" value="北京">
				            <span class="prompt" id="locname_prompt"></span>
				          </div>
				        </div>


				    <div class="control-group">

				          <!-- Text input-->
				          <label class="control-label" for="input01">据点名称</label>
				          <div class="controls">
				            <input type="text" placeholder="您的据点名称" class="input-xlarge" id="locname" name="locname">
				            <p class="help-block"></p>
				            <span class="prompt" id="locname_prompt"></span>
				          </div>
				        </div>


				    <div class="control-group">

				          <!-- Text input-->
				          <label class="control-label" for="input01">据点坐标</label>
				          <div class="controls">
				            <input type="text" placeholder="您的据点坐标" class="input-xlarge" id="locpoint" name="locpoint" readonly="readonly">
				            <span class="prompt" id="locpoint_prompt"></span>
				          </div>
				        </div>

				        <div class="control-group">

				          <!-- Text input-->
				          <label class="control-label" for="input01">据点描述</label>
				          <div class="controls">
				            <textarea id="locdes" name="locdes"></textarea>
				          </div>
				        </div>

						<div class="add-btn">
							<button type="submit" class="btn btn-large" type="button" name="addloc" id="add-location-btn" style="margin-left:275px;">添加</button>
						</div>

				    </fieldset>
				     <?=form_close() ?>
				     <?php 
				     	}
				     	else if($is_edit==1)
				     	{
				     		?>
						    <?=form_open('personal/do_edit_location','class="form-horizontal"') ?>
						    <fieldset>
						      <div id="legend" class="">
						        <legend class="">编辑—我的据点</legend>
						      </div>


						<div class="span12 map" id="setting_map" style="margin-bottom:20px;">
						            <script type="text/javascript">

						      			// 百度地图API功能
						      			var map = new BMap.Map("setting_map");            // 创建Map实例
						      			map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
										map.enableScrollWheelZoom(true);
										var point_edit = new BMap.Point(<?=$edit_location_info['location_point']?>); 
										map.centerAndZoom(point_edit,14);                   // 初始化地图,设置城市和地图级别。



										map.addEventListener("tilesloaded",function(){	
											var point_edit = new BMap.Point(<?=$edit_location_info['location_point']?>);
							                var marker_edit = new BMap.Marker(point_edit);  // 创建标注
							                map.addOverlay(marker_edit); 
										});


						                map.addEventListener("click",function(e){
						                map.clearOverlays();
						                var point = new BMap.Point(e.point.lng,e.point.lat);
						                var marker = new BMap.Marker(point);  // 创建标注
						                map.addOverlay(marker); 
						                document.getElementById("locpoint").value=e.point.lng+","+e.point.lat;
						      			});						      			
						      		</script>
							</div>


						<div class="control-group">
								
						          <!-- Text input-->
						          <label class="control-label" for="input01">选择城市</label>
						          <div class="controls">
						             <select id="city_select" onchange="city_to_map()">
										<option value="北京">北京市</option>
										<option value="上海">上海市</option>
										<option value="西安">西安市</option>
										<option value="南京">南京市</option>
										<option value="武汉">武汉市</option>
										<option value="广州">广州市</option>
										<option value="沈阳">沈阳市</option>
										<option value="天津">天津市</option>
										<option value="重庆">重庆市</option>
										<option value="长春">长春市</option>	
									</select>
									<input type="hidden" id="selected_city" name="selected_city" value="北京">
						            <span class="prompt" id="locname_prompt"></span>
						          </div>
						        </div>


						    <div class="control-group">

						          <!-- Text input-->
						          <label class="control-label" for="input01">据点名称</label>
						          <div class="controls">
						            <input type="text" placeholder="您的据点名称" class="input-xlarge" id="locname" name="locname" value="<?=$edit_location_info['location_name'] ?>">
						            <p class="help-block"></p>
						            <span class="prompt" id="locname_prompt"></span>
						          </div>
						        </div>


						    <div class="control-group">

						          <!-- Text input-->
						          <label class="control-label" for="input01">据点坐标</label>
						          <div class="controls">
						            <input type="text" placeholder="您的据点坐标" class="input-xlarge" id="locpoint" name="locpoint" readonly="readonly" value="<?=$edit_location_info['location_point'] ?>">
						            <span class="prompt" id="locpoint_prompt"></span>
						          </div>
						        </div>

						        <div class="control-group">

						          <!-- Text input-->
						          <label class="control-label" for="input01">据点描述</label>
						          <div class="controls">
						            <textarea id="locdes" name="locdes"><?=$edit_location_info['location_des'] ?></textarea>
						          </div>
						        </div>

								<div class="add-btn">
									<button type="submit" class="btn btn-large" type="button" name="addloc" id="add-location-btn" style="margin-left:275px;">提交</button>
								</div>

						    </fieldset>


				     		<?php
				     	}
				     ?>
						</div>
						<div class="span4">
							<div id="legend" class="">
					        <legend class="">我的据点通讯录</legend>
					        <table class="table table-condensed">
								<tbody>
									<?php
										if(count($location_list)==0)
										{
											echo "尚未添加据点...";
										}
										else{
										$count=0;
						        			foreach ($location_list as $key => $value) {
						        					$count++;		
							        				echo "<tr>";
							        						echo "<td>";
								        					echo $count;
								        					echo "</td>";

								        					echo "<td>";
								        					echo "<form action='".site_url()."personal/location_operate' method='POST' id='operate_loc_form".$value['id']."'>";
								        					echo "<input type='hidden' name='location_id' value='".$value['id']."'>";
								        					echo "<input type='hidden' name='operate_type' id='operate_type".$value['id']."' value=''></form>";
								        					echo "</td>";

								        					echo "<td>";
								        					echo $value['location_name'];
								        					echo "<br>描述：".$value['location_des'];
								        					echo "<br>操作：<button class='btn btn-small btn-info' type='button' onclick='edit_submit(".$value['id'].")'>编辑</button><button class='btn btn-small btn-danger' type='button' onclick='delete_submit(".$value['id'].")'>删除</button>";
								        					echo "</td>";

								        					$mapurl="http://api.map.baidu.com/staticimage?width=100&height=100&center=".$value['location_point']."&markers=".$value['location_point']."&zoom=11&markerStyles=s,".$value['location_name'].",0xff0000";
								        					echo "<td>";
								        					echo "<img src='".$mapurl."'>";
								        					echo "</td>";
								        					
								        			echo "</tr>";
						        		 		
								        	}
								        }
							        ?>
								</tbody>
							</table>
					      </div>
					      <div id="legend" class="">
					      	
					      </div>
						</div>
					</div>
				</div>

				
					<div class="tab-pane" id="panel-574401">
						<p>
							当前头像：
							<img src="<?=base_url('data/avatar/personal/'.$user_einfo['avatar'])?>"  class="img-polaroid" alt="140x140" width="140px" height="140px">
						</p>
						<br>
						<p>
								设置新头像(支持JPG、JPEG、GIF和PNG文件，最大2M)
								<?=form_open_multipart('personal/setting_avatar') ?>		
								<span href="" class="btn-blue">
									浏览
									<?=form_upload('userfile','', 'id="userfile"') ?>
								</span>
								<?=form_submit('submit', '上传','class="btn btn-primary" id="upload_avatar"') ?>
								<?=form_close() ?>
						</p>

					</div>
					
					<div class="tab-pane" id="panel-771637">
						<p>
							<?=form_open_multipart('personal/setting_info') ?>
							个人简介：<input type="text" placeholder="<?=$user_einfo['info']?>" name="userinfo">
							<?=form_submit('submit', '更新','class="btn btn-primary" id="upload_info"') ?>
							<?=form_close() ?>
						</p>
					</div>
					<div class="tab-pane" id="panel-771638">
						<p>
							原密码：<input type="password"  name="oldpwd"><br>
							新密码：<input type="password"  name="newpwd"><br>
							确认新密码：<input type="password" name="cnewpwd"><br>
							<input type="button"  class="btn btn-primary" value="更新"><br>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
<? $this->load->view('inc/footer_view') ?>