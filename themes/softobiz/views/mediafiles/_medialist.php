<?php foreach($dataProvider as $data){?>
<li onclick="liUpdateSelectImageMedia(this);" class="span3 <?php if(in_array($data->id,$selected)){ ?> enabled <?php }  ?>" id="mediafile_<?php echo $data->id ?>" >

			<div class="app_box">
				<div class="app_thumb">
				<?php $r = pathinfo($data->filename);  
					echo CHtml::image(Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/'.$r['filename'].'_256x256.jpg'); ?>
				</div>
				<div class="select_feature">
					<?php echo CHtml::image('images/select_feature.png')?>
				</div>
				
				<div class="image_title" >
					<a id="mediafileeditable_<?php echo $data->id ?>" class="mediafile_original_name editable editable-click"><?php echo $data->original_name ?></a>
				</div>
			</div>
<input <?php if(in_array($data->id,$selected)){ ?>
		checked="checked" <?php }  ?> type="checkbox"  value="<?php echo $data->id ?>"  name="selected[]" style="display:none"  id="checkmedia" />
</li>
<?php } ?>
