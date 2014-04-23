<?php
$url =  Yii::app()->getBaseUrl(true); 
//echo count($slider);
?>
<?php //echo $this->renderPartial('/applicationnew/_navbottom',array('data'=>array('tabselect'=>'select_look'))); ?>

<link href="<?= $url ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?= $url ?>/js/jcarouse.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"  src="<?= $url ?>/js/jcarousellite_1.0.1.js"></script>
<script>
		var serverUrl= "<?php echo $url; ?>";
		var sliderMenus = <?php echo json_encode($adata); ?>;
		var countTheme =  <?php echo count($slider); ?>; 
		var themeId =<?php echo $app_model->thememenu->theme_id; ?>;  
		var menuId = <?php echo $app_model->thememenu->id; ?>; 

		
		function menuShowFirst(slider)
		{
			for( var key in slider )
			{
				jQuery(".choose_layout ul li#menu_"+slider[key]['type']).show(); 
				jQuery(".choose_layout ul li#menu_"+slider[key]['type']).attr({'onclick':'shoeImage('+JSON.stringify(slider[key])+','+themeId+')'});
			}
		}
		
		  $('document').ready(function(){

			var start_point = "";
			if(themeId==2)
			{
				start_point = 4;
			}
			if(themeId==3)
			{
				start_point = 0;
			}
			if(themeId==4)
			{
				start_point = 1;
			}
			if(themeId==5)
			{
				start_point = 2;
			}
			if(themeId==6)
			{
				start_point = 3;
			}
			


			  $(".jCarouselLite").jCarouselLite({
				        btnNext: "#next",
				        btnPrev: "#prev",
				        speed: 1000,
						start:start_point,
				        sliderMenus: sliderMenus,
				        beforeStart: function(a) {
				        	for (first in sliderMenus[themeId]) break;
							//console.log(sliderMenus[themeId][first]);
				        	shoeImage(sliderMenus[themeId][first],themeId) 
				        	$('ul li').removeClass('enabled');
				        	$('ul li:first-child').addClass('enabled');
				        	},
				       
				   });

			  menuShowFirst(sliderMenus[themeId]);
			  formInput(sliderMenus[themeId][menuId]);
			  
			  shoeImage({"themeid":"<?php echo $app_model->thememenu->theme_id; ?>","image":"<?php echo $app_model->thememenu->image; ?>","id":"<?php echo $app_model->thememenu->id; ?>","type":"<?php echo $app_model->thememenu->type; ?>","features":"<?php echo $app_model->thememenu->features; ?>"},themeId)
			  
		});


		
		  

		</script>

<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<!--wrapper -->
<div class="fixed_top"><?php echo $this->renderPartial('/applicationnew/_custom_setting',array('id'=>$app_model->id,'data'=>array('formId'=>'user-form','tabselect'=>'select_look'))); ?>	<button onclick="submitForm();" class="btn btn-large pull-right save update_theme" type="button"><span>Update Theme</span></button></div>
<div id="wrapper"> 
  <!--container -->
  
  <section id="container">
    <div class="container slidetheme">
      <div class="slider">
        <div class="div2">
          <div id="jCarouselLiteDemo">
            <div class="carousel main"> <span id="prev"></span>
              <div class="jCarouselLite">
                <ul>
                  <?php //$w = "<li><div class='coming_soon'><img src='".Yii::app()->theme->baseUrl.'/img/coming_soon.png'."' /><div class='faded_bg'></div></div><img alt='' src='images/%s' id='%s' class='liImage_%s'></li>";
$w = "<li><img alt='' src='images/%s' id='%s' class='liImage_%s'></li>";
                    foreach($slider as $s)
                    {
                    	printf($w,$s['image'],$s['themeid'],$s['themeid']);		
                    } 
                    ?>
                </ul>
                <?php //die;?>
              </div>
              <span id="next"></span>
              <div class="clear"></div>
            </div>
          </div>
          <div> <span id="pagi"></span> </div>
        </div>
        <div id="phone-body"></div>
      </div>
    </div>
    <div class="container choosetheme">
      <div class="choose_bav"><img src="images/choose.jpg" alt=""/></div>
      <div class="choose_layout" >
        <ul id="menusli" >
        
          <li id='menu_1' class="<?php echo ($app_model->thememenu->type==1?"enabled":"menu")?>">
            <div class="select_feature"><img alt="selected features" src="<?= $url ?>/images/select_feature.png"></div>
            <a href="javascript:void(0)"><img src="images/one.png" alt=""/></a></li>
          
          <li id='menu_2' class="<?php echo ($app_model->thememenu->type==2?"enabled":"menu")?>">
            <div class="select_feature"><img alt="selected features" src="<?= $url ?>/images/select_feature.png"></div>
            <a href="javascript:void(0)"><img src="images/two.jpg" alt=""/></a></li>
         
          <li id='menu_3' class="<?php echo ($app_model->thememenu->type==3?"enabled":"menu")?>">
            <div class="select_feature"><img alt="selected features" src="<?= $url ?>/images/select_feature.png"></div>
            <a href="javascript:void(0)"><img src="images/three.jpg" alt=""/></a></li>
         
          <li id='menu_4' class="<?php echo ($app_model->thememenu->type==4?"enabled":"menu")?>">
            <div class="select_feature"><img alt="selected features" src="<?= $url ?>/images/select_feature.png"></div>
            <a href="javascript:void(0)"><img src="images/left.jpg" alt=""/></a></li>
         
          <li id='menu_5' class="<?php echo ($app_model->thememenu->type==5?"enabled":"menu")?>">
            <div class="select_feature"><img alt="selected features" src="<?= $url ?>/images/select_feature.png"></div>
            <a href="javascript:void(0)"><img src="images/right.jpg" alt=""/></a></li>
        
          <li id='menu_6' class="<?php echo ($app_model->thememenu->type==6?"enabled":"menu")?>">
            <div class="select_feature"><img alt="selected features" src="<?= $url ?>/images/select_feature.png"></div>
            <a href="javascript:void(0)"><img src="images/single.jpg" alt=""/></a></li>
        </ul>
      </div>
    </div>
  </section>
  <div style="display:none;"> <?php echo $this->renderPartial('/applicationnew/_formmenu', array('model'=>$model)); ?> </div>
  <!--container --> 
  <div class="clearfix"></div>
</div>
<!--wrapper --> 
<script type="text/javascript">
$(document).ready(function(){
	//$('#menu_')
	$('#menusli li').click(function(){ 
		$("#menusli li").removeClass('enabled');
		$(this).addClass('enabled');
		jQuery('.loading_content').show();

		setTimeout("jQuery('.loading_content').hide()",2000);
	});
});
</script>

<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>
<!-- Stick to top script -->
 <script type="text/javascript">
   // var flagloader = false;
$(document).ready(function() {
	var s = $(".fixed_top");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos >= pos.top) {
			s.addClass("stick");
		} else {
			s.removeClass("stick");	
		}
	});
});
</script>
<style type="text/css">
.stick {
	position:fixed;
	top:0px;
	z-index:1000000;
	
}
</style>
 
 <!-- Stick to top script ends here -->
