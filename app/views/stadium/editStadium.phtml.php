<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>
<?php 
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Aqua/css/ligerui-all.css"); 
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Silvery/css/style.css");
	echo Phalcon\Tag::javascriptInclude("js/lib/jquery/jquery-1.3.2.min.js");
	echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/core/base.js");
	echo Phalcon\Tag::javascriptInclude("js/indexdata.js");
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
<script language="JavaScript">
	//	刷新
	function reset(){
		document.getElementById("form1s").submit();  
		
		parent.$(".l-dialog,.l-window-mask").remove();
		
		top.$.ligerDialog.getActive().getparent().reload(); 
	}
	function onsub(){
		$.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
   	    		return false;
    	    }
    	    else
    	    {
				document.getElementById("form1s").submit();
			}
		});
	}
	
</script>
</head>

<body style="padding:10px">

    <form name="form1s" method="post" action="editStadium" id="form1s">
<div>
</div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right"  width="80px"class="l-table-edit-td">所属公司 :</td>
                <td align="left" class="l-table-edit-td">
                <select name="belongComId">
                <?php 
                foreach ($companyInfo as $key=>$value){
                	if($key==$staInfo['belongComId']){
                		echo '<option value='.$key.' selected>'.$value;
                	}else{
                		echo '<option value='.$key.' >'.$value;
                	}
                }
                ?>
                </select>
                	<td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">选择封面图片:</td>
                <td align="left" class="l-table-edit-td">
                <?php 
                foreach ($pictureInfo as $key=>$value){
                	if($staInfo['staPicture']==$value['picId']){
                		echo'<input type="radio" name="staPicture" value="'.$value['picId'].'"checked />' ;
                		echo '<img src="\\public\\images\\'.$value['picUrl'].'" width="100" height="100" />';
                	}
                	else{
                		echo Phalcon\Tag::radioField(array("staPicture", "value"=>$value['picId'],"size" => 30,));
                		echo '<img src="\\public\\images\\'.$value['picUrl'].'" width="100" height="100" />';
                	}
                }
                ?>
                 </td><td align="left"></td>
            </tr>   
             <tr>
                <td align="right" class="l-table-edit-td">场馆名称:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::textField(array("staName", "size" => 20,'value'=>$staInfo['staName'])); ?>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">场馆地址:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::textField(array("staAddress", "size" => 30,'value'=>$staInfo['staAddress'])); ?>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">场馆容量:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::textField(array("staSize", "size" => 20,'value'=>$staInfo['staSize'])); ?>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">场馆经度:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::textField(array("gpsLong", "size" => 10,'value'=>$staInfo['gpsLong'])); ?>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">场馆纬度:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::textField(array("gpsDim", "size" => 10,'value'=>$staInfo['gpsDim'])); ?>
                <td align="left"></td>
            </tr>
        </table>
 <br />
 <input type="hidden" name="addUser" value="<?php echo 2;?>">
 <input type="hidden" name="addIp" value="<?php echo 12121121;?>">
 <input type="hidden" name="staId" value="<?php echo $staInfo['staId'];?>">
  <input type="hidden" name="sub" value="提交"/>
<input type="button" value="提交" id="Button1" name="sub" class="l-button l-button-submit" onclick="return onsub()"/> 
    </form>
    <div style="display:none">
    <!--  数据统计代码 --></div>

    
</body>
</html>