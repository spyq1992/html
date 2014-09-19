<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
  <div class="container">
  <div class="row">
    <div class="span8">

  <?=form_open('index/do_login','class="form-horizontal"') ?>
  <fieldset>
      <div id="legend" class="">
      	
			
      	
        <legend class=""><input type="radio" name="olduser" id="olduser" value="accept" checked="checked"  /> 绑定-已有账号</legend>
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
	<div class="sub-btn" id='control3'>
      <button type="button" class="btn btn-large" type="button" name="submit" id="login-submit-btn" style="margin-left:275px;">绑定</button>
    </div>
    </fieldset>
 
    

    </div>
       <div class="span4">
      <div id="legend" class="">
          <legend class="">快速通过社交帐号登录</legend>
        </div>
        <div id="legend" class="">
          <a href="<?=base_url('index/loginWithWeibo')?>"><img src="<?=base_url('resource/images/sinaweibo.gif') ?>"></a>
          <br><br>
          <a href=""><img src="<?=base_url('resource/images/douban.png') ?>"></a>
          <legend class="" style="margin-top:20px"></legend>
          已有帐号？
          <button type="submit" class="btn btn-primary" type="button">登录</button>
          
        </div>
    </div>
    

  <div class="container">
  <div class="row">
    <div class="span8">


    <fieldset>
      <div id="legend" class="">
	      
        <legend class=""><input type="radio" name="newuser" id="newuser" value="accept"   /> 绑定-新账号</legend>
      </div> <?=form_close() ?><?=form_open('index/do_regist','class="form-horizontal"') ?>
    <div class="control-group" id='control4'>

          <!-- Text input-->
          <label class="control-label" for="input01">邮箱</label>
          <div class="controls">
            <input type="text" placeholder="您的邮箱地址" class="input-xlarge" id="email" name="email">
            <p class="help-block"></p>
            <input type="hidden" id="email_code">
            <span class="prompt" id="email_prompt"></span>
          </div>
        </div>


    <div class="control-group" id='control5'>

          <!-- Text input-->
          <label class="control-label" for="input01">密码</label>
          <div class="controls">
            <input type="password" placeholder="您的密码" class="input-xlarge" maxlength="20" id="pwd" name="pwd">
            <p class="help-block">6-20位字母或数字组合</p>
            <span class="prompt" id="pwd_prompt"></span>
          </div>
        </div>

    <div class="control-group" id='control6'>

          <!-- Text input-->
          <label class="control-label" for="input01">再次输入密码</label>
          <div class="controls">
            <input type="password" placeholder="确认密码" class="input-xlarge" maxlength="20" id="cpwd" name="cpwd">
            <p class="help-block"></p>
            <span class="prompt" id="cpwd_prompt"></span>
          </div>
        </div>


    <div class="control-group" id='control7'>

          <!-- Text input-->
          <label class="control-label" for="input01">真实姓名</label>
          <div class="controls">
            <input type="text" placeholder="您的姓名" class="input-xlarge" id="name" name="name">
            <p class="help-block"></p>
            <span class="prompt" id="name_prompt"></span>
          </div>
        </div>

        <div class="control-group" id='control8'>

          <!-- Text input-->
          <label class="control-label" for="input01">验证码</label>
          <div class="controls">
            <img src="<?php echo base_url('index/show_captcha');?>" onclick="this.src='<?php echo base_url('index/show_captcha?');?>'+Math.random();"   />
            <input type="captcha" placeholder="" class="input-xlarge" maxlength="10" id="captcha" name="captcha" style="width:190px">
            <p class="help-block"></p>
            <input type="hidden" value="" id="captcha_code">
            <span class="prompt" id="captcha_prompt"></span>
          </div>
        </div>




    <div class="sub-btn" id='control9'>
      <button type="button" class="btn btn-large" type="button" name="submit2" id="regis-submit-btn" style="margin-left:275px;">注册</button>
    </div>
    </fieldset>
     <?=form_close() ?>

    </div>
   
  </div>
</div>
</body>
<? $this->load->view('inc/footer_view') ?>