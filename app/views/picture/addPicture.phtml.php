<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>
<?php     
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Aqua/css/ligerui-all.css"); 
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Silvery/css/style.css");
	echo Phalcon\Tag::javascriptInclude("js/lib/jquery/jquery-1.3.2.min.js");
	echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/core/base.js");
	echo Phalcon\Tag::javascriptInclude("js/plugins/ligerForm.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerDateEditor.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerComboBox.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerCheckBox.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerButton.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerDialog.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerRadio.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerSpinner.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerTextBox.js"); 
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerTip.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDrag.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDialog.js");	
	echo Phalcon\Tag::javascriptInclude("js/checkouttime.js" );
    ?>
    <style type="text/css">
           body{ font-size:12px;}
        .l-table-edit {}
        .l-table-edit-td{ padding:4px;}
        .l-button-submit,.l-button-test{width:80px; float:left; margin-left:10px; padding-bottom:2px;}
        .l-verify-tip{ left:230px; top:120px;}
    </style>
    <script type="text/javascript">
    function check(){
    	$.post("../TestLogin/Userstate",{},function(result){
    	    if( result==403 ){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
    	    	//f_alert2('success',result);
    	    	//document.getElementById("companyName").value="";
    	    }
    	  else
    	  {
    	 	$.ligerDialog.waitting('正在保存中,请稍候...');
                     setTimeout(function ()
                     {
                         $.ligerDialog.closeWaitting();
                         document.getElementById('form1').submit();
                     }, 2000);
          }
          });
  		
  	}
    </script>

</head>

<body style="padding:10px">

    <form name="form1" method="post" action="addPictureFunc" id="form1"enctype="multipart/form-data">
<div>
</div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">所属场馆 :</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::selectStatic("stadiumId", $stadiumList);//输出下拉框 参数1、name名称和id 参数2、属性值 A为下拉框的value值 ?>
                	<td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">是否设为封面:</td>
                <td align="left" class="l-table-edit-td">
                <?php 
                echo Phalcon\Tag::radioField(array("isCover", "size" => 30,"value"=>'1'));echo "  是  ";
                echo Phalcon\Tag::radioField(array("isCover", "size" => 30,"value"=>'0'));echo "  否  ";;
                ?> 
                 </td><td align="left"></td>
            </tr>   
             <tr>
                <td align="right" class="l-table-edit-td">上传图片:</td>
                <td align="left" class="l-table-edit-td">
                <input type="file" name="picture" />
                <td align="left"></td>
            </tr>
        </table>
 <br />
 <input type="hidden" name="userId" value="<?php echo $userInfo["userId"];?>" />
 <input type="hidden" name="userIp" value="<?php echo ip2long($_SERVER["REMOTE_ADDR"]);?>" />
 <input type="button" value="提交" id="Button1" class="l-button l-button-submit" onclick="return check()"/> 
<input type="button" value="测试" class="l-button l-button-test"/>
    </form>
    <div style="display:none">
    <!--  数据统计代码 --></div>

    
</body>
</html>