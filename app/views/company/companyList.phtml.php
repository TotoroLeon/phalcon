<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>  
<?php 
    //echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Aqua/css/ligerui-all.css"); 
	//echo Phalcon\Tag::javascriptInclude("js/lib/jquery/jquery-1.5.2.min.js");
	//echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/ligerui.min.js");
	//echo Phalcon\Tag::javascriptInclude("js/lib/EmployeeData.js");
    //echo Phalcon\Tag::javascriptInclude("js/lib/DepartmentData.js");
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
        var sexData = [{ Sex: 1, text: '男' }, { Sex: 2, text: '女'}];
        $(f_initGrid);
        var EmployeeData= {Rows:<?php echo $jsonData;?>};
        var manager, g;
        function f_initGrid()
        {
            g = manager = $("#maingrid").ligerGrid({
            	height:'100%',
                columns: [
                { display: '公司编号', name: 'companyId', width: '20%', type: 'int',  },
                { display: '公司名称', name: 'companyName',width: '50%',
                    editor: { type: 'text'}
                },
                { display: '操作',  isSort: false, width: '30%', render: function (rowdata, rowindex, value)
                {
                    var h = "";
                    if (!rowdata._editing)
                    {
                        h += "<a href='javascript:beginEdit(" + rowindex + ","+rowdata.companyId+")'>修改</a> ";
                        h += "<a href='javascript:deleteRow(" + rowindex + ","+rowdata.companyId+")'>删除</a> "; 
                    }
                    else
                    {
                        h += "<a href='javascript:endEdit(" + rowindex + ","+ rowdata.companyId +")'>提交</a> ";
                        h += "<a href='javascript:cancelEdit(" + rowindex + ")'>取消</a> "; 
                    }
                    return h;
                }
                }
                ],
                onSelectRow: function (rowdata, rowindex)
                {
                    $("#txtrowindex").val(rowindex);
                },
                enabledEdit: true,clickToEdit:false,
                data: EmployeeData,isScroll: true,
                pageSize:15,
            	pageSizeOptions: [15, 30, 45, 60, 75, 90, 105],
                width: '100%'
            });   
        }
        function beginEdit(rowid,trueid) { 
        	
    	    	 manager.beginEdit(rowid);
        }
        function cancelEdit(rowid,trueid) { 
            manager.cancelEdit(rowid);
           // window.location.reload();
        }
        function endEdit(rowid,trueid,name)
        {
        	//提交保存
        	$.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
   	    		return false;
    	    }
    	    else{
    	    	manager.endEdit(rowid);
        	var vall=JSON.stringify(manager.getUpdated());
        	$.post("editCompany",{jsonData:vall},function(result){
    			if(result=='1'){
    			}
    			else{
    				alert(result);
    				manager.beginEdit(rowid);
    			}
  				});
    	    }
    	   });
        	//-------------
        	
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
		        $.post("deleteCompany",{id:trueid},function(result){
    			if(result=='1'){
    				manager.deleteRow(rowid);
    			}
    			else{
    				alert('wrong');
    			}
  				});
            }
    	    }
    	   });	
        }
        
        
    </script>
 </head>    
<body style="padding:6px; overflow:hidden;">
	<div id="searchbar">
	<form action="companyList" method="post">
    公司名称：<input name="companyName" value="" type="text" />
    <input id="btnOK" type="submit" name="search" value="search" />
    </form>
	</div>
<div id="maingrid" ></div>
</body>
</html>
