<?php
$url =  Yii::app()->getBaseUrl(true); 
//echo count($slider);
?>

<link href="<?= $url ?>/css/style.css" rel="stylesheet" type="text/css" />

<link href="<?= $url ?>/js/jcarouse.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"  src="<?= $url ?>/js/jcarousellite_1.0.1.js"></script>
		<script>
		var serverUrl= "<?php echo $url; ?>";
		var sliderMenus = <?php echo json_encode($adata); ?>;
		var countTheme =  <?php echo count($slider); ?>; 
		var themeId = <?php echo $slider['1']['themeid']; ?>; 
		var menuId = <?php echo $slider['1']['id']; ?>; 
		function menuShowFirst(slider)
		{
			for( var key in slider )
			{
				//countTheme
				//console.log(slider[key]);
				jQuery(".choose_layout ul li#menu_"+slider[key]['type']).show(); 
				jQuery(".choose_layout ul li#menu_"+slider[key]['type']).attr({'onclick':'shoeImage('+JSON.stringify(slider[key])+','+themeId+')'});
			}
		}
		
		  $('document').ready(function(){

			  $(".jCarouselLite").jCarouselLite({
				        btnNext: "#next",
				        btnPrev: "#prev",
				        speed: 1000,
				        sliderMenus: sliderMenus,
				       
				   });

			  menuShowFirst(sliderMenus[themeId]);
			  formInput(sliderMenus[themeId][menuId]);
			  
		});


		
		  

		</script>

<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<!--wrapper -->
		
<div id="wrapper">
        <!--container -->
        
        <section id="container">
        
            <div class="slider">
            
              <div class="div2">
 
  <div id="jCarouselLiteDemo">  
       <div class="carousel main">
          <span id="prev">Prev</span>
            <div class="jCarouselLite">
                <ul>
                                      
                    <?php $w = "<li><img alt='' src='images/%s' id='%s' class='liImage_%s'></li>";  
                    foreach($slider as $s)
                    {
                    	printf($w,$s['image'],$s['themeid'],$s['themeid']);		
                    } 
                    ?>
                  
                </ul><?php //die;?>
            </div>
           <span id="next">Next</span>
            <div class="clear"></div>   
        </div>
 </div>
 
        <div>
        	
        	<span id="pagi"></span>
        </div>
    </div>
            <div id="phone-body"></div>
            
            </div>
            
            <div class="choose_bav"><img src="images/choose.jpg" alt=""/></div>
            <div class="choose_layout" >
            <ul id="menusli" >
              <li id='menu_1'><a href="javascript:void(0)"><img src="images/one.png" alt=""/></a></li>
              <li id='menu_2'><a href="javascript:void(0)"><img src="images/two.jpg" alt=""/></a></li>
              <li id='menu_3'><a href="javascript:void(0)"><img src="images/three.jpg" alt=""/></a></li>
              <li id='menu_4'><a href="javascript:void(0)"><img src="images/left.jpg" alt=""/></a></li>
              <li id='menu_5'><a href="javascript:void(0)"><img src="images/right.jpg" alt=""/></a></li>
              <li id='menu_6'><a href="javascript:void(0)"><img src="images/single.jpg" alt=""/></a></li>
            </ul>
            </div>
           
        </section>
        <div> 
        	<?php echo $this->renderPartial('_formmenu', array('model'=>$model)); ?>	
        </div>	
        <!--container -->
        
        <!--footer-->
        <footer id="footer" class="home">
               
        </footer>
        <!--footer-->
        
        
        </div>
        <!--wrapper -->


<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>
