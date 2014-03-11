<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<div class="row-fluid manage_apps media_gallery tab_gallery video_gallery" >
<ul id="medialist">
<?php if(count($dataProvider) > 0 ){?>
<?php foreach($dataProvider as $data){?>
 	<li class="span3" >
          <div class="app_box">
            <div class="app_thumb"> 
            
        
            
            <?php if($data->videomedia->type == 1) {?>
	            <img src="<?php echo $data->videomedia->thumbnail_url ?>" alt="app thumb" /> 
            <?php }elseif($data->videomedia->type  == 2){ ?>
 
            	<?php //echo CHtml::image('images/select_feature.png','custom')?>
            	<?php $r = pathinfo($data->videomedia->filemediaImage->filename);   echo CHtml::image(Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/'.$r['filename'].'_256x256.jpg'); ?>
            	<?php //print_r($data->filemediaImage->filename); ?>
            <?php }?>
            
            <div class="video_wrap"><img src="<?php echo $pathurl?>/img/play_icon.png" alt="Play Icon" /></div> </div>
              
            <div class="video_title"><?php echo $data->videomedia->title ?></div>
          </div>
 	</li>
<?php } ?>
<?php }else{?>
<li> No any data found </li>
<?php }?>
</ul>
</div>
