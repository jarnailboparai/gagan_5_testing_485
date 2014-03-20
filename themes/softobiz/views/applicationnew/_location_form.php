<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>
<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/softobiz/css/customize_module_details.css">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/jquery.mousewheel.js"></script>
<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>

<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
      .address_map{
      	position:relative;
      }
       #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
      
    </style>

<script>

var myLatlng ;
var geocoder;
var map;
var marker;




// To add the marker to the map, call setMap();
//marker.setMap(map);
function initialize() {
	myLatlng = new google.maps.LatLng(30.7046486,76.71787259999996);
	geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(30.7046486,76.71787259999996);
  var mapOptions = {
    zoom: 10,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  marker = new google.maps.Marker({
	    position: latlng,
	    title:"Hello World!",
	   
	});

  marker.setMap(map);
  marker.setDraggable(true);

  google.maps.event.addListener(marker,'drag',function(event) {
	    document.getElementById('lat').value = event.latLng.lat();
	    document.getElementById('lng').value = event.latLng.lng();
	});

	google.maps.event.addListener(marker,'dragend',function(event) {
	    document.getElementById('lat').value = event.latLng.lat();
	    document.getElementById('lng').value = event.latLng.lng();
			getLo(event.latLng);
	});

	var address = '<?php echo $model->description; ?>';
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      //  console.log(results[0].geometry.location);
	      map.setCenter(results[0].geometry.location);

	      marker.setMap(map);
	      marker.setDraggable(true);
	      marker.setPosition(results[0].geometry.location);
	      
//	      var marker = new google.maps.Marker({
//	          map: map,
//	          position: results[0].geometry.location,
	         // draggable:true,
	          
//	     });

	      console.log(marker); 


	      
	    } else {
	      //alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
}



function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      //  console.log(results[0].geometry.location);
      map.setCenter(results[0].geometry.location);

      marker.setMap(map);
      marker.setDraggable(true);
      marker.setPosition(results[0].geometry.location);
      
//      var marker = new google.maps.Marker({
//          map: map,
//          position: results[0].geometry.location,
         // draggable:true,
          
//     });

      console.log(marker); 


      
    } else {
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

//google.maps.event.addDomListener(window, 'load', initialize);
//google.maps.event.addDomListener(window, 'load', codeAddress); 

function getLo(arg){
    geocoder.geocode( { 'location': arg}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
         console.log(results[0].formatted_address);
         jQuery('#address').val(results[0].formatted_address);
         
        } else {
          //alert('Geocode was not successful for the following reason: ' + status);
        }
      });
} 

/*
function initialize() {
	  var mapOptions = {
	    zoom: 8,
	    center: new google.maps.LatLng(-34.397, 150.644)
	  };

	  var map = new google.maps.Map(document.getElementById('map-canvas'),
	      mapOptions);
	}
*/
	function loadScript() {
	  var script = document.createElement('script');
	  script.type = 'text/javascript';
	  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.expkey=AIzaSyBI4_1EiCrW3c3pzqq5fLLMQkD0EwwD9pc&sensor=false&' +
	      'callback=initialize';
	  document.body.appendChild(script);
	}

	window.onload = loadScript;

	setTimeout(loadScript,3000);

    
</script>
      
<script>

jQuery(document).ready(function(){
	
	jQuery('#module-form-photo').on('submit',function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form-photo');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = JSON.parse(response);
	        	popdetialHideOther(arg);
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});

	//google.maps.event.addDomListener(window, 'load', initialize);
	//google.maps.event.addDomListener(window, 'load', codeAddress); 
	
});

</script>



<!--  Html content for image gallery starts here -->
<div class="row-fluid manage_apps media_gallery tab_gallery location_form">
     <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form-photo',
        	//'action'=> 'index.php?r=applicationnew/customize_modules_details',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	//'onsubmit' => 'return customizemodulenew();'
            ),
        ));
		
        //echo $model->name;
		//echo "<pre>";print_r($model); die;
        $title = '';
        $module_info = ModuleFile::model()->findByAttributes(array('name' => $model->name));
       	if(count($module_info)){
        if ($model->tab_title == NULL)
            $title = $module_info->title;
        else
            $title = $model->tab_title;
       	}
        if ($title == '')
            $title = $model->name;
        //echo "<pre>";print_r($module_info); die;
        $photos_arrsub = array('photosub');
        $location = array('location');
        ?>
        <div class="title_panel">
        
         <div class="control-group" >


                    <?php
                    if ($model->description != NULL)
                        $description = $model->description;
                    else
                        $description = '';
                    ?>
                    <?php
                    if ($model->articles != NULL)
                        $article = $model->articles;
                    else
                        $article = '';
                    ?>
                    <?php
                    if ($model->images != NULL)
                        $images = $model->images;
                    else
                        $images = '';
                    ?>


                  <!--   <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>  -->
                    <textarea style="display: none" name="upload_url" ><?= $images; ?></textarea>
                </div>
 
