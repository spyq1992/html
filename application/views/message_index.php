<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="tabbable" id="tabs-122050">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-35604" data-toggle="tab" id="zhannei_msg">站内信
						<?php 
						if($nfq_count!=0){?>
						<span class="badge badge-important"><?=$nfq_count?></span>
						<?php }?>
						</a>
					</li>
					<li>
						<a href="#panel-530089" data-toggle="tab" onclick="fqbtn_click()">好友请求
						<?php if($fq_count!=0){?>
						<span class="badge badge-important" id="fq_count_span"><?=$fq_count?></span>
						<?php }?>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-35604">
						<table class="table">
							<tbody>
								<?php
										foreach ($nfq_array as $key => $v) {
									?>
									<input type='hidden' class="nfqhidden">
								<tr>
									<td>
										<img src="<? echo site_url('data/avatar/personal/')."/".$v['avatar'] ?>" width="50px" height="50px">
										<br>
										<?=$v['real_name']?>
									</td>
									<td>
										<div class="alert alert-block">
											<h4><?=$v['msg_title'] ?>:</h4>
											<?=$v['msg_content'] ?><br>
											<?=$v['createtime'] ?>
											<a href="#">删除</a>
										</div>
									</td>
									<td>
										<div class="span4">
										</div>
									</td>
								</tr>
								<?php
										}
								?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="panel-530089">
						<table class="table">
							<tbody>
									<?php
										foreach ($fq_array as $key => $v) {
									?>
									<input type="hidden"
								<tr>
									<td>
										<img src="<? echo site_url('data/avatar/personal/')."/".$v['avatar'] ?>" width="50px" height="50px">
										<br>
										<?=$v['real_name']?>
									</td>
									<td>
										<div class="alert alert-block">
											<h4><?=$v['msg_title'] ?>:</h4>
											<?=$v['msg_content'] ?>
											<br>
												<?=form_open('personal/do_add_friend','class="form-horizontal"') ?>
													<input type="hidden" value="<?=$v['record_id'] ?>" name="record_id">
													<input type="hidden" value="<?=$v['msg_senderid'] ?>" name="sender_id">	
													<button class="btn btn-mini btn-primary" type="submit">同意</button>
												<?=form_close() ?>

												<?=form_open('personal/do_ignore_request','class="form-horizontal"') ?>
													<input type="hidden" value="<?=$v['record_id'] ?>" name="record_id">
													<button class="btn btn-mini btn" type="submit">忽略</button>
												<?=form_close() ?>

												<br>
												<?=$v['createtime'] ?>
										</div>
									</td>
									<td>
										<div class="span4">
										</div>
									</td>
								</tr>
								<?php
										}
								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
<? $this->load->view('inc/footer_view') ?>