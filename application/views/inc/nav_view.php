<?php 
	if($this->session->userdata('id'))
	{
		$is_login=1;
		$name=$this->session->userdata('real_name');
		$email=$this->session->userdata('email');
		$id=$this->session->userdata('id');
		$avatar=$this->session->userdata('avatar');
		$avatar_id=($avatar==$data['profile_image_url'])?('default'):($id);
	}
	else{
		$is_login=0;
	}
?>
 <script type="text/javascript" src="<?=site_url("/resource/js/message_query.js") ?>"></script>
<div class="navbar">
				<div class="navbar-inner-block">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> 
						 <a href="<?=site_url('') ?>" class="brand site-title">聚会神器</a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
								<?php if($is_login==0){?>
							<ul class="nav">
								<li class="active">
									<a href="<?=site_url('') ?>">欢迎您</a>
								</li>
								
								<li>
									<a href="<?=site_url('index/login/') ?>">登录</a>
								</li>
								<li>
									<a href="<?=site_url('index/register/') ?>" >注册</a>
								</li>
							</ul>
								<?php }else{?>
									<ul class="nav pull-left">
										<li class="dropdown active">
											 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img src="<? echo site_url('data/avatar/personal/')."/".$avatar_id.".jpg" ?>" width="25px" height="25px"><?php echo $name; ?><strong class="caret"></strong></a>
											<ul class="dropdown-menu">
												<li>
													<a href="#">我的聚会</a>
												</li>
												<li>
													<a href="<?=site_url('message/index/') ?>">我的消息
													<span class="badge badge-important" id="msg_count_span"></span></a>
												</li>
												<li>
													<a href="<?=site_url('personal/setting/') ?>">个人设置</a>
												</li>
												<li class="divider">
												</li>
												<li>
													<a href="#">我的收藏</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="<?=site_url('index/logout/') ?>" >登出</a>
										</li>
									</ul>
									<input type="hidden" value="<?=$id ?>" id="uid">
								<?php } ?>
							<ul class="nav pull-right">
								<li class="divider-vertical">
								</li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#">关于我们<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											<a href="#">团队介绍</a>
										</li>
										<li>
											<a href="#">新浪微博</a>
										</li>
										<li>
											<a href="#">隐私政策</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">其他</a>
										</li>
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
									<li>
										<?=form_open_multipart('search') ?>
											<input class="input-medium search-query" type="text" name="keyword"/> <button type="submit" class="btn">查找</button>
										<?=form_close() ?>
									</li>
								</ul>
						</div>
						
					</div>
				</div>
				
			</div>