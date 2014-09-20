<div class="test">
	<?php 
	echo form_open('partyWizard/index');
	echo form_input(array('name'=>'名称'));
	echo form_textarea(array('name'=>'内容概述'));
	echo form_hidden(array('id'=>'calendar'));
	echo form_submit('test','下一步');
	
	//http://zhidao.baidu.com/question/580116667.html
	//日历
?>
    <table border="0" cellpadding="0" cellspacing="0">
   	<tr>
   		<th>星期日</th>
   		<th>星期一</th>
   		<th>星期二</th>
   		<th>星期三</th>
   		<th>星期四</th>
   		<th>星期五</th>
   		<th>星期六</th>
	</tr>
	<?php 
	$format = 'DATE_RFC822';
	$time = time();
	var_dump($expression);
	// switch (standard_date($format, $time)) {
		// case 'value':
// 			
			// break;
// 		
		// default:
// 			
			// break;
	// }
	?> 
    </table>
</div>