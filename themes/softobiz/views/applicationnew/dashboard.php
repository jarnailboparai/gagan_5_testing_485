<?php //print_r($user->appioskey); 
$flagforios = false;

	
$url =  Yii::app()->getBaseUrl(true); 
//echo count($slider);
?>

           <!-- Manage app container -->
           <div class="clearance_div">
<?php
if(count($model) > 0  ){
	if(count($user->appioskey) > 0 ){
		//echo "ios app certificate uploaded ";
		//echo CHtml::link("View profile ios",array('appleprofile/view','id'=>$user->appioskey->id));
		$flagforios = true;
		?>
			<div class="pull-right alert alert-success"><strong>View Apple Certificate </strong> <a href="<?php echo CHtml::normalizeUrl(array('appleprofile/view','id'=>$user->appioskey->id)); ?>">Click Here </a></div>
		
		<?php 
		
	}else{
		//echo "please upload the  ";
		//echo CHtml::link("add profile ios",array('appleprofile/create',));
		//CHtml::normalizeUrl(array('appleprofile/create'))
		?>
					<div class="pull-right alert alert-danger"><strong>No Apple Certificate Uploaded</strong>. Certificates are required in order to Create the IOS APP - <a href="<?php echo CHtml::normalizeUrl(array('appleprofile/create')); ?>"><strong>Click Here to Upload</strong></a></div>
				
	   <?php } } ?>
            
            <div class="app_number pull-left"><span>Business Apps</span><span class="number">(<?php echo count($model); ?>)</span></div>
            <div class="clearfix"></div>
            </div>
            <div class="row-fluid manage_apps set_tabs manage_app_icon">
            <?php         if(count($model) == 0 )  
				{
					//$this->redirect(array("applicationnew/details",'type'=>'new','app'=>'localBusiness'));
					echo '<div class=" alert alert-success"><strong>Are you ready to create your first app ';
					echo CHtml::link("click to create",array("applicationnew/details",'type'=>'new','app'=>'localBusiness')); 
					echo '</div>';
				}else{
			?>
            <ul>
            <?php // http://localhost:8010/members/wizard/index.php?r=applicationnew/details&type=new&app=localBusiness

                $i = 0;
                foreach ($model as $obj){
                    $m = $obj['attributes'];
                  //echo "<pre>"; print_r($obj->userss->appioskey); die;
                    ?>
           
            <li class="span3">
            <div class="app_box">
            <div class="app_thumb">
            <div class="edit_panel">
           <span><img src="<?= $url ?>/images/edit_icon.png" /></span><label><a href="<?php echo Yii::app()->createUrl('/applicationnew/finalPreview', array('app_id' => $m['id'])); ?>" >Edit</a></label>
           <span><img src="<?= $url ?>/images/preview_icon.png" /></span><label><a href="<?php echo Yii::app()->createUrl('/applicationnew/finalPreview', array('app_id' => $m['id'])); ?>" >Preview</a></label> 
           <span><img src="<?= $url ?>/images/delete_icon.png" /></span><label><a href="javascript:void(0);" onclick="delete_app('<?php echo Yii::app()->createUrl('/applicationnew/delete', array('app_id' => $m['id'])); ?>');">Delete</a></label>
            </div>
            <?php /*  code comment by sob_k?>
            <img src="<?= $url ?>/images/app_thumb.jpg" alt="app thumb" />
            <? */ ?>
           <?php /*?> <?php $path = (!empty($m['icon'])) ? $url."/app_images/".$m['icon'] : $url."/images/app_thumb.jpg" ?><?php */?> 
            <?php $icon_path = explode("/",$m['icon']);
			      
			 ?>
            <?php 
			      if(count($icon_path) > 1) {
			 $path = (!empty($m['icon'])) ? $url."/".$m['icon'] : $url."/images/app_thumb.jpg" ;
				  } 
				  else
				  {
			 $path = (!empty($m['icon'])) ? $url."/app_images/".$m['icon'] : $url."/images/app_thumb.jpg";		  
				   }
			 ?>
            <img src="<?= $path ?>" alt="app thumb" />
            </div>
            <div class="app_title">
          <div class="pull-left limited_title"> <?php echo $m['title']; ?></div>
          <?php if(count($obj->applinkdata) > 0 && $obj->applinkdata->attributes['android'] == null  && $obj->applinkdata->attributes['ios'] == null ){ ?>
          <div class="links_prog pull-right">Inprogress<br/><a href="<?php echo CHtml::normalizeUrl(array('tutorial/buildapp','id'=>$m['id']));?>">Refresh</a></div>
           <?php }elseif(count($obj->applinkdata) == 0){?>
           	<div class="links_prog pull-right">Inprogress<br/><a class='generateappnew' href="<?php echo CHtml::normalizeUrl(array('tutorial/buildapp','id'=>$m['id']));?>">Refresh</a></div>
           <?php } ?>
           <?php  if(count($obj->applinkdata) > 0 && $obj->applinkdata->attributes['ios'] == null  ){  ?>
            	 <div class="links_prog pull-right"><a href="<?php echo CHtml::normalizeUrl(array('tutorial/buildapp','id'=>$m['id']));?>">Build Ios</a></div>
          	<?php }elseif(count($obj->applinkdata) > 0 && $obj->applinkdata->attributes['android'] == null){ ?>
            	 <div class="links_prog pull-right"><a href="<?php echo CHtml::normalizeUrl(array('tutorial/buildapp','id'=>$m['id']));?>">Build Android</a></div>
            <?php } ?>
            <div class="clearfix"></div>
            </div>
            <div class="date">November 06 2013</div>
            
           
            <div class="bottom_icons">
            <?php ?>
            	<div class="app_icon">
            		
            		<?php if(count($obj->applinkdata) > 0 ){   //echo "<pre>"; print_r($obj->applinkdata->attributes); //die; ?>
            		 		<?php /* ?>
            		 		<a href="<?php echo $obj->applinkdata->attributes['android']; ?>">
            		 			<img src="<?= $url ?>/images/app_store_icon.png" alt="playstore icon" class="active_app">
            		 		</a>
            		 		<?php */?>
            		 		
            		 		 <?php if($obj->applinkdata->attributes['android'] != null ){ ?>
            		 		<a href="<?php echo $obj->applinkdata->attributes['android']; ?>">
            		 			<img src="<?= $url ?>/images/app_store_icon.png" alt="playstore icon" class="active_app">
            		 		</a>
            		 		<?php }else{ ?>
							<a href="javascript:vpod(0)">
            		 			<img src="<?= $url ?>/images/app_store_icon.png" alt="playstore icon" >
            		 		</a>
            		 		<?php 
            		 		 // echo CHtml::link('<img src="'.Yii::app()->theme->baseUrl.'/img/apple_icon.png" alt="rebuilt app" style="margin-top:10px;">',
            				//			array('appleprofile/buildPhoneGapAppMy','id'=>$m['id'])); ?>
            							
                           <?php }?>
            		 		
            		 		
            		<?php }else{?>
            		 		<img src="<?= $url ?>/images/app_store_icon.png" alt="playstore icon" >
            		<?php } ?>
           	 	</div>
            <div class="app_icon">
            		<?php if(count($obj->applinkdata) > 0 ){   //echo "<pre>"; print_r($obj->applinkdata->attributes); //die; ?>
            		 		
            		 		<?php if($obj->applinkdata->attributes['ios'] != null ){ ?>
            		 		<a href="<?php echo $obj->applinkdata->attributes['ios']; ?>">
            		 			<img src="<?= $url ?>/images/apple_icon.png" alt="playstore icon" class="active_app">
            		 		</a>
            		 		<?php }else{ ?>
							<a href="javascript:vpod(0)">
            		 			<img src="<?= $url ?>/images/apple_icon.png" alt="playstore icon" >
            		 		</a>
            		 		<?php 
            		 		 // echo CHtml::link('<img src="'.Yii::app()->theme->baseUrl.'/img/apple_icon.png" alt="rebuilt app" style="margin-top:10px;">',
            				//			array('appleprofile/buildPhoneGapAppMy','id'=>$m['id'])); ?>
            							
                           <?php }?>
                            
            		<?php }else{?>
            		 		<img src="<?= $url ?>/images/apple_icon.png" alt="playstore icon" >
            		<?php } ?>
           
            </div>
            
            <!-- No of leads -->
            <div class="app_icon leads_no">
            	<?php  $count = Lead::model()->lead_count($m['id']); ?>            		 		
           		<?php if($count)
           		{ ?>
           		<a href="<?php echo Yii::app()->createUrl('/tutorial/export', array('app_id' => $m['id'])); ?>" title="Leads">
            	<?php echo $count; ?>
            	</a><i>Leads</i>
            	<?php } else {?>
            	<span title="Leads"><?php echo $count; ?></span>
            	<i>Leads</i>
				<?php  } ?>	
                          
            </div>
            
            <!-- No of Leads ends -->
            <?php /*  if(count($obj->applinkdata) > 0 && $obj->applinkdata->attributes['ios'] == null  ){  ?>
            	<a href="<?php echo CHtml::normalizeUrl(array('tutorial/buildapp','id'=>$m['id'])); ?>" class="pull-right build_ios btn btn-primary generateappnew">Build IOS APP</a>
            <?php }elseif(count($obj->applinkdata) > 0 && $obj->applinkdata->attributes['android'] == null){ ?>
            	<a href="<?php echo CHtml::normalizeUrl(array('tutorial/buildapp','id'=>$m['id'])); ?>" class="pull-right build_ios btn btn-primary generateappnew">Build APK APP</a>
            <?php } */ ?>
            <div class="app_icon pull-right rebuild" >
           
            <?php
				//http://localhost:8010/members/wizard/index.php?r=tutorial/buildapp&id=401
             echo CHtml::link('<img class="active_app" src="'.Yii::app()->theme->baseUrl.'/img/rebuilt.png" alt="rebuilt app" style="margin-top:10px;">',
            							array('tutorial/buildapp','id'=>$m['id']),
										array('class'=>'generateappnew'));
            		 		
            //echo CHtml::link('Refresh App',array('applicationnew/buildPhoneGapAppMy','id'=>$m['id'])); ?>
            </div>
            </div>
            </div>
            
            </li>
            <?php } ?>
            </ul>
            <?php } ?>
            </div>
            <!-- Manage App container ends here -->

<script type="text/javascript">
	function delete_app(del_url)
	{
    	var x = window.confirm("Are you sure you want to delete this record?");
        	if (x)
            	window.location = del_url;
	}

	function createAppApi(url)
	{
		/* $.get(baseurl+'/index?r=applicationnew/buildPhoneGapAppMy&id=471&id='+arg,function( data ) {
				console.log(data);
			}); */
		 $.get(url,function(data){ //console.log(data);
			
				 location.reload();
				 //jQuery('.loading_content').hide();
				
		  });
		
	}

	jQuery(document).ready(function(){
				jQuery('.generateappnew').click(function(event){
					jQuery('.loading_content').show();
					event.preventDefault();
					createAppApi($(this).attr('href'));

				});
		});
</script>
