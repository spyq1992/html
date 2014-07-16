<? $this->load->view('inc/header_view') ?>
<body onload="show();">
<? $this->load->view('inc/nav_view') ?>
<script type="text/javascript">  
                    var i = 6 ;  
                    function show(){                                
                       i-=1 ;  
                       document.getElementById('show').innerHTML=i ;  
                       if(i   ==   1)  
                       {  
                       window.location.href='<?php echo $jump_url;?>';  
                       }  
                       window.setTimeout("show()",1000);             
                    }            
</script>  
	<div class="container">
	<div class="row">
		<div class="span12">
			<div class="alert alert-<?php echo $message_type;?>">
			  <h4><?php echo $title;?></h4>
			  <?php echo $message;?>
			  <p><div id="show"></div>秒钟后自动跳转回首页...</p>
			</div>
		</div>
	</div>
</div>
</body>
<? $this->load->view('inc/footer_view') ?>