<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
<div class="container">
	
		<div class="span12">
			<div class="row">
		<div class="page-header">
				<h1>
					搜索结果
				</h1>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>
							用户头像
						</th>
						<th>
							用户名
						</th>
						<th>
							简介
						</th>
						<th>
							操作
						</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$count=0;
					foreach ($user_list as $key => $value) {
							$count++;
							?>

							<tr <?php if($count%2==0){echo "class='info'";}?>>
								<td>
									<img src="<?=base_url('data/avatar/personal/'.$value['avatar'])?>"  class="img-polaroid" width="50px" height="50px">
								</td>
								<td>
									<?=$value['real_name'] ?>
								</td>
								<td>
									<?=$value['info'] ?>
								</td>
								<td>
									<a href="<?=site_url('personal/profile/'.$key) ?>">
										<input type="button"  class="btn btn-info" value="查看">
									</a>
								</td>
							</tr>
							<?
					}

				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
<? $this->load->view('inc/footer_view') ?>