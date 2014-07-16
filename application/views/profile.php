<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
<div class="container">
	<div class="row">
		<div class="span4" style="border: 1px gray solid;padding-bottom: 50px;padding-left: 40px;background-color: aliceblue;margin-bottom:20px;">
			<h3><?=$user_ginfo['real_name'] ?>-个人主页</h3>
			<img src="<?=base_url('data/avatar/personal/'.$user_einfo['avatar'])?>"  class="img-polaroid" alt="140x140" width="140px" height="140px">
			<br><br><p style=""><span class="label label-info">个人简介：</span>	<?=$user_einfo['info'] ?>	</p>
			<div style="float:right;margin-right:30px;">
			<?php 
				if($relation=='nothing')
				{
			?>
			<a href="#add_friend" role="button" class="btn btn-info" data-toggle="modal">加为好友</a>
			 
			<!-- Modal -->
			<?=form_open_multipart('personal/add_friend') ?>
			<div id="add_friend" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">验证信息</h3>
				<input type="hidden" value="<?=$user_ginfo['id']?>" name="uid2">
			  </div>
			  <div class="modal-body">
				<img src="<?=base_url('data/avatar/personal/'.$user_einfo['avatar'])?>"  class="img-polaroid" alt="140x140" width="140px" height="140px">
			    <textarea placeholder="请输入验证信息..." name="vali_text" style="height:120px;width:315px;"></textarea>
			    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user_ginfo['real_name'] ?>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
			    <button class="btn btn-primary">发送请求</button>
			  </div>
			</div>

			<?=form_close() ?>
			<?php 
				}else if($relation=='is_friend'){
			?>
			<a href="#del_friend" role="button" class="btn btn-danger" data-toggle="modal">取消关注</a>
			
			<?=form_open_multipart('personal/add_friend') ?>
			<div id="del_friend" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">删除好友</h3>
				<input type="hidden" value="<?=$user_ginfo['id']?>" name="uid2">
			  </div>
			  <div class="modal-body">	
				<div class="alert alert-error">
				 <h4>警告</h4>
  					<br>确认删除该好友吗？
				</div>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
			    <button class="btn btn-primary">确认删除</button>
			  </div>
			</div>
			<?=form_close() ?>
			<?php
				}else if($relation=='is_sent'){
			?>
				<a href="#" class="btn btn-success disabled">已申请</a>
			<?php
				}
			?>
		</div>
		</div>

		


		<!--<div class="span8 map" id="profile_map" style="margin-bottom:20px;width:60%;height:359px;">
			
            <script type="text/javascript">

      			// 百度地图API功能
      			var map = new BMap.Map("profile_map");            // 创建Map实例
      			map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
				map.enableScrollWheelZoom(true);
				map.centerAndZoom(new BMap.Point(<?=$user_ginfo['location'] ?>),12);                   // 初始化地图,设置城市和地图级别。
				var marker1 = new BMap.Marker(new BMap.Point(<?=$user_ginfo['location'] ?>));  // 创建标注
				marker1.setAnimation(BMAP_ANIMATION_BOUNCE);
				map.addOverlay(marker1);              // 将标注添加到地图中
				</script>
		</div>-->
	</div>
</div>

</body>
<? $this->load->view('inc/footer_view') ?>