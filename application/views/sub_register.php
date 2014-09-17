<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
  <div class="container">
  <div class="row">
    <div class="span8">

  <?=form_open('index/do_login','class="form-horizontal"') ?>
  <fieldset>
      <div id="legend" class="">
        <legend class="">绑定-已有账号</legend>
      </div>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="input01">邮箱</label>
          <div class="controls">
            <input type="text" placeholder="您的邮箱地址" class="input-xlarge" id="email" name="email">
            <p class="help-block"></p>
            <input type="hidden" id="email_code">
            <span class="prompt" id="email_prompt"></span>
          </div>
        </div>


   		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="input01">密码</label>
          <div class="controls">
            <input type="password" placeholder="您的密码" class="input-xlarge" maxlength="20" id="pwd" name="pwd">
            <span class="prompt" id="pwd_prompt"></span>
          </div>
        </div>
	<div class="sub-btn">
      <button type="button" class="btn btn-large" type="button" name="submit" id="regis-submit-btn" style="margin-left:275px;">绑定</button>
    </div>
    </fieldset>
 

<?=form_close() ?>
   
