<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<div class="row-fluid manage_apps media_gallery tab_gallery video_gallery edit_outer_title" >
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
             <?php //print_r($data->attributes);die; ?>
             <?php // add id by sob_k?>
            <!-- <div id="mediafileeditable_<?php echo $data->videomedia->id ?>" class="video_title"><?php echo $data->videomedia->title ?></div> -->
           
            <div id="videodetail"><a id="videodetailtitle_<?php echo $data->videomedia->id ?>" data-target="#myModalVideodetail"
			href="<?php echo CHtml::normalizeUrl(array('tutorial/videodetail','module_id'=>$data->videomedia->id,'layout'=>1))?>"
			 data-toggle="modal"><?php echo $data->videomedia->title; ?></a> </div>
          </div>
         <?php /* code by sob_k ?>
          <a data-target="#myModalVideodetail"
			href="<?php echo CHtml::normalizeUrl(array('tutorial/videodetail','module_id'=>$data->videomedia->id,'layout'=>1))?>"
			role="button" class="btn" data-toggle="modal"><?php echo $data->videomedia->title; ?></a> 
			 
		<?php // code end */?>	
 	</li>
<?php } ?>
<?php }else{?>
<li> No any data found </li>
<?php }?>
</ul>
</div>
