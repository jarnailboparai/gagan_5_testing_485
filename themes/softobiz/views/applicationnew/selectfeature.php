<style>
.selectfeatures{ min-height: 0px; }
footer{position:fixed;bottom:0px;width:100%;}
</style>
<?php $url =  Yii::app()->getBaseUrl(true); 
$this->breadcrumbs=array(
	'Select Menu',
);
?>
<?php //echo CHtml::image('img/ribbon_left.png')?>

<?php echo $this->renderPartial('_navbottom',array('data'=>array('tabselect'=>'selected_feature123'))); ?>	
<div class="container selectfeatures padd38 " >
				<div class="row-fluid" align="center">
  				<h1 align="center">Select Features for Your Application</h1>
                 <div class="ribbon">
                 <table align="center" cellpadding="0" cellspacing="0"> 
                 	<tr>
                 		<td>
                 			<span><img src="<?= $url?>/images/ribbon_left.png"></span>
                 		</td>
                 		<td>
                 			<div class="ribbon_text">No Coding Skills Requried Just Select the Features</div>
                 		</td>
                 		<td>
                 			<span><img src="<?= $url?>/images/ribbon_right.png"></span>
                 		</td>
                  	</tr>
                  </table>
                 </div>
                </div>
</div>
            
<link href="<?= $url ?>/css/style.css" rel="stylesheet" type="text/css" />

<link href="<?= $url ?>/js/jaselecfeatures.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"  src="<?= $url ?>/js/jcarousellitefeatureNew.js"></script>
<script> 
$('document').ready(function(){

	  $(".jCarouselLite").jCarouselLite({
		        btnNext: "#next",
		        btnPrev: "#prev",
		        speed: 1000,
		        circular: false,
		        visible: 7
		//        sliderMenus: sliderMenus,
		       
		   });

	//  menuShowFirst(sliderMenus[themeId]);
	//  formInput(sliderMenus[themeId][menuId]);
	  
});
</script>
<!--   <div  class="slectfeature">   -->
   <div id="jCarouselLiteDemo" >
   
       <div class="carousel main">
          <span id="prev"></span>
            <div class="jCarouselLite">
                <ul>
                	<?php  $i = 0; foreach($data as $key => $modulefile){ 	?>
                    <?php $str = '<li id="name_%s" class="span2"><span class="features app_feature_inner"><img src="%s/images/%s.png" alt="%s"/><h5>%s</h5><div class="select_feature"><img src="%s/images/select_feature.png" alt="selected features" /></div></span><div class="upcoming_feature"></div></li>'  ?>
           			<?php printf($str,$i,$url,strtolower(str_replace(' ','_',$modulefile)),$modulefile,$modulefile,$url);  $i++; } //echo $modulefile->title; }  ?>                       
                </ul><?php //die;?>
            </div>
           <span id="next"></span>
            <div class="clear"></div>   
        </div>
 </div>
 <div class="clearBoth"></div>   
 <div style="display:none" >
<?php echo $this->renderPartial('_formfeature', array('model'=>$model,'data'=>$data)); ?>
</div>
<div class="select_feature_error"></div>