<!-- 		   <input type="text" placeholder="Title"> -->
		    <?php echo $form->textField($model, 'tab_title', array('placeholder' => 'Title', 'value' => $title)); ?>
		    <?php echo $form->hiddenField($model, 'tab_icon'); ?>
		     <span class="icon_wrapper">
<!--                   <div title="Select Icon" class="select_icon"></div> -->
                  
                  <span class="select_icon change_icon_block_image_wrapper image">

                                <img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" />

                  </span>
                  
                  <div class="change_icon_block_popup">

                                <em>X</em>

                                <ul class="change_icon_block_tabs">

                                    <li class="grey_icons active">Grey Icons</li>

                                    <!--<li class="black_icons">Black Icons</li>-->

                                    <li class="white_icons">White Icons</li>

                                </ul>

                                <ul class="change_icon_block_tabs_content">

                                    <li id="grey_icons" class="current_tab_content">

                                        <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" /></span>

                                        <?php for ($i = 1; $i <= 400; $i++) { ?>

                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/grey/icon(<?= $i; ?>).png" /></span>


                                        <?php } ?>

                                    </li>

                                    <li id="white_icons">

                                        <?php for ($i = 1; $i <= 400; $i++) { ?>

                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/white/icon(<?= $i; ?>).png" /></span>

                                        <?php } ?>

                                    </li>

                                </ul>

                            </div>
                  
                  
                  
             </span>
             
            
              <div class="clearfix"></div>
              </div>
              <div class="address_map">
<!--              		<textarea name="" cols="" rows="" placeholder="Enter Address"></textarea> -->
             		 <input placeholder="Address" id="address" type="textbox"  name="Module[description]"  value="<?= $description; ?>" > 
             		 <br>
             		 <input type="button" class="btn btn-danger" value="Geocode" onclick="codeAddress()">
             		 <br>
             		
				<div style="display: none">
             		Lat: <input type="text" id="lat"><br>
					Lng: <input type="text" id="lng"><br>
				</div>
<!--    		    <div id="panel"></div> -->
             		
<div id="map-canvas" style="float:left; height:400px;width: 99.4%;margin: 14px 2px;border:1px solid #ddd;"></div>
<textarea placeholder="Description" id="article" type="text"  name="Module[articles]"  value="<?= $article; ?>" ></textarea>
              </div>
              
                  <div class="button_panel">
                  
                <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-success')); ?>

                <?php echo CHtml::button('Cancel', array('class' => 'btn cancel_singlepage')); ?>
                  
<!--                 <input type="button" value="Save" class="btn btn-success" name=""> -->
<!--                 <input type="button" value="Cancel" class="btn cancel_singlepage" name=""> -->
              </div>
                 <?php $this->endWidget(); ?>
                
                </div>

<!--  HTML content for image gallery ends here -->

<?php
if (substr($model->name, 0, 7) == 'content')
    $model_name = 'content';
else
    $model_name = $model->name;
?>
<script>

    $(document).ready(function() {
        var ifOb;
/*        $('#Module_tab_title').keyup(function() {
            ifOb = $('#myframe').contents();
            ifOb.find('h1').html($('#Module_tab_title').val());
            ifOb.find('.ui-btn-text').html($('#Module_tab_title').val());
        });
*/        $('#showMobile').click(function() {
            if ($('#customizePreview').css('display') == 'none')
                $('#customizePreview').slideDown('slow');
        });
        if ($('input[name="Module[tab_icon]"]').val() != '')
            $('.change_icon_block_image_wrapper img').attr('src', $('input[name="Module[tab_icon]"]').val());

        $('.change_icon_block_tabs li').click(function() {
            if (!$(this).hasClass('active')) {
                var current = $(this).attr('class');
                $('.change_icon_block_tabs li').removeClass('active');
                $(this).addClass('active');
                $('.change_icon_block_tabs_content li').removeClass('current_tab_content');
                $('#' + current).addClass('current_tab_content');
            }
        });

        
        $('.change_icon_block_image_wrapper.image').on('click',function() {
//            alert('asdf');  
          $('.change_icon_block_popup').fadeIn();

       });


       $('.change_icon_block_popup em').click(function() {
            $('.change_icon_block_popup').fadeOut();
        });



        
       /*    $(document).click(function(e) {
            if ($(e.target).parents().filter('.change_icon_block').length == 0) {
                $('.change_icon_block_popup').fadeOut();
            }
        });
 */

        
        $('.change_icon_block_tabs_content img').click(function() {
            $('.change_icon_block_image_wrapper img').attr('src', $(this).attr('src'));
            $('.change_icon_block_popup').fadeOut();
            $('input[name="Module[tab_icon]"]').val($(this).attr('src'));
            //var iframeObj = $('#myframe').contents();
            //iframeObj.find('#tab2 .ui-icon').css('background', 'url("../../' + $('.change_icon_block_image_wrapper img').attr('src') + '")  50% 50% no-repeat');
        });
        /********Iframe-begin********/

    });

   // google.maps.event.trigger(map, "resize");

</script>
