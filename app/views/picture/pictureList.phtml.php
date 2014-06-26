<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>  
<?php 
	echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Aqua/css/ligerui-all.css");
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery/jquery-1.3.2.min.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/json2.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/core/base.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDialog.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerTextBox.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerCheckBox.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerComboBox.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerGrid.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDateEditor.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerSpinner.js");	
	echo Phalcon\Tag::javascriptInclude("js/checkouttime.js" );
    ?>
    	<script type="text/javascript">
        //var DepartmentList = DepartmentData.Rows;
        $(f_initGrid);
        var EmployeeData= {Rows:<?php echo $jsonData;?>};
        var manager, g;
        function f_initGrid()
        {
            g = manager = $("#maingrid4").ligerGrid({
                columns: [
                { display: '图片编号', name: 'picId', width: '10%', type: 'int',  },
                { display: '所属场地', name: 'staName',width: '20%', },
                { display: '是否设为封面', name: 'isCover',width: '20%',},
                { display: '图片地址', name: 'picUrl',width: '25%',},
                { display: '操作',  isSort: false, width: '25%', render: function (rowdata, rowindex, value)
                {
                    var h = "";
                    if (!rowdata._editing)
                    {
                        h += "<a href='javascript:f_open(" + rowindex + ","+rowdata.picId+")'>修改</a> ";
                        h += "<a href='javascript:deleteRow(" + rowindex + ","+rowdata.picId+")'>删除</a> "; 
                    }
                    return h;
                }
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
            	height:'100%'
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
        		url: "editPicture/?id="+trueid, 
        		width: 600, 
        		showMax: true, 
        		showToggle: false, 
        		showMin: false, 
        		name:'piciframe',
				isResize: false, 
				slide: false });
			 }
			 });
        	
				//document.frames("piciframe").location.reload();
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
		         $.post("deletePic",{id:trueid},function(result){
    			if(result=='1'){
    				manager.deleteRow(rowid);
    			}
    			else{
    				alert(result);
    				manager.deleteRow(rowid);
    			}
  				});
            }
    	    }
    	   });
        	//-------------------
        }
    </script>
 </head>    
<body style="padding:6px; overflow:hidden;">
	<div id="searchbar">
	<form action="pictureList" method="post">
    场地名称：
    <select name="stadiumName">
    	<option value="0">---请选择---</option>
    	<?php
    	foreach ($stadiumList as $key => $value) 
    	{
    		echo '<option value="'.$key.'">'.$value.'</option>"';			
		}
    	?>
    </select>
    <input id="btnOK" type="submit" name="search" value="search" />
    </form>
	</div>
	<div id="maingrid4" ></div>
</body>
</html>
