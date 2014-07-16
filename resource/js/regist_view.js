 $(function() {
	$("#name").blur(function(){
		name_check();
	});
	$("#pwd").blur(function(){
		pass_check();
	});
	$("#cpwd").blur(function(){
		cpass_check();
	});
	$("#regis-submit-btn").click(function(){
		if(($("#email_code").val()=='3')&&name_check()&&pass_check()&&cpass_check()&&($("#captcha_code").val()=='1'))
		{
			$(".sub-btn").html('');
			$(".sub-btn").append("<button type='submit' class='btn btn-large' type='button' name='submit' id='regis-submit-btn' style='margin-left:275px;'>注册</button>");
			$("#regis-submit-btn").click();
		}
		else{
			if(email_check()==false)
			{
				alert("邮箱填写有误，请检查！");
			}
			else if(name_check()==false)
			{
				alert("姓名填写有误，请检查！");
			}
			else if(pass_check()==false)
			{
				alert("密码填写有误，请检查！");
			}
			else if(cpass_check()==false)
			{
				alert("确认密码填写有误，请检查！");
			}
			else if($("#captcha_code").val()=='0')
			{
				alert("验证码填写有误，请检查！");
			}
			else{
				alert("注册信息填写有误，请检查！");
			}
		}
	});
});

$(function() {
	$("#captcha").blur(function(){
		$capt=$("#captcha").val();
		if($capt=='')
		{
			captcha_check(0);
		}else{
		  	$.ajax({
	              type:"post",
	              data: "captcha_in=" + $("#captcha").val(),
	              url:"/index/validate_authcode",
	               success: function(result)
	               {
	                    if(result=='suc')
	                    {
	                    	captcha_check(1);
	                    }
	                    else if(result=='fail')
	                    {
	                    	captcha_check(2);
	                    }
	               },                       
	               error: function()
	               {
	                    alert("系统错误，请稍候重试...");
	               }
	        	});
		}
	});
});


$(function() {
	$("#email").blur(function(){
		//1、检查是否为空
		//2、检查格式
		//3、检查是否可用
		val = $("#email").val();
		var myreg = /\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/;	
			if(val=='') {
				$("#email_code").val('0');
				$("#email_prompt").css({color:"red"});
				$("#email_prompt").text('邮箱不能为空');
			} else if(!myreg.test(val)) {
				$("#email_code").val('1');
				$("#email_prompt").css({color:"red"});
				$("#email_prompt").text('邮箱格式不正确');
			} else if(myreg.test(val)) {
				  	$.ajax({
			              type:"post",
			              data: "email_in=" + $("#email").val(),
			              url:"/index/validate_email",
			               success: function(result)
			               {
			                    if(result=='1')
			                    {
			                    	$("#email_code").val('2');
									$("#email_prompt").css({color:"red"});
									$("#email_prompt").text('邮箱已被占用');	
			                    }
			                    else if(result=='0')
			                    {
			                    	$("#email_code").val('3');
									$("#email_prompt").css({color:"green"});
									$("#email_prompt").text('邮箱有效');
			                    }
			               },                       
			               error: function()
			               {
			                    alert("系统错误，请稍候重试...");
			               }
			        	});
		  }
	});
});

function name_check() {
	val = $("#name").val();
	if(val==''){
			$("#name_prompt").css({color:"red"});
			$("#name_prompt").text('姓名不能为空');
			return false;
		}else if(val!=''){
			$("#name_prompt").css({color:"green"});
			$("#name_prompt").text('姓名有效');
			return true;
		}
}

function pass_check() {
	val = $("#pwd").val();
	if(val=='') {
		$("#pwd_prompt").css({color:"red"});
		$("#pwd_prompt").text('密码不能为空');
		return false;
	}else if(val!=''&&val.length<6){
		$("#pwd_prompt").css({color:"red"});
		$("#pwd_prompt").text('密码长度过短');
		return false;
	} 
	else if(val!=''&&val.length>=6) {
		$("#pwd_prompt").css({color:"green"});
		$("#pwd_prompt").text('密码有效');
		return true;
	}
}

function cpass_check() {
	val = $("#cpwd").val();
	cval = $("#pwd").val();
	if(val=='') {
		$("#cpwd_prompt").css({color:"red"});
		$("#cpwd_prompt").text('确认密码不能为空');
		return false;
	}else if(val!=cval){
		$("#cpwd_prompt").css({color:"red"});
		$("#cpwd_prompt").text('两次密码输入不同');
	} 
	else if(val==cval) {
		$("#cpwd_prompt").css({color:"green"});
		$("#cpwd_prompt").text('确认密码有效');
		return true;
	}
}

function email_check() {
	val = $("#email").val();
	var myreg = /\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/;	
		if(val=='') {
			$("#email_prompt").css({color:"red"});
			$("#email_prompt").text('邮箱不能为空');
			return false;
		} else if(!myreg.test(val)) {
			$("#email_prompt").css({color:"red"});
			$("#email_prompt").text('邮箱格式不正确');
			return false;
		}
}

function captcha_check(type) {
	if(type==0)
	{
		$("#captcha_code").val('0');
		$("#captcha_prompt").css({color:"red"});
		$("#captcha_prompt").text('验证码不能为空');
		return false;
	}
	else if(type==1)
	{
		$("#captcha_code").val('1');
		$("#captcha_prompt").css({color:"green"});
		$("#captcha_prompt").text('验证码正确');
		return true;
	}
	else if(type==2)
	{
		$("#captcha_code").val('0');
		$("#captcha_prompt").css({color:"red"});
		$("#captcha_prompt").text('验证码错误');
		return false;
	}
}
