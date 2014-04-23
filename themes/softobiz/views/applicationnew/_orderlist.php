<?php /* code by sob_k  
	   * java script function for reorder list and save in db	
       */?>
<script type="text/javascript">
    var flagloader = false;
    
    $(function() {
    	$( "#sortable" ).sortable({
    		axis: 'y',
    		containment: "parent" ,
    		 update: function (event, ui) { 
    			 var data = $(this).sortable('serialize');
    			 $.post(baseurl+'/index.php?r=tutorial/orderlist',data,function(reponse){
    				 //console.log(reponse);
    				 buildApp();
    				 refresh_iframe();
    				 
    				});
        		 }
        	});
    	});



    $(function() {
    	$( "#wrapperliUl" ).sortable({
    		axis: 'y',
    		containment: "parent" ,
    		 update: function (event, ui) { 
    			 var data = $(this).sortable('serialize');
    			 $.post(baseurl+'/index.php?r=tutorial/subpageorderlist',data,function(reponse){
    				 //console.log(reponse);
    				 buildApp();
    				 refresh_iframe();
    				 
    				});
        		 }
        	});
    	});


    $( "#wrapperliUl" ).hover(function() {
		var count = $('#wrapperliUl li').children('#formId').length;
		if(count>0)
		{
			 $( "#wrapperliUl").sortable("disable");
		}
		else
		{
			$( "#wrapperliUl").sortable("enable");
		}
   
});
 </script>
