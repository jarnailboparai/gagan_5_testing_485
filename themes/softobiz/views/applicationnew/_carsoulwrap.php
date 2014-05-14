<link href="<?php echo $pathurl ?>/css/select_content.css" rel="stylesheet" type="text/css">
<script src="<?php echo $pathurl ?>/js/jcarforlistselect.js" type="text/javascript"></script>
<script src="<?php echo $pathurl?>/js/jquery.mousewheel.js" type="text/javascript"></script>

  	<div class="loader"></div>
<div class="crousel_wrap"  >


	<button class="prev">
		<img src="images/crousel_left.png" alt="left" />
	</button>
	<div class="crosel_invisible_wrap"  >
		<div class="manual_crousel"  style=" visibility: hidden;" >
			<ul>
			   	<?php  $i = 0; foreach($data as $key => $modulefile){ 	?>
           		<li id="name_<?php echo $i; ?>" class="select_app_feature">
					<img src="<?php echo $url ?>/images/<?php echo strtolower(str_replace(' ','_',$modulefile)); ?>.png" alt="<?php echo $modulefile ?>" />
					<div class="app_feature_title" data-toggle="tooltip" title="<?php echo $modulefile ?>"><?php echo $modulefile ?></div>
					<div class="select_feature">
						<img class="addFeaturesClass" src="images/select_feature2.png" />
					</div>
                    <div class="upcoming_feature"></div>
				</li>                 
				<?php $i++; }?>
			</ul>
		</div>
	</div>
	<button class="next">
		<img src="images/crousel_right.png" alt="left" />
	</button>
	<div class="clear"></div>

</div>
	<div style="display:none" >
		<?php //if(count($selected)){ ?>
		<?php echo $this->renderPartial('_formfeatureSelect', array('model'=>$model,'data'=>$data)); ?>
		<?php //} ?>
	</div>
    
    <script type="text/javascript">

    window.listFeaturesLi = '<li id="#"><div class="wrapperli"><a id="#" href="#"></a><div class="pull-right edit_icon"><span class="drag"><img alt="edit" src="/members/wizard/themes/softobiz/img/drag.png"></span><span onclick="javascript:popupdetial(this)"><img alt="edit" src="/members/wizard/themes/softobiz/img/edit_content.png"></span>  <span onclick="popdetialHide(this)"><img alt="refresh" src="/members/wizard/themes/softobiz/img/refresh.png"></span> <span onclick="removeModule(this)"><img alt="remove" src="/members/wizard/themes/softobiz/img/trash_icon.png"></span></div></div></li>'
         	jQuery(document).ready(function(){
				jQuery(".manual_crousel").jCarouselLite({
 						auto: false, speed: 500,circular: false, visible: 5,btnNext: ".next",btnPrev: ".prev", mouseWheel: true  
 				});

 				jQuery('.manual_crousel ul li').click(function(){
						//console.log(jQuery(this));
 	 				});

 				jQuery('.addFeaturesClass').unbind('click').click(function(){
						
						idM = jQuery(this).parent().parent().attr('id');
    			
		    			var da = document.getElementById('Module_'+idM); 
		    			
		    			da.checked = true;

		    			console.log(idM);

		    			jQuery('#form-featuresSelect').submit();

		    			da.checked = false;


						
 	 				});

				jQuery('#form-featuresSelect').submit(function(e){
					e.preventDefault();
				    var postData = $(this).serialize();
				    var actionUrl = document.getElementById('form-featuresSelect');

					
				    $.ajax({
				        type: 'POST',
				        url: actionUrl.action,
				        data: postData,
				        success: function(response){

				        	
							var dataLi = JSON.parse(response);

							addListFeatureLi(dataLi);

							console.log(dataLi);

							jQuery('#form-featuresSelect')[0].reset;

				        	
				        },
				        error: function(){
				            alert('error');
				            jQuery('#form-featuresSelect')[0].reset;

				        }

				        
				    }); 
				   
				});

				
			}); 


    		$(window).load(function() {
    			$(".crousel_wrap").fadeIn("slow");
    		});

    		function checkFeature($arg)
    		{
    			//console.log($arg);
    			//console.log(jQuery($arg).attr('id'));
    			
    			idM = jQuery($arg).attr('id');
    			
    			var da = document.getElementById('Module_'+idM); 
    			
    			if(da.checked)
    			{
    				da.checked = false;
    				 //jQuery($arg).find(".features").removeClass('enabled');
    			}else{
    				da.checked = true;
    				 //jQuery($arg).find(".features").addClass('enabled');
    			}
    			
    			//console.log(idM,'aa');
    		}

    		function addListFeatureLi(arg)
    		{
				var dataAdd = jQuery(window.listFeaturesLi);

				if(arg.success){

					var imageData = '<span class="content_list_icon"><img id="img_'+arg.data.id+'" src="'+themeurl+'/img/'+arg.data.name+'.png'+'"></span>'+arg.data.tab_title; 
					
					jQuery(dataAdd).attr('id','module_'+arg.data.id);
					jQuery(dataAdd).find('.wrapperli a:first').attr('id',arg.data.name);
					//jQuery(dataAdd).find('.wrapperli a:first').text(arg.data.tab_title);
					jQuery(dataAdd).find('.wrapperli a:first').html(imageData);
					//console.log();
	    			if(arg.data.name.indexOf('staticpage') !== -1 ){
	        			console.log("staticpage");
	        			var hrefdata = '<?php echo CHtml::normalizeUrl(array("applicationnew/customizeModuleContent"));?>'+"&module_id="+arg.data.id;

	        			jQuery(dataAdd).find('.wrapperli a:first').attr('href',hrefdata);
	        			jQuery(dataAdd).find('.pull-right.edit_icon span:first').attr('id','staticPageFormButton_'+arg.data.id);
	        			
	        			
	        			jQuery('.featurelist ul').append(dataAdd);
	        			
	    			}else if(arg.data.name.indexOf('photo') !== -1){
	    				console.log('photo');
	    				var hrefdata = '<?php echo CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnewdesign"));?>'+"&module_id="+arg.data.id;

	    				jQuery(dataAdd).find('.wrapperli a:first').attr('href',hrefdata);
	    				
	    				jQuery('.featurelist ul').append(dataAdd);
	    			}else if(arg.data.name.indexOf('video') !== -1){
	    				console.log('video');
	    				var hrefdata = '<?php echo CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnewdesign"));?>'+"&module_id="+arg.data.id;

	    				jQuery(dataAdd).find('.wrapperli a:first').attr('href',hrefdata);

	    				
	    				jQuery('.featurelist ul').append(dataAdd);
	    			}else{
	    				console.log('genral');
	    				var hrefdata = '<?php echo CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnew"));?>'+"&module_id="+arg.data.id;

	    				jQuery(dataAdd).find('.wrapperli a:first').attr('href',hrefdata);

	    				jQuery('.featurelist ul').append(dataAdd);

	    				imageData = '';
	    			}

				}
        	}
	</script>
    <script type="text/javascript">
	jQuery(document).ready(function(){
    $('.app_feature_title').tooltip('hide')
	});
    </script>
