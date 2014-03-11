
<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<?php //$selected = array(1,3,5,7); ?>
<?php //$module_id = 1704; ?>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
<style>
.modal.fade.in {
    top: 5% !important;
}
.row h3{
    background: none repeat scroll 0 0 #F5F5F5;
    border: 1px solid #DDDDDD;
    font-size: 16px;
    padding: 0px 10px;
}
</style>
	<link rel="stylesheet" type="text/css" href="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/css/jquery-editable.css" />
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery.poshytip.js"></script>
	<script type="text/javascript" src="<?php echo $pathurl; ?>/js/jqueryeditable/jquery-editable/js/jquery-editable-poshytip.js"></script>

 <!-- Gallery Thumbs -->
    <div class="row-fluid manage_apps media_gallery edit_video_title">
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'selected-images-videos',
        	'action'=> CHtml::normalizeUrl(array('videofiles/selectvideos')),
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	'onsubmit' => 'return false;'
            ),
        )); ?>
        <div class="row" ><h3>Youtube</h3><div class="cleaxfix"></div></div>
    	<ul id="medialist" class="add_video_list row-fluid">
			<?php echo $this->renderPartial('_medialist',array('dataProvider'=>$dataProvider,'selected'=>$selected,'module_id'=>$module_id));?>
		<!--	<div class="row" ><h3>Custom</h3><div class="cleaxfix"></div></div> -->
			<?php echo $this->renderPartial('_medialist',array('dataProvider'=>$dataProviderCustom,'selected'=>$selected,'module_id'=>$module_id));?>
		</ul>
		<?php  echo CHtml::hiddenField('module_id',$module_id); ?>
		<div id="done" style="width:100%;float:left; display:none; ">
			<input class="done" id="donevideo" style="width:100px;float:left; padding:5px; margin:5px;"  type="submit" name="done" value="Done" >
		</div>
		
		 <?php $this->endWidget(); ?>
    </div>
    
   
    <!-- Gallery Thumbs Ends Here --> 
    <script>
	$(document).ready(function(){
		$('#medialist li').on('click',function(){
			

			if($(this).hasClass('enabled'))
			{	
				$(this).removeClass('enabled');
				$(this).find('#checkmedia').attr("checked",false);
				//console.log($(this).attr('id'));
			}else{
				$(this).addClass('enabled');
				$(this).find('#checkmedia').attr("checked",true);	
				//console.log($(this).attr('id'));
			}
		});

	});
</script>
<script>
jQuery(document).ready(function(){
	
	jQuery('#selected-images-videos').submit(function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('selected-images-videos');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				//console.log('aa');
				var arg = response.trim();
				if(arg == 'stop'){
					jQuery('.photowrapper').removeClass('show');
					jQuery("#myModalMediaImage").modal('toggle');
					jQuery( "#imageListUpdateVideo").html(response);
					jQuery( ".row-fluid.manage_apps.media_gallery.tab_gallery.video_gallery").show();
					 //jQuery('#myModalVideo').removeData("modal");
					
					 jQuery('.modal-backdrop').remove();
					 jQuery('#myModalVideo').modal('hide');
					 jQuery('#myModalVideo').removeData('modal');
				}else{
					jQuery( "#imageListUpdateVideo").html(response);
					jQuery( ".row-fluid.manage_apps.media_gallery.tab_gallery.video_gallery").show();
					 //jQuery('#myModalVideo').removeData("modal");
					
					 jQuery('.modal-backdrop').remove();
					 jQuery('#myModalVideo').modal('hide');
					 jQuery('#myModalVideo').removeData('modal');

						if(!jQuery('.photowrapper').hasClass('show'))
							jQuery('.photowrapper').addClass('show');
		        	 //jQuery('#myModalVideo').modal({show:false,remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});
		        	 //jQuery('#myModalVideo').modal("hide");
					//jQuery( ".close" ).trigger( "click" );
		        	//popdetialHideOther(arg);
				}
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});

	jQuery('#donevideomodal').click(function(){
		
		jQuery( "#donevideo" ).submit();
	});

	jQuery('.edit_video').on('click',function(e){
		e.preventDefault();
		//console.log('editvideo',jQuery(this).attr('href'));
		jQuery('#myModalVideo').modal('hide');
		jQuery('#myModalVideoCustom').removeData("modal");
   	 	jQuery('#myModalVideoCustom').modal({remote: jQuery(this).attr('href')});
   	 	//jQuery('#myModalVideoCustom').modal('show');

	});

	jQuery('.videofile_name').editable({
		mode:'inline',
		/*validate: function(value) {
			var num_reg = /^\d{1,5}(\.\d{1,2})?$/;
			if(!num_reg.test(value)) {
			return 'Please Enter valid amount';
			}
		},*/
		url:function(value){
			var id=$(this).attr('id').split('_');
			var data = {};
			console.log($(this));
			data["VideoFiles[id]"] = id[1];
			data["VideoFiles[name]"] = value.value;
			jQuery.post(baseurl+'/index.php?r=videofiles/nameedit',data,function(response){
				//return response.Number.forward_number;
			});
		},
	});

	
			
	
});

function openAddMore(arg)
{
	var link = jQuery(arg).attr('link');
	console.log(link);
	jQuery('#myModalVideo').modal('hide');
	jQuery('#myModalSelectVideo').modal({remote: link});
	
}
</script>
