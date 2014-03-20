<?php /* code by sob_k
	   * java script function for reorder list and save in db	
       */?>
<script type="text/javascript">
    var flagloader = false;

    $(function() {
    	$( "#sortable" ).sortable({
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
 </script>
