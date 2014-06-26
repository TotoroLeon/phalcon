<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>  
<?php 
    //echo Phalcon\Tag::javascriptInclude("js/lib/EmployeeData.js");
    //echo Phalcon\Tag::javascriptInclude("js/lib/DepartmentData.js");
	echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Aqua/css/ligerui-all.css");
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery/jquery-1.3.2.min.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/core/base.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDialog.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerTextBox.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerCheckBox.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerComboBox.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerGrid.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDateEditor.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerSpinner.js");
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/ligerui-icons.css");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDrag.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerResizable.js");	
	echo Phalcon\Tag::javascriptInclude("js/checkouttime.js" );
    ?>
    <script type="text/javascript">
        //var DepartmentList = DepartmentData.Rows;
        var companyList = <?php echo $companyList ;?>;
        $(f_initGrid);
        var EmployeeData= {Rows:<?php echo $jsonData;?>};
        var manager, g;
        function f_initGrid()
        {
            g = manager = $("#maingrid4").ligerGrid({
            	height:'100%',
                columns: [
                { name: 'staId', display: '场地编号', width: '5%' },
                { name: 'staName', display: '场地名称', width: '15%' },
                {  name: 'companyName', display: '所属公司',width: '20%'},
                { name: 'picUrl', display: '封面图片', width: '15%'},                
                { name: 'staAddress', display: '场地地址', width: '20%'},
                { name: 'staSize', display: '场地容量', width: '10%' },
                { display: '操作',  isSort: false, width: '15%', 
                    render: function (rowdata, rowindex, value)
                {
                    var h = "";
                    if (!rowdata._editing)
                    {
                        h += "<a href='#' onclick='f_open("+rowindex+","+rowdata.staId+")'>修改</a> ";
                        h += "<a href='javascript:deleteRow(" + rowindex + ","+rowdata.staId+")'>删除</a> "; 
                    }
                    else
                    {
                        h += "<a href='javascript:endEdit(" + rowindex + ","+ rowdata.staId +")'>提交</a> ";
                        h += "<a href='javascript:cancelEdit(" + rowindex + ")'>取消</a> "; 
                    }
                    return h;
                },
                }
                ],
                onSelectRow: function (rowdata, rowindex)
                {
                    $("#txtrowindex").val(rowindex);
                },
                enabledEdit: true,clickToEdit:false, isScroll: true,
                data: EmployeeData,
                pageSize:15,
                pageSizeOptions: [15, 30, 45, 60, 75, 90, 105],
                width: '100%',
            });   
        }
        function f_open(rowindex,trueid)
        {
        	 $.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
   	    		return false;
    	    }
    	    else
    	    {
        		rowindex = $.ligerDialog.open({ 
        		height: 400, 
        		url: "editStadium/?id="+trueid, 
        		width: 600, 
        		showMax: true, 
        		showToggle: false, 
        		showMin: false, 
        		name:'divideiframe',
				isResize: false, 
				slide: false });
			 }
			 });
        }
        function deleteRow(rowid,trueid)
        {
            $.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
   	    		return false;
    	    }
    	    else{
    	    	if (confirm('确定删除?'))
            {
		        $.post("deleteStadium",{id:trueid},function(result){
    			if(result=='1'){
    				manager.deleteRow(rowid);
    			}
    			else{
    				alert(result);
    			}
  				});
            }
    	    }
    	   });
        }
        var newrowid = 100;
        function reload(){
        	window.location.reload();
        }
    </script>
 </head>    
<body style="padding:6px; overflow:hidden;">
<div id="searchbar">
	<form action="stadiumList" method="post">
    场地名称： <input name="stadiumName" value="" type="text" />&nbsp;&nbsp;
    场地地址： <input name="stadiumAddress" value="" type="text" />&nbsp;&nbsp;
    公司名称: <select name="belongComId">
    	<option  value="0">---请选择---</option>
    	<?php
    	foreach ($companyList as $key => $value) {
			echo '<option  value="'.$value['companyId'].'">'.$value['companyName'].'</option>';
		}
    	?>
    </select>
    &nbsp;&nbsp;&nbsp;
    <input id="btnOK" type="submit" name="search" value=" 查询 " />
    &nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
    <div id="maingrid4" style="margin-top:5px;"></div> <br />
       <br /> 
</body>
</html>
