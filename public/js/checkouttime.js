$.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
    	    	//f_alert2('success',result);
    	    	//document.getElementById("companyName").value="";
    	    }});
function checkouttime(){
    	$.post("../TestLogin/Userstate",{},function(result){
    	    if(result==403){
    	    	return false;
   	    		var m = $.ligerDialog.open({ url: '/public/outtime.html', height: 200, isResize: true }); 
   	    		setTimeout(function () { m.setUrl('../TestLogin/login'); }, 2000);
   	    		return false;
    	    }
    	    else{
    	    	return true;
    	    }
    	   });
    }