<?php foreach($dataProvider as $data){?>
 <li class="span3 video_model_list <?php if(in_array($data->id,$selected)){ ?> enabled <?php }  ?>" id="mediafile_<?php echo $data->id ?>" >
              <div class="app_box">
            <div class="app_thumb"> 
            <?php if($data->type == 1) {?>
	            <img src="<?php echo $data->thumbnail_url ?>" alt="app thumb" /> 
            <?php }elseif($data->type == 2){ ?>
            
<!--             <a class="btn btn-info add_more_videos" data-toggle="modal" role="button" href="/members/wizard/index.php?r=videofiles/create&module_id=1704&layout=1" data-target="#myModalVideoCustom">Custom Add More</a> -->
 		<a href="<?php echo CHtml::normalizeUrl(array('videofiles/update','id'=>$data->id,'layout'=>1,'selected'=>$data->thumbnail_url,'module_id'=>$module_id))?>" class="edit_video btn" >Edit </a>
			
 
 <!--           	<img src="<?php echo $data->thumbnail_url ?>" alt="app thumb" />  -->
            	<?php //echo CHtml::image('images/select_feature.png','custom')?>
            	<?php $r = pathinfo($data->filemediaImage->filename);   echo CHtml::image(Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/'.$r['filename'].'_256x256.jpg'); ?>
            	<?php //print_r($data->filemediaImage->filename); ?>
            <?php }?>
            </div>
            <div class="select_feature"><?php echo CHtml::image('images/select_feature.png')?></div>
            <div class="video_title">
            	<?php //echo $data->title ?>
            	<?php //print_r($data->attributes);die; ?>
            <?php /* ?>	<a id="mediafileeditable_<?php echo $data->id ?>" class="videofile_name editable editable-click"><?php echo $data->title ?></a> <?php */ ?>
           <div id="videogallerydetail">
           
            <a id="videogallerydetailtitle_<?php echo $data->id ?>" data-target="#myModalvideogallerydetail"
			href="<?php echo CHtml::normalizeUrl(array('tutorial/videodetailgallery','video_id'=>$data->id,'module_id'=>$module_id,'layout'=>1))?>"
			 data-toggle="modal"><?php echo $data->title ?></a> 
           
           </div>
            </div>
           
         
    <!--      <a class="custom_icon"	id="myModalvideogallerydetail" href="javascript:editdetail('a#myModalvideogallerydetail')" link="<?php echo CHtml::normalizeUrl(array('tutorial/videodetailgallery','module_id'=>$data->id,'layout'=>1))?>" >
		Edit Description
	</a> -->
         
          </div>
          <input <?php if(in_array($data->id,$selected)){ ?>
		checked="checked" <?php }  ?> type="checkbox"  value="<?php echo $data->id ?>"  name="selected[]" style="display:none"  id="checkmedia" />
          
</li>
<?php } ?>


