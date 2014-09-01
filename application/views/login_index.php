<?	$this->load->view('inc/header_view') ;

?>
<body>
<? $this->load->view('inc/nav_view') ?>
  <div class="container">
  <div class="row">
    <div class="span8">

  <?=form_open('index/do_login','class="form-horizontal"') ?>
    <fieldset>
      <div id="legend" class="">
        <legend class="">登录-聚会神器</legend>
      </div>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="input01">邮箱</label>
          <div class="controls">
            <input type="text" placeholder="您的邮箱地址" class="input-xlarge" id="email" name="email">
            <p class="help-block"></p>
            <span class="prompt" id="email_prompt"></span>
          </div>
        </div>

    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="input01">密码</label>
          <div class="controls">
            <input type="password" placeholder="您的密码" class="input-xlarge" maxlength="20" id="pwd" name="pwd">
            <p class="help-block"></p>
            <span class="prompt" id="pwd_prompt"></span>
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
          <span class="prompt" id="login_prompt"></span>
          </div>
        </div>

    <div class="log-btn">
      <button type="button" class="btn btn-large" type="button" name="submit" id="login-submit-btn" style="margin-left:275px;">登录</button>
    </div>
    </fieldset>
     <?=form_close() ?>

    </div>
    <div class="span4">
      <div id="legend" class="">
          <legend class="">快速通过社交帐号登录</legend>
        </div>
        <div id="legend" class="">
          <a href="http://http://23.89.232.77/sns/session/weibo"><img src="<?=base_url('resource/images/sinaweibo.gif') ?>"></a>
          
        </div>
    </div>
  </div>
</div>
</body>
<? $this->load->view('inc/footer_view') ?>