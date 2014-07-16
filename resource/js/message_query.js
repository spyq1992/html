$(function () {
	//3s once  
    getMsgCount(); //first time   
    //window.setInterval(getMsgCount,5000); //loooooop  
    }  
);  


function getMsgCount() {
//get count of message(mssage+friend reuqest)  
    $.ajax({
              type:"post",
              data: "user_id=" + $("#uid").val(),
              url:"/message/get_msg_count_ajax",
               success: function(result)
               {
                    if(result!=0)
                    {
                    	$("#msg_count_span").html(result);
                	}
                	else{
                		$("#msg_count_span").html('');
                	}
               },                       
               error: function(res)
               {
               		console.log(res);
                    alert("系统错误，请稍候重试...");
               }
        	});
}; 


function fqbtn_click()
{
	//set this user's all "is_read" of fq 1
	$.ajax({
              type:"post",
              data: "user_id=" + $("#uid").val(),
              url:"/message/fq_hasread_ajax",
               success: function(result)
               {
           			$("#fq_count_span").html(''); 
               },
               error: function()
               { 
                   $("#fq_count_span").html(''); 
               }
       });
}


