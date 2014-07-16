function city_to_map()
{
	var item = $("#city_select").find("option:selected").text();
	$("#locpoint").val('');
	var element = document.createElement("script"); 
    element.type = "text/javascript" ; 
    element.text = "var map = new BMap.Map(\"setting_map\");map.addControl(new BMap.NavigationControl());map.enableScrollWheelZoom(true);map.centerAndZoom(\""+item+"\",12);map.addEventListener(\"click\",function(e){map.clearOverlays();var point = new BMap.Point(e.point.lng,e.point.lat);var marker = new BMap.Marker(point);map.addOverlay(marker);document.getElementById(\"locpoint\").value=e.point.lng+\",\"+e.point.lat;});";
    $("#setting_map").html(element);
    $("#selected_city").val(item);
}

function edit_submit(rid)
{
	$("#operate_type"+rid).val('edit');
	$('#operate_loc_form'+rid).submit();
}

function delete_submit(rid)
{
	$("#operate_type"+rid).val('delete');
	$('#operate_loc_form'+rid).submit();
}

function add_submit()
{
	//判断是否为空、是否有标记点
	//成功后submit()
	//不成功显示具体错误信息
}