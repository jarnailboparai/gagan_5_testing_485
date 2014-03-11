<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<div class="row-fluid manage_apps media_gallery tab_gallery" >
<ul id="medialist">
	<?php foreach($dataProvider as $data){?>
	<li class="span3 " >
				<div class="app_box">
					<div class="app_thumb">
					<?php $r = pathinfo($data->filemedia->filename);  
						echo CHtml::image(Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/'.$r['filename'].'_256x256.jpg'); ?>
					</div>
					<div class="video_title"><?php echo $data->filemedia->original_name ?></div>
				</div>
	</li>
	<?php } ?>
</ul>
</div>
