<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $url; ?>/js/uploadifive/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $url; ?>/js/uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/js/uploadifive/uploadifive.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
.uploadifive-button {
	float: left;
	margin-right: 10px;
}
#queue{
	margin-bottom:10px;
}

</style>
<div id="queueOpen" class="align-center"></div> 
	<form>
<!--  		<div id="queue" class="align-center"></div>  -->
		<div class="media_gallery_footer">
		<button class="btn btn-success btn-large done_btn" type="button" id="formIdSubmit">Done</button>
		<div class="align-center uploads" style="width:15.5%;float:left;" >
			<input id="file_upload" name="file_upload" type="file" multiple="true" class='btn btn-primary'>
			<a style="position: relative;display:none; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>
		</div>
		</div>
	</form>

	<script>
	var liTemplate = '<li class="span3 ">';
	liTemplate += '<div class="app_box">';
	liTemplate += '<div class="app_thumb">';
	//liTemplate += '<img alt="ss" src="ssd">';
	liTemplate += '</div>';
	liTemplate += '<div class="select_feature">';
	liTemplate += '<img alt="" src="images/select_feature.png">';
	liTemplate += '</div>';
	liTemplate += '</div>';
	liTemplate += '</li>';
	</script>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadifive({
				'auto'             	: true,
				 'removeCompleted' : true,
				//'successTimeout' 	: 5,
				//'checkScript'      : window.themeurl+'/checkexists',
				'checkScript'		: '<?php echo CHtml::normalizeUrl(array('mediafiles/checkexists'))?>',
				'formData'         : {
									   'timestamp' : '<?php echo $timestamp;?>',
									   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				                     },
				//'queueID'          : 'queueOpen',
				'uploadScript'     : '<?php echo CHtml::normalizeUrl(array('mediafiles/uploadfile'))?>',
				'onUploadComplete' : function(file, data) { 

										var dataN = JSON.parse(data);

										var liNew = $(liTemplate);

										var name = dataN.image.filename.split('.');
										
										var imageUrls = dataN.url+'thumb/'+name[0]+'_256x256.jpg';

										var imageDiv = '<img alt="'+name[0]+'" src="'+imageUrls+'">';

										$(liNew).find('.app_thumb').append(imageDiv);

										$(liNew).append('<input type="checkbox"  value="'+dataN.image.id+'"  name="selected[]" style="display:none"  id="checkmedia" />');

										$(liNew).attr('id','mediafile_'+dataN.image.id);

										$("#medialist").append(liNew);
									 }
			});
		});
	</script>
