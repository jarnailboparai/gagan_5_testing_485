<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<script src="<?php echo $pathurl; ?>/js/validate.js"></script>
<script>
$().ready(function() {
	$("#videodetail_form").validate({
		rules: {
			"VideoFiles[title]": "required",	
			"VideoFiles[description]": "required", 	
		},
		messages: {
			"VideoFiles[title]": "Please enter Title",
			"VideoFiles[description]": "Please enter Description",
		}
	});

});

</script>


<div class="form">
 <?php echo CHtml::beginForm('', 'post', array('id'=>'videodetail_form','onSubmit' => "return false")) ; ?>
    <?php echo CHtml::errorSummary($model); ?>
 
    <div class="row">
        <?php echo CHtml::activeLabel($model,'title'); ?>
        <?php echo CHtml::activeTextField($model,'title') ?>
        <?php echo CHtml::activeHiddenField($model, 'id')?>
    </div>
 
    <div class="row">
        <?php echo CHtml::activeLabel($model,'description'); ?>
        <?php echo CHtml::activeTextArea($model,'description') ?>
       
    </div>
 
   
   
 
<?php echo CHtml::endForm(); ?>
</div>

<script>
function submit_detail()
{
	if($("#videodetail_form").valid())
	{	
		var data = {};
		data["Videodetail[id]"] = $("#VideoFiles_id").val();
		data["Videodetail[name]"] = $("#VideoFiles_title").val();
		data["Videodetail[description]"] = $("#VideoFiles_description").val();
		
	    $.ajax({
	        type: 'POST',
	        url: baseurl+'/index.php?r=tutorial/editvideodetail',
	        data: data,
	        success: function(response){

	        	jQuery('.modal-backdrop').remove();
		        
	        	$("#myModalvideogallerydetail").removeData("modal");
	        	$('#myModalvideogallerydetail').hide();
	        	//jQuery('.modal-backdrop').remove();
	        	 jQuery('#myModalVideo').removeData("modal");
	        	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});
	        	
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	}
	
}


</script>
