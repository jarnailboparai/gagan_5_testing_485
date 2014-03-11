<?php $url =  Yii::app()->getBaseUrl(true); 
$this->breadcrumbs=array(
	'Select Menu',
);
?>
<h1>Select Menu</h1>

<link href="<?= $url ?>/css/style.css" rel="stylesheet" type="text/css" />

<link href="<?= $url ?>/js/jcarouse.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"  src="<?= $url ?>/js/jcarousellitefeatureNew.js"></script>
<script> 
$('document').ready(function(){

	  $(".jCarouselLite").jCarouselLite({
		        btnNext: "#next",
		        btnPrev: "#prev",
		        speed: 1000,
		        circular: false,
		        visible: 5
		//        sliderMenus: sliderMenus,
		       
		   });

	//  menuShowFirst(sliderMenus[themeId]);
	//  formInput(sliderMenus[themeId][menuId]);
	  
});
</script>
  <div id="jCarouselLiteDemo">  
       <div class="carousel main">
          <span id="prev">Prev</span>
            <div class="jCarouselLite">
                <ul>
                	<?php  $i = 0; foreach($data as $key => $modulefile){ 	?>
                    <?php $str = '<li id="name_%s"><span class="features">%s</span></li>'  ?>
           			<?php printf($str,$i,$modulefile);  $i++; } //echo $modulefile->title; }  ?>                       
                </ul><?php //die;?>
            </div>
           <span id="next">Next</span>
            <div class="clear"></div>   
        </div>
 </div>
 <div class="clearBoth"></div>   
<?php echo $this->renderPartial('_formfeature', array('model'=>$model,'data'=>$data)); ?>
