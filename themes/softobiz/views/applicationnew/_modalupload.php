<!-- Modal -->
<!--<a data-target="#myModal" href="<?php echo CHtml::normalizeUrl(array('mediafiles/index','module_id'=>$data->id,'layout'=>1))?>" role="button" class="btn btn-primary big_btn" data-toggle="modal" >Add Images</a>
 -->
<!-- Modal -->
<div id="myModalMediaImage" class="modal hide fade custom_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">


<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button> -->
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
<h3 id="myModalLabel">Media Gallery
<button type="button" class="btn btn-primary " style="margin-left:10px;" onclick="openCloseMediaImage()" >Add more</button>
</h3>
<?php /*?><a data-target="#myModalMediaImageName" href="<?php echo CHtml::normalizeUrl(array('mediafiles/uploadImage','module_id'=>$data->id,'layout'=>1))?>" role="button" class="btn btn-primary big_btn" data-toggle="modal" >Add Images</a><?php */?>

</div>
<div class="modal-body" id="modalbodyhtml" >
<!-- Gallery Thumbs -->
<!-- Gallery Thumbs Ends Here -->
</div>
<div class="modal-footer">
<!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
<!-- <button class="btn btn-success">Upload Media</button> -->
<?php $this->renderPartial('//mediafiles/_uploadfilenew');?>
<?php //$this->renderPartial('//mediafiles/_uploadfilenew_background');?>
</div> 
</div>

<!-- Modal Ends Here -->
<script>



</script>
