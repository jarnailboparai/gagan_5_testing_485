<span class="icon_wrapper">
          <table cellpadding="0" cellspacing="0" class="pull-left app_info_select">        
                   <tr><td>
                   <?php if(isset($app_icon_img) && ($app_icon_img != NULL)) { ?>
                   <span class="change_icon_block_image_wrapper" style="display:block;"><img src="<?php Yii::getPathOfAlias('webroot'); echo $app_icon_img; ?>" /></span>
                   <?php } else { ?>
                   <span class="change_icon_block_image_wrapper" style="display:none;"><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" /></span>
                   <?php } ?>
                   </td>
                   <td>
                   <div class="selected_icon_block_image_wrapper" style=" display:none;"><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" />
                    </div> 
                  <a class="btn btn-primary" id="btn-app" href="#icon_select" data-toggle="modal">
                     Add App Icon
                  <?php /*?><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" /><?php */?>
                  </a>
                  </td>
                  </tr>
                  </table>
                  <!--start icon_select-->
                  <div id="icon_select" class="modal hide fade icon_select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h3 id="myModalLabel">App Icon<button type="button" class="btn btn-primary " style="margin-left:10px;" onclick="openCloseAppIcons()">Add New</button></h3>               
                      </div>
                      <!--start modal-body-->
                       <div class="modal-body">
                            <!--start icon_container-->
                            <div class="icon_container"> 
                               <ul class="custom_icon_tabs" id="myTab">
                            
                                  <li class="active"><a data-toggle="tab" href="#my_icons">My Icons</a></li>
                                  <li><a data-toggle="tab" href="#video_gallery">Video Gallery</a></li>
                                  <li><a data-toggle="tab" href="#image_gallery">Image Gallery</a></li>
                                  <li><a data-toggle="tab" href="#location_">Location</a></li>
                                  <li><a data-toggle="tab" href="#static_page">Static Page/Multi Page</a></li>
                                  <li><a data-toggle="tab" href="#rss_feeds_">RSS Feeds</a></li>
                                  <li><a data-toggle="tab" href="#optin_form">Optin Form</a></li>
                            
                                </ul>
                                <div class="clearfix"></div>
                                <!--start tab-content-->
                                <div class="tab-content" id="myTabContent"> 
                                       <!-- My icons starts here -->
                                <div id="my_icons" class="tab-pane fade in active">
                                 
                                 <?php 
								 //var_dump($dataProvider);
								$directory =  Yii::getPathOfAlias('webroot').'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/app_icon/';
								$images_count = count(glob($directory ."*.png"));
								if($images_count != 0)
								{
									$count = $images_count;	
								} else
								{
									$count = 0; 	
								}
								if($count == 0)
								{
								 echo "No Icon Uploaded Yet!";	
								}
								else{
								$app_icons = glob($directory ."*.png");
								?>  
								  <ul class="colored_icon icon_layout" id="medialistIconUpload">
                                  <?php $j=0;  foreach($app_icons as $icons){ 
									        $a = explode("/",$icons);
											$b = end($a);
								  ?>
                                  <!--class="appicon"-->
  <li  onclick="liUpdateSelectIconMedia(this);"  id="my_icon<?php echo $j; ?>" >
        <img  id="appicon1" class="my_icon<?php echo $j; ?>" src="mediafiles/<?php echo Yii::app()->user->getState('username').'_'.Yii::app()->user->id; ?>/app_icon/<?php echo $b; ?>" />
                <div class="select_feature">
					<?php echo CHtml::image('images/select_feature.png')?>
				</div>
                <input   type="checkbox"  value="<?php //echo $data->id ?>"  name="selected_icon" style="display:none"  id="checkicon" />
  </li>
                                  <?php $j++; } ?>
                                  </ul>
                                  <?php } ?>
                                </div>
                            <!-- My icons ends here --> 
                            
                            <!-- Static page Starts here -->
                            <div id="static_page" class="tab-pane fade">
                            <!-- White icons -->
                            <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/static_multi/white/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?>
                                <ul class="white_icon icon_layout" id="medialistIconUpload">
                                  <?php  for ($i = 1; $i <= $count; $i++) { ?>
                                  <li  onclick="liUpdateSelectIconMedia(this);" id="page_white_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="page_white_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/static_multi/white/<?php echo $i; ?>.png" />
                                   <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div>
                                 </li>
                                  <?php } ?>
                                
                              </ul>
                              <!-- Colored Icons -->
                             <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/static_multi/colored/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?>  
                              <ul class="colored_icon icon_layout" id="medialistIconUpload">
                                  <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="page_colored_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="page_colored_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/static_multi/colored/<?php echo $i; ?>.png" /> 
                                  <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>
                                  <?php } ?>
                              </ul>
                              <!-- black icon -->
                               <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/static_multi/black/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?>  
                              <ul class="black_icon icon_layout" id="medialistIconUpload">
                                <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="page_black_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="page_black_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/static_multi/black/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                 <?php } ?>
                              </ul>
                            
                             </div>
                            <!-- Static page ends here --> 
                            <!-- Video Gallery starts here -->
                            <div id="video_gallery" class="tab-pane fade"> 
                            <!-- White icons -->
                             <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/video/white/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?>  
                                  <ul class="white_icon icon_layout" id="medialistIconUpload">
                                   <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);"  id="video_white_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="video_white_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/video/white/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                 <?php } ?>
                               
                              </ul>
                              <!-- Colored Icons -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/video/colored/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="colored_icon icon_layout" id="medialistIconUpload">
                                <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="video_colored_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="video_colored_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/video/colored/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                              </ul>
                              <!-- black icon -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/video/black/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="black_icon icon_layout" id="medialistIconUpload">
                                <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="video_black_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="video_black_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/video/black/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                              </ul>
                            
                             </div>
                            <!-- Video gallery ends here --> 
                            
                            <!-- Image Gallery starts here -->
                            <div id="image_gallery" class="tab-pane fade"> 
                            
                            <!-- White icons -->
                             <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/image_gallery/white/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                                  <ul class="white_icon icon_layout" id="medialistIconUpload">
                                  <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="img_white_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="img_white_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/image_gallery/white/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                   <?php } ?>
                                
                              </ul>
                              <!-- Colored Icons -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/image_gallery/colored/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="colored_icon icon_layout" id="medialistIconUpload">
                                <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="img_colored_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="img_colored_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/image_gallery/colored/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                               
                              </ul>
                              <!-- black icon -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/image_gallery/black/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="black_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="img_black_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="img_black_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/image_gallery/black/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                               <?php } ?>
                               
                              </ul>
                             </div>
                            
                            <!-- Image Gallery Ends here --> 
                            <!-- location starts here -->
                            <div id="location_" class="tab-pane fade"> 
                            <!-- White icons -->
                            <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/location/white/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                                  <ul class="white_icon icon_layout" id="medialistIconUpload">
                                  <?php for ($i = 1; $i <= $count; $i++) { ?> 
                                <li onclick="liUpdateSelectIconMedia(this);" id="loc_white_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="loc_white_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/location/white/<?php echo $i; ?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                                
                              </ul>
                              <!-- Colored Icons -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/location/colored/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="colored_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="loc_colored_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="loc_colored_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/location/colored/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                              </ul>
                              <!-- black icon -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/location/black/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="black_icon icon_layout" id="medialistIconUpload">
                               <?php for ($i = 1; $i <= $count; $i++) { ?>
                                <li onclick="liUpdateSelectIconMedia(this);" id="loc_black_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="loc_black_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/location/black/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                               
                              </ul> 
                              </div>
                            
                            <!-- location ends here --> 
                            <!-- Rss Feeds starts here -->
                            <div id="rss_feeds_" class="tab-pane fade"> 
                            
                            <!-- White icons -->
                            <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/rss_feeds/white/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="white_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>    
                                <li onclick="liUpdateSelectIconMedia(this);"id="rss_white_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="rss_white_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/rss_feeds/white/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                               <?php } ?>
                              </ul>
                              <!-- Colored Icons -->
                               <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/rss_feeds/colored/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="colored_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>   
                                <li onclick="liUpdateSelectIconMedia(this);" id="rss_colored_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="rss_colored_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/rss_feeds/colored/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                               <?php } ?>
                              </ul>
                              <!-- black icon -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/rss_feeds/black/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="black_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>   
                                <li onclick="liUpdateSelectIconMedia(this);" id="rss_black_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="rss_black_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/rss_feeds/black/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                               <?php } ?>
                              </ul> 
                            
                            </div>
                            
                            <!-- Rss Feeds ends here --> 
                            <!-- Optin form starts here -->
                            <div id="optin_form" class="tab-pane fade"> 
                            
                             <!-- White icons -->
                              <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/optin_form/white/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                               <ul class="white_icon icon_layout" id="medialistIconUpload">
                                <?php for ($i = 1; $i <= $count; $i++) { ?>      
                                <li onclick="liUpdateSelectIconMedia(this);" id="form_white_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="form_white_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/optin_form/white/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                                <?php } ?>
                               
                              </ul>
                              <!-- Colored Icons -->
                               <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/optin_form/colored/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="colored_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>  
                                <li onclick="liUpdateSelectIconMedia(this);" id="form_color_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="form_color_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/optin_form/colored/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                              <?php }?>
                              </ul>
                              <!-- black icon -->
                               <?php
							$directory = Yii::getPathOfAlias('webroot').'/images/optin_form/black/';
							$images_count = count(glob($directory ."*.png"));
							if($images_count != 0)
							{
							    $count = $images_count;	
							} else
							{
							    $count = 0; 	
							}
							?> 
                              <ul class="black_icon icon_layout" id="medialistIconUpload">
                              <?php for ($i = 1; $i <= $count; $i++) { ?>  
                                <li onclick="liUpdateSelectIconMedia(this);" id="form_black_icon<?php echo $i; ?>" class="appicon"><img  id="appicon1" class="form_black_icon<?php echo $i; ?>" src="<?php Yii::getPathOfAlias('webroot'); ?>images/optin_form/black/<?php echo $i;?>.png" />                                 <div class="select_feature">
					                <?php echo CHtml::image('images/select_feature.png')?>
				                   </div></li>                         
                               <?php } ?>
                              </ul> 
                            
                             </div>
                             <!-- Optin form ends here -->
                                </div>
                                <!--end tab-content-->
                            </div>
                             <!--end icon_container-->
                        </div>    
                       <!--end modal-body--> 
                       <!--start model-footer-->
                         <div class="modal-footer">
                        <button type="button" class="btn btn-success "  onclick="setAppIcons()">Done</button>
                         </div>
                        <!--end model-footer--> 
                  </div>    
                  <!--start icon_select-->
                  
                  
             </span>
  <?php echo $this->renderPartial('_modaliconnameupload',array('module_id'=>$module_id,'layout'=>1));?>           
