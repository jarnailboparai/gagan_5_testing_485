<div class="nav_bottom">
        
              <div class="container">
                    
                        <div class="btn-group pull-left navbottom <?php echo $data['tabselect']; ?>">
                          <button class="btn app_info"><span>App Info</span></button>
                          <button class="btn look"><span>Look & Feel</span></button>
                          <button class="btn select_features"><span>Select Features</span></button>
                          <button class="btn content"><span>Select Content</span></button>
                        </div>
                        <?php if(isset($data['formId'])){ //die;?>
                        	<button onclick="submitFormMain('<?php echo $data['formId']?>');" class="btn btn-large pull-right save" type="button"><span>Save & Continue</span></button>
                        <?php }else{?>
                         	<button onclick="submitForm();" class="btn btn-large pull-right save" type="button"><span>Save & Continue</span></button>
                    	<?php }?>
                    </div>
        
        </div>
        
 <!-- Stick to top script -->
 <script type="text/javascript">
   // var flagloader = false;
$(document).ready(function() {
	var s = $(".nav_bottom");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos >= pos.top) {
			s.addClass("stick");
		} else {
			s.removeClass("stick");	
		}
	});
});
</script>
<style type="text/css">
.stick {
	position:fixed;
	top:0px;
	z-index:1000000;
	background:#fff;
}
</style>
 
 <!-- Stick to top script ends here -->
