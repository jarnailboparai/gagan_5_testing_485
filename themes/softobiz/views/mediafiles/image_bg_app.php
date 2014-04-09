<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
<?php $form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array('enctype' => 'multipart/form-data','id'=>'upload_bg')
)); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'uploadedFile_1'); ?>
        <?php echo $form->fileField($model, 'uploadedFile_1'); ?>
        <?php echo $form->error($model, 'uploadedFile_1'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'uploadedFile_2'); ?>
        <?php echo $form->fileField($model, 'uploadedFile_2'); ?>
        <?php echo $form->error($model, 'uploadedFile_2'); ?>
    </div>
    <input type="submit" value="Save">
<?php $this->endWidget(); ?>


<script>

/*
$('#upload_bg').submit(function (e) {
	  e.preventDefault();
	  $.ajax({
	    type: 'post',
	    contentType: 'multipart/form-data',
	    url: '<?php echo CHtml::normalizeUrl(array('tutorial/appbg'))?>',
	    data: $(this).serialize(),
	    success: function () {
	      alert('form was submitted');
	    }
	  });
	})
	*/
</script>
