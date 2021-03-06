<? $this->load->view('inc/header_view')?>

<body>
	<? $this->load->view('inc/nav_view') ?>
	<div class="container">
		<div class="row">
			<div class="span8">

				 <?=form_open('index/link_sns','class="form-horizontal"') ?>
				<fieldset>
					<input type="hidden" id="uid" name='uid' value="<?=$uid?>" />
					<input type="hidden" id="type" name='type' value="<?=$type?>" />
					<input type="hidden" id="token[1]" name="access_token" value="<?=$token['access_token']?>" />
					<input type="hidden" id="token[2]" name="remind_in" value="<?=$token['remind_in']?>" />
					<input type="hidden" id="token[3]" name="expires_in" value="<?=$token['expires_in']?>" />
					<input type="hidden" id="token[4]" name="uid" value="<?=$token['uid']?>" />
					<div id="legend" class="">
			
						<legend class="">
							<input type="radio" name="olduser" id="olduser" value="1" checked="checked"  />
							绑定-已有账号
						</legend>
					</div>
					<div class="control-group" id='control1'>

						<!-- Text input-->
						<label class="control-label" for="input01">邮箱</label>
						<div class="controls">
							<input type="text" placeholder="您的邮箱地址" class="input-xlarge" id="user_email" name="user_email">
							<p class="help-block"></p>
							<input type="hidden" id="user_email_code">
							<span class="prompt" id="user_email_prompt"></span>
						</div>
					</div>

					<div class="control-group" id='control2'>

						<!-- Text input-->
						<label class="control-label" for="input01">密码</label>
						<div class="controls">
							<input type="password" placeholder="您的密码" class="input-xlarge" maxlength="20" id="user_pwd" name="user_pwd">
							<span class="prompt" id="user_pwd_prompt"></span>
						</div>
					</div>
					 <div class="control-group">
		          <div class="controls">
		          <span class="prompt" id="login_prompt"></span>
		          </div>
		        </div>

					<div id="legend2" class="">

						<legend class="">
							<input type="radio" name="olduser" id="newuser" value="2"   />
							绑定-新账号
						</legend>
					</div>
					<div class="control-group" id='control3'>

						<!-- Text input-->
						<label class="control-label" for="input01">邮箱</label>
						<div class="controls">
							<input type="text" placeholder="您的邮箱地址" class="input-xlarge" id="email" name="email">
							<p class="help-block"></p>
							<input type="hidden" id="email_code">
							<span class="prompt" id="email_prompt"></span>
						</div>
					</div>

					<div class="control-group" id='control4'>

						<!-- Text input-->
						<label class="control-label" for="input01">密码</label>
						<div class="controls">
							<input type="password" placeholder="您的密码" class="input-xlarge" maxlength="20" id="pwd" name="pwd">
							<p class="help-block">
								6-20位字母或数字组合
							</p>
							<span class="prompt" id="pwd_prompt"></span>
						</div>
					</div>

					<div class="control-group" id='control5'>

						<!-- Text input-->
						<label class="control-label" for="input01">再次输入密码</label>
						<div class="controls">
							<input type="password" placeholder="确认密码" class="input-xlarge" maxlength="20" id="cpwd" name="cpwd">
							<p class="help-block"></p>
							<span class="prompt" id="cpwd_prompt"></span>
						</div>
					</div>

					<div class="control-group" id='control6'>

						<!-- Text input-->
						<label class="control-label" for="input01">真实姓名</label>
						<div class="controls">
							<input type="text" placeholder="您的姓名" class="input-xlarge" id="name" name="name">
							<p class="help-block"></p>
							<span class="prompt" id="name_prompt"></span>
						</div>
					</div>

					<div class="control-group" id='control7'>

						<!-- Text input-->
						<label class="control-label" for="input01">验证码</label>
						<div class="controls">
							<img src="<?php echo base_url('index/show_captcha'); ?>" onclick="this.src='<?php echo base_url('index/show_captcha?'); ?>'+Math.random();"   />
							<input type="captcha" placeholder="" class="input-xlarge" maxlength="10" id="captcha" name="captcha" style="width:190px">
							<p class="help-block"></p>
							<input type="hidden" value="" id="captcha_code">
							<span class="prompt" id="captcha_prompt"></span>
						</div>
					</div>

				
				<div class="sub-btn" id='control8'>
					<button type="button" class="btn btn-large" type="button" name="submit2" id="link-btn" style="margin-left:275px;">
						绑定
					</button>
					<input type="submit"  value="提交" />
				</div>
				</fieldset>
				<?=form_close() ?>
				

			</div>

		</div>
	</div>
</body>
<? $this->load->view('inc/footer_view')
?>