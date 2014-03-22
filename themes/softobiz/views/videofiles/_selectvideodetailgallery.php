

<div id="myModalvideogallerydetail" class="modal hide fade custom_modal"
	data-keyboard="true" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabel" class="pull-left">Video Gallery</h3>
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">x</button>
	

		<div class="clearfix"></div>
	</div>
	<div class="modal-body">




	
	</div>
	<div class="modal-footer">
		<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_detail()">Done</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>
<script>
$('#myModalvideogallerydetail').on('hidden', function(){
    $(this).data('modal', null);
    $("#myModalVideo").show();
});

$('#myModalvideogallerydetail').on('show', function(){
	//jQuery('.modal-backdrop').remove();
    $("#myModalVideo").hide();
});
</script>
