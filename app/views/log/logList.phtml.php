<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>  
<?php 
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
	echo Phalcon\Tag::javascriptInclude("js/checkouttime.js" );
    ?>
    
 </head>    
<body style="padding:6px; overflow:hidden;">
	<div id="maingrid"></div>   	
  <script type="text/javascript">
    var griddata =<?php echo $jsonData;?>

     var grid = $("#maingrid").ligerGrid({
     		height:'100%',
            columns: [
                { name: 'lid', display: '记录编号', width: '10%' },
                { name: 'userName', display: '操作人', width: '15%' },
                { name: 'insertTime', display: '操作时间', width: '20%' },
                { name: 'content', display: '操作内容', width: '20%' },
                { name: 'insertIp', display: '操作Ip', width: '20%' },
                { name: 'typeId', display: '操作类型', width: '15%' }
            ],
            data: { Rows: griddata },isScroll: true,
            usePager:true,
            pageSize:15,
            pageSizeOptions: [15, 30, 45, 60, 75, 90, 105],
            width:'100%'
        }); 
</script>
   <!-- g data total ttt -->

</body>
</html>
