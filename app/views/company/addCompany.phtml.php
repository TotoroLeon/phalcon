<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
</title>
<?php 
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Aqua/css/ligerui-all.css"); 
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Silvery/css/style.css");
    echo Phalcon\Tag::stylesheetLink("js/lib/ligerUI/skins/Gray/css/all.css");
	echo Phalcon\Tag::javascriptInclude("js/lib/jquery/jquery-1.3.2.min.js");
	echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/core/base.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerForm.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerDateEditor.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerComboBox.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerCheckBox.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerButton.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerRadio.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerSpinner.js");
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerTextBox.js"); 
    echo Phalcon\Tag::javascriptInclude("js/plugins/ligerTip.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/jquery.validate.min.js"); 
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/jquery.metadata.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/messages_cn.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDrag.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/ligerUI/js/plugins/ligerDialog.js");
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/jquery.metadata.js" );
    echo Phalcon\Tag::javascriptInclude("js/lib/jquery-validation/messages_cn.js" );
	echo Phalcon\Tag::javascriptInclude("js/checkouttime.js" );
    ?>
    <style type="text/css">
           body{ font-size:12px;}
        .l-table-edit {}
        .l-table-edit-td{ padding:4px;}
        .l-button-submit,.l-button-test{width:80px; float:left; margin-left:10px; padding-bottom:2px;}
        .l-verify-tip{ left:230px; top:120px;}
    </style>
    <style type="text/css">
        .l-case-title{font-weight:bold; margin-top:20px;margin-bottom:20px;}
     </style>
     <script type="text/javascript">
     
         $(function() {
         });
         function f_alert2(type,value)
         {
             switch (type)
             {
                 case "success":
                     $.ligerDialog.success('添加成功');
                     break;
                 case "false":
                     $.ligerDialog.warn(value);
                     break;
             }
         }
     </script>

    <script language="JavaScript">
    
    function check(){
    	
     var data=$(":input[name='companyName']").val();
     if(data!='')
     {
		$.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
    	    	//f_alert2('success',result);
    	    	//document.getElementById("companyName").value="";
    	    }
    	    else{
    	    	$.post("addCompanyFunc",{companyName:data},function(result){
    	    			if(result==true){
    	    				f_alert2('success',result);
    	    				document.getElementById("companyName").value="";
    	    			}
    	    			else{
    	    				f_alert2('false',result);
    	    				document.getElementById("companyName").value="";
    	    			}});
    	    }
    	  	});
  			}
  		else{
  			document.getElementById("info").innerHTML='*公司名称不能为空！';
  		}
  		}	
    </script>

</head>

<body style="padding:10px">

    <form name="form1" method="post" action="" id="form1"  >
<div>
</div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">公司名称 :</td>
                <td align="left" class="l-table-edit-td">
                <?php echo Phalcon\Tag::textField(array("companyName", "size" => 30,"validate"=>'{required:true,minlength:3,maxlength:10}'));?>
				<label id='info' style="color: red"></label>
				<td align="left"></td>
            </tr>
        </table>
 <br />
 <!--
 <input type="hidden" name="userId" value="<?php echo $userInfo['userId'];?>">
 <input type="hidden" name="userIp" value="<?php echo $userInfo['userIp'];?>">
 -->
<input type="button" value="提交" id="Button1" class="l-button l-button-submit" onclick="return check()" /> 

    </form>
    <div style="display:none">
    <!--  数据统计代码 --></div>

    
</body>
</html>