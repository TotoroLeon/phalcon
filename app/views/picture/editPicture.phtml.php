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
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/jquery.validate.min.js"); 
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/jquery.metadata.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/messages_cn.js");    
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
    	function onsub(){
		$.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
   	    		return false;
    	    }
    	    else
    	    {
				document.getElementById("form1").submit();
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
                <select name="stadiumId">
                <?php 
                foreach ($stadiumList as $key => $value) {
                	if($pictureInfo['stadiumId']==$key){
                    	echo '<option value="'.$key.'" selected>'.$value.'</option>';
					}
					else{
						echo '<option value="'.$key.'" >'.$value.'</option>';
					}
                }
                
                ?>
                </select>
                	<td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">原图:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo '<img src="/public/images/'.$pictureInfo["picUrl"].'" width="100" height="100"/>';?>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">修改图片:</td>
                <td align="left" class="l-table-edit-td">
                <input type="file" name="newpicture" />
                <td align="left"></td>
            </tr>
        </table>
 <br />
 <input  type='hidden' name="picId" value="<?php echo $pictureInfo['picId'];?>"/>
 <input type="hidden" name="oldpicUrl" value="<?php echo $pictureInfo['picUrl'];?>" />
 <input type="hidden" name="userId" value="<?php echo'2'; ?>" />
 <input type="hidden" name="userIp" value="<?php echo'0000000';?>" />
 <input type="hidden" name="sub" value="提交" />
 <input type="button" value="提交" name="sub" id="Button1" class="l-button l-button-submit" onclick="return onsub()" /> 
<input type="button" value="测试" class="l-button l-button-test"/>
    </form>
    <div style="display:none">
    <!--  数据统计代码 --></div>

    
</body>
</html>