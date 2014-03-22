
<div id="queueOpen" class="align-center"></div> 
	<form>
<!--  		<div id="queue" class="align-center"></div>  -->
		<div class="media_gallery_footer upload_footer">
		
		<div class="align-center uploads">
			<input id="file_upload_bg" name="file_upload_bg" type="file" multiple="true" class='btn btn-primary'>
			<a class="btn btn-warning" href="javascript:$('#file_upload_bg').uploadifive('upload')">Upload Files</a>
		</div>
		</div>
	</form>

	
	<script>

	$(function() {
		$('#file_upload_bg').uploadifive({ 
			 'auto'            : false,
			 'removeCompleted' : false,
			 'multi'    : false,
			'formData'         : {
				   'timestamp' : '<?php echo time();?>',
				   'token'     : '<?php echo md5('unique_salt' . time());?>'
                 },

			'uploadScript'     : '<?php echo CHtml::normalizeUrl(array('tutorial/changeappbg'))?>',
			'onUploadComplete' : function(file, data) { 
						$('.uploadifive-queue').html('');
						buildApp();
								 },
			
	       
		});
	});


	</script>
