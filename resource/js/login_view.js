$.noConflict();
$(function() {
	$("#email").blur(function(){
		email_check();
	});
	
	$("#pwd").blur(function(){
		pass_check();
	});
	
	$("#login-submit-btn").click(function(){
		if(email_check()&&pass_check())
		{
			//ajax登录
			//成功跳转至首页，失败显示错误原因
			$.ajax({
	              type:"post",
	              data: "email_in=" + $("#email").val()+"&password_in="+$("#pwd").val(),
	              url:"/index/do_login",
	               success: function(result)
	               {
	                    if(result=='suc')
	                    {
	                    	$("#login_prompt").css({color:"green"});
							$("#login_prompt").text('登录成功！');
	                    	location.href="/index"; 
	                    }
	                    else if(result=='emptyemail'){
	                    	$("#login_prompt").css({color:"red"});
							$("#login_prompt").text('用户不存在！');
	                    }
	                    else if(result=='wrongpwd'){
	                    	$("#login_prompt").css({color:"red"});
							$("#login_prompt").text('密码错误！');
	                    }
	               },                       
	               error: function()
	               {
	                    alert("系统错误，请稍候重试...");
	               }
	        });

			//$(".log-btn").html('');
			//$(".log-btn").append("<button type='submit' class='btn btn-large' type='button' name='submit' id='login-submit-btn' style='margin-left:275px;'>登录</button>");
			//$("#login-submit-btn").click();
		}
		else{
			alert("登录信息填写有误，请检查！");
		}
	});
});


function pass_check() {
	val = $("#pwd").val();
	if(val=='') {
		$("#pwd_prompt").css({color:"red"});
		$("#pwd_prompt").text('密码不能为空');
		return false;
	} else if(val!=='') {
		$("#pwd_prompt").text('');
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
		} else {
			$("#email_prompt").text('');
			return true;
		}
}

 
