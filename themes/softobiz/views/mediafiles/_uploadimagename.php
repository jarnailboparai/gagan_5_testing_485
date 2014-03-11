<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<!-- <script src="<?php echo $url; ?>/js/uploadifive/jquery.min.js" type="text/javascript"></script> -->

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
		<div class="media_gallery_footer upload_footer">
		
		<div class="align-center uploads">
			<input id="file_upload" name="file_upload" type="file" multiple="true" class='btn btn-primary'>
			<a class="btn btn-warning" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>
		</div>
		<button  style="padding: 7px;" aria-hidden="true" data-dismiss="modal" class="close btn cancel_singlepage" type="button">Cancel</button>
		</div>
	</form>

	<script>
	var liTemplate = '<li class="span2" onclick="liUpdateSelect(this);" >';
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
		window.myqueue = 0;
		window.myformdata =  new Object;
		$(function() {
			$('#file_upload').uploadifive({
				 'auto'            : false,
				 'removeCompleted' : false,
				//'successTimeout' 	: 5,
				//'checkScript'      : window.themeurl+'/checkexists',
				'checkScript'		: '<?php echo CHtml::normalizeUrl(array('mediafiles/checkexists'))?>',
				'formData'         : {
					   'timestamp' : '<?php echo time();?>',
					   'token'     : '<?php echo md5('unique_salt' . time());?>'
                     },

						
									
									<?php /*{
									   'timestamp' : '<?php echo time();?>',
									   'token'     : '<?php echo md5('unique_salt' . time());?>'
				                     }
				                     				'formData'         : function () {
										var data = new Object;
										
										data.timestamp = '<?php echo time();?>';
										data.token     = '<?php echo md5('unique_salt' . time());?>';
										return data;
									},
				                     *
				                     */?>
				'queueID'          : 'queueOpen',
				'uploadScript'     : '<?php echo CHtml::normalizeUrl(array('mediafiles/uploadfilenew'))?>',
				'onUploadComplete' : function(file, data) { 

					openCloseCustomImageName();
									 },
				 'onAddQueueItem' : function(file,queue) {
			            console.log('The file ' + file.name + ' was added to the queue!', file,window.myqueue);
			            editableName  = '<span>';
			            editableName += '<input type="text" name="nameoriginal_'+file.name+'" value="' +file.name+'" />';
			            editableName += '</span>';

			            console.log($(this),$("#queueOpen .uploadifive-queue-item:last").attr('id'));

			            var idNa = $("#queueOpen .uploadifive-queue-item:last").attr('id');

			            jQuery('#'+idNa+ " div:first ").append(editableName);
	

			            /*
			            window.myformdata.idNa = file.name;
			            
			            var dataFile = new Object;

			            dataFile.lll = window.myformdata;
			            dataFile.count = window.myqueue;
			            $( this ).serializeArray();
			            var datata = $('#queueOpen :input').serialize();
			            console.log(datata);
			            this.data('uploadifive').settings.formData = { images : datata };
			            console.log(dataFile,window.myformdata); */
			        },
		        'onSelect' : function(queue) {
		           // alert(queue.queued + ' files were added to the queue.');
		        	window.myqueue = queue.count;
					
		        },
		        'onCancel' : function(file){
						
						window.myqueue = window.myqueue - 1; 
						console.log("file",file,window.myqueue );
			    },
			    'onUpload'     : function(filesToUpload) {
		            var datata = $('#queueOpen :input').serialize();

		            console.log(datata);
		            
		            this.data('uploadifive').settings.formData = { images : datata };
		            //console.log(dataFile,window.myformdata);
		        }
			  
			});
		});

		jQuery(document).ready(function(){

			jQuery('#thumbdone').on('click',function(){
				$('#myModalThumb').modal('toggle');
			
				console.log($(window.imageThumbUrl).find("img:first").attr('src'));

				var idFiles = $(window.imageThumbUrl).attr('id');

				idFiles = idFiles.split('_');
				
				jQuery('#VideoFiles_thumbnail_url').val(idFiles[1]);

				jQuery("#thumbImage img:first").attr('src',$(window.imageThumbUrl).find("img:first").attr('src'));
				//console.log(window.imageThumbUrl);
			});

			
		});

		function openCloseCustomImageName()
		{
			
			jQuery('#myModalMediaImageName').modal('hide');
			jQuery('.modal-backdrop').remove();
			jQuery('#myModalMediaImage').removeData("modal");
			jQuery('#myModalMediaImage').modal({remote: "<?php echo CHtml::normalizeUrl(array('mediafiles/index','module_id'=>$module_id,'layout'=>1))?>"});

		}
	</script>
