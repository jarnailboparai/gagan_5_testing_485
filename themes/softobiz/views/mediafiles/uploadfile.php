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
#queue {
	border: 1px solid #E5E5E5;
	height: 177px;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
	width: 300px;
}
</style>
	<h1>UploadiFive Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>
	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadifive({
				'auto'             : false,
				//'checkScript'      : window.themeurl+'/checkexists',
				'checkScript'		: '<?php echo CHtml::normalizeUrl(array('mediafiles/checkexists'))?>',
				'formData'         : {
									   'timestamp' : '<?php echo $timestamp;?>',
									   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				                     },
				'queueID'          : 'queue',
				'uploadScript'     : '<?php echo CHtml::normalizeUrl(array('mediafiles/uploadfile'))?>',
				'onUploadComplete' : function(file, data) { console.log(data); }
			});
		});
	</script>