<script>

    $(document).ready(function() {
      
        if ($('input[name="Module[tab_icon]"]').val() != '')
		   {
            $('.change_icon_block_image_wrapper img').attr('src', $('input[name="Module[tab_icon]"]').val());
            $('.current_icon_block_image_wrapper img').attr('src', $('input[name="Module[tab_icon]"]').val());
			
			    var current_icn =  $('img[id="current_icon"]').attr('src');

			    $('.icon_layout img').each(function() {
				if($(this).attr('src') == current_icn)
				{
					var cls = $(this).attr('class');
					$("#"+cls).addClass('enabled');
				}
			    });
				
		   }
    });

   function setAppIcons()
   {
			var icon_url =  $('.selected_icon_block_image_wrapper img').attr('src');
			var array_path  = icon_url.split("/");
			var icon_name   = array_path[3];
			//alert(icon_url);
			$('.change_icon_block_image_wrapper').css("display","block");
			$('#btn-app').text("Modify App Icon");
			$('.change_icon_block_image_wrapper img').attr('src', icon_url);
			$('input[name="Application[icon]"]').val(icon_url);
			//$('input[name="Module[tab_icon]"]').val(icon_url);
		    $('#icon_select').modal('hide');
   }
	
   function openCloseAppIcons()
{ 
	 jQuery('#icon_select').modal('hide');
	 jQuery('.modal-backdrop').remove();
	jQuery('#myModalAppIconName').removeData("modal");
	jQuery('#myModalAppIconName').modal({remote: "<?php echo CHtml::normalizeUrl(array('mediafiles/uploadicon',$module_id,'layout'=>1,'app_icon_new'=>1))?>"});
}
function liUpdateSelectIconMedia(arg)
	{
       
		if($(arg).hasClass('enabled'))
		{	
			$(arg).removeClass('enabled');
			//$(arg).find('#checkicon').prop('checked', false);
		    $(arg).find('#checkmedia').attr("checked",false);
			jQuery('#medialistIconUpload li input[type="checkbox"]').attr('checked', false);
			//$('.current_icon_block_image_wrapper img').attr('src', $('input[name="Module[tab_icon]"]').val());
			$('.selected_icon_block_image_wrapper img').attr('src', $('.current_icon_block_image_wrapper img').attr('src'));
		}else{
			jQuery('#medialistIconUpload li').removeClass('enabled');
			jQuery('#medialistIconUpload li input[type="checkbox"]').attr('checked', false);
			$(arg).addClass('enabled');
			$(arg).find('#checkicon').attr("checked",true);
		    $('.selected_icon_block_image_wrapper img').attr('src', $(arg).find('#appicon1').attr('src'));
		}
	}
</script>             
