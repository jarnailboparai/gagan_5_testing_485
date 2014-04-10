<?php $url =  Yii::app()->getBaseUrl(true); 
$pathurl = Yii::app()->theme->baseUrl;
?>
<script type="text/javascript"  src="<?= $url ?>/js/nicEdit-latest.js"></script>
<script>
	window.TabFlagOpen = 0;
	window.staticFlag = 0;
	window.IframeUrlSrc = "<?php echo $url.'/applications/'.Yii::app()->user->getState('username') . "_" . $application_model->title . "_" . $application_model->id.'/index.html' ?>";
</script>
<script>
	bgapp_type = "";
	bgapp_appid = ""
	bgapp_moduleid ="";
	bgapp_submoduleid="";
</script>
<?php
//$this->renderPartial("app_menu", array('style' => $style));
?>
<style>
.row {
	display:block !important;
	margin:0px;
}

.body_rightModal .form-actions {
	/*display:none !important;*/
}
.body_rightModal .form-actions a {
	/*display:none !important;*/
}

.body_rightModal #showMobile {
	/*display:none;*/
}
.pull-right.edit_icon span:nth-child(3),.sub_page_wrapper .pull-right.edit_icon span:nth-child(2){
	display: none;
}
.sub_page_wrapper .pull-right.edit_icon span:nth-child(3){
	display: inline-block;
}
.row-fluid.manage_apps.media_gallery.tab_gallery
{
	display:none;
}

</style>
<?php $this->renderPartial('_orderlist');?>

<!-- Container -->

<div class="container selectfeatures">
          <div class="row-fluid select_content">
          <div class="span8">
         
          <!-- Content Listing starts here -->
          
          <div class="app_number">Add Features into <span class="number">Your App</span> - <span class="number"><?php echo $application_model->title; ?></span>   </div>
           
          <div class="content_listing" id="content_listing">
          
          <!-- Main Theme Setting Starts here -->
<div class="main_page_theme_setting">
<?php $this->renderPartial('app_bg',array('model'=>$application_model,'flag'=>1));

?>
</div>
<!-- Main theme setting ends here -->
          
          <!--  listing wrapper starts here -->
          
          
         	<!--  Crousel Starts Here -->
         	
         	<!-- Add feature wrapper starts here -->
            
        <!--  <div class="add_feature_wrapper">  -->
        <div class="sub_list_wrapper">
          <a href="#" class="add_features main_listing selected_tab">Add Features</a>
          <?php echo $this->renderPartial('_carsoulwrap',array('pathurl'=>$pathurl ,'model'=>$modelSelectAA,'data'=>$dataSelectAA,'url'=>$url));?>
          
         	<!--  Crousel ends here -->
            <div class="featurelist">
	<ul id="sortable">
		<?php 
		$li = "<li  id='module_%s' ><div class='wrapperli'><a class='tab_title' href='%s' id='%s' ><span class='content_list_icon'><img src='%s/img/%s.png'></span>%s</a><div class='pull-right edit_icon'><span class='drag'><img src='%s/img/drag.png' alt='drag'></span><span onclick='javascript:popupdetial(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='popdetialHide(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeModule(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div></div></li>"; 
		$liid = "<li  id='module_%s' ><div class='wrapperli'><a href='%s' id='%s' ><span class='content_list_icon' ><img src='%s/img/%s.png'></span>%s</a><div class='pull-right edit_icon'><span class='drag'><img src='%s/img/drag.png' alt='drag'></span><span id='staticPageFormButton_%s'   onclick='javascript:popupdetial(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='javascript:popupdetial(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeModule(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div></div> </li>";
		foreach($model as $fea)
		{
			if ($fea->tab_title == NULL)
				$title = $fea->name;
			else
				$title = $fea->tab_title;
			
			if ($title == '')
				$title = $fea->name;
			
			//$pos = strpos($fea->name, 'content');
			
			if($fea->articles == null || $fea->articles == '' ){
				$num_articles = 0;
				
			}else{
				$num_articles = $fea->articles;
			}
			
			if(strpos($fea->name, 'staticpage') !== false){
				printf($liid,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizeModuleContent","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$fea->id,$pathurl,$pathurl,$pathurl);
			}else if(strpos($fea->name, 'photo') !== false){
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnewdesign","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl,$pathurl);
			}else if(strpos($fea->name, 'video') !== false){
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnewdesign","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl,$pathurl);
			}else{
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnew","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl,$pathurl);
			}
			
//echo CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnew","module_id"=>$fea->id))	;		 
//('post/list', 'page'=>3)
		} ?>
		
	</ul>
	
</div>
</div>
<!--  sub list wrapper ends here -->
			</div>
            <!-- Content listing ends here -->
             <!-- Edit of Content container starts here -->
            <div class="edit_content_container" id="edit_content_container"  style="display:none;">
            
            <!-- Partial Content render here ;) -->
            </div>
            
            <!-- Editing of conrent container ends here -->

<div class="row">
  		 		
  		 		<?php echo CHtml::link("<img src='$pathurl/img/preview_button.png' />", array('applicationnew/finalpreview'),array('class'=>'dd','onclick'=>'javascript:buildApp();return false;')); ?>
  		 		<?php //echo CHtml::link("<img src='$pathurl/img/download_app2.png' height='64px' />", array('applicationnew/finalpreview'),array('class'=>'dd','height'=>'64px')); ?>
  		 		<a class='generateappnew' href='<?php echo CHtml::normalizeUrl(array('applicationnew/buildPhoneGapAppMy',"id"=>Yii::app()->user->getState('app_id')))?>' ><img src='<?= $pathurl ?>/img/download_app2.png' height='64px' /></a>
  		 		<?php $apk = "javascript:buildAppApk('".Yii::app()->user->getState('app_id')."');return false;";  //echo CHtml::link("Apk request", CHtml::normalizeUrl(array('applicationnew/buildPhoneGapAppMy',"id"=>Yii::app()->user->getState('app_id'))),array('class'=>'dd'/*,'onclick'=>$apk*/)); ?>
     <!--   <p><a href="<?php echo $url ?>/applications/<?php echo Yii::app()->user->getState('username') . "_" . $application_model->title . "_" . $application_model->id; ?>/index.html?asd=sdasd" style="height:486px;width:320px;" target="iframe_a">Refresh</a></p>  -->
     </div>
<!--</div> -->

<!-- Add Feature wrapper ends here -->

<!-- Theme Setting wrapper starts here -->
<div class="theme_setting" style="display:none;">
<?php echo $this->renderPartial('_theme_settings',array('pathurl'=>$pathurl ,'model'=>$modelSelectAA,'data'=>$dataSelectAA,'url'=>$url));?>
</div>


<!-- Theme Setting ends here -->
   <?php echo $this->renderPartial('/applicationnew/_modaluploadBg'); ?>
   <?php  echo $this->renderPartial('/applicationnew/_modalimagenameuploadBg');?>
           </div> 
            
            <div class="span4">
            <div class="app_preview" id="app_preview"> 
          
            <div class="theme_preview">
           <iframe  src="<?php echo $url ?>/applications/<?php echo Yii::app()->user->getState('username') . "_" . $application_model->title . "_" . $application_model->id; ?>/index.html" style="height:486px;width:320px;" class="iframe2" id="myframe" name="iframe_a" ></iframe>
            
            </div>
            
            </div>
            </div>
            
            
                
                

         </div>
            
            
           
             
</div>
<!-- Container -->


<script type="text/javascript">
var loaderDivji = '<div class="loading_content2" style="display:block;"><img src="<?php echo $pathurl?>/img/loading_page.gif"></div>';
function popupdetial(arg,flag){

	if($(arg).parent().parent().find('a').attr('id') ==  'staticpage'){

		if( window.staticFlag == 0 )
		{
			window.staticFlag = 1
			
		}else{

			alert("Please save Static page"); 
			
			//$(arg).parent().parent().remove('#formId');
			//$('.loading_content2').hide(); flagloader = false; 
			return false;

		}

		
		
	}
	
 	flagloader = true;

 	var aaLoader = $(arg).parent().parent();

 	//console.log(aaLoader.append($(loaderDivji).show()));
 	
 	// $(arg).parent().parent().find('a').attr('id') ;
	//$(arg).parent().parent().find('div#formId').remove();
	
	
	
 	//$(arg).parent().parent().append("<div id='formId' style='display:block; height:200px; position:relative;'>"+loaderDivji+"</div>");


 	//$(arg).parent().parent().find('div#edit_content_container').html('');
 	//$(arg).parent().parent().append("<div id='edit_content_container' style='display:block; height:200px; position:relative;'>"+loaderDivji+"</div>");
 	
 	$('div#edit_content_container').html('');
 	
	if(flag)
	{
		window.location = $(arg).parent().parent().find('a').attr('href') ;
	}


	
	$.ajax({
		type : "POST",
		url: $(arg).parent().parent().find('a').attr('href'),
		beforeSend : (function(){
			jQuery('.loading_content').show();	
			//$(arg).parent().parent().find('div#formId').html(loaderDivji);
			//console.log("amrit",'sdf');
			
		}),
		}).done(function(response) {


			$('#content_listing').hide();
			
			//$(arg).parent().parent().find('div#formId').remove();

			//$(arg).parent().parent().append(loaderDivji);
			//$(arg).parent().parent().append("<div id='formId'>"+loaderDivji+response+"</div>");
			$('.loading_content2').hide();

			
			//$(arg).parent().parent().find('div#formId').append(response);
			
			//$(arg).parent().parent().find('div#edit_content_container').append(response);
			
			$('div#edit_content_container').append(response);

			$('#edit_content_container').show();
			
			$(".row-fluid.manage_apps.media_gallery.tab_gallery").fadeIn();
			$(arg).parent().parent().find('div#formId').removeAttr('style');
			//$(arg).parent().parent().find('div#formId').css('position','none');
			//$('.loading_content2').hide();
			flagloader = false;
			window.TabFlagOpen = window.TabFlagOpen + 1;
			
			ulData(window.TabFlagOpen);
		});

	

	$(arg).attr('onclick','popdetialHide(this)');
	
}

function popdetialHide(arg)
{

	window.TabFlagOpen = window.TabFlagOpen - 1;

	ulData(window.TabFlagOpen);
	
	if($(arg).parent().parent().find('a').attr('id') ==  'staticpage'){

		if( window.staticFlag == 1 )
		{
			window.staticFlag = 0
			
		}
		
		
	}

	$(arg).parent().parent().find('div#formId').remove();
	
	$(arg).attr('onclick','popupdetial(this)');

	//flagloader = true;
}

function popdetialHideOther(arg)
{

	$('div#edit_content_container').hide();

	$('div#edit_content_container').html('');

	$('#content_listing').show();

	$('div#formId').remove();
	
	//$('#module_'+arg[2]).find('a').html(arg[0]);

	$s = '<span class="content_list_icon"><img src="'+themeurl+'/img/'+arg[1]+'.png"></span>'+arg[0];

	//console.log(arg);
	$('#module_'+arg[2]).find('a').html($s);

	window.TabFlagOpen = window.TabFlagOpen - 1;

	ulData(window.TabFlagOpen);
}

/*
function popdetialHideOtherSub(arg)
{
	$('div#formId').remove();
	
	$('#submodule_'+arg[2]).find('a').html(arg[0]);	
}
*/

jQuery(document).ready(function(){

	jQuery(".featurelist ul li a").click(function(event){
			//console.log('sss');
			event.preventDefault();
			
		});
	
	
});


function customizemodulenew(){

	//alert("asdf");
	//return false;
	
}

function removeModule(arg){
	//console.log(arg,'asdf');
	
	var fond = confirm("You want to delete feature!");

	if(fond){

	
	var deleteId = $(arg).parent().parent().parent().attr('id');

	deleteId = deleteId.split('_');

	var dataPost = { 'id': deleteId[1], 'ajax':'sub-modules-grid', 'delete':'1' };

	console.log(dataPost); 
	$.post(baseurl+'/index.php?r=applicationnew/selectPage',dataPost,function(reponse){

			//console.log(reponse);
			$(arg).parent().parent().parent().remove();
		});
	}
	//$(arg).parent().parent().remove();
	
}



</script>

<script type="text/javascript">
   // var flagloader = false;
$(document).ready(function() {

	/*  
	$(window).scroll(function() {
		
		var s = $(".app_preview");

		var pos = s.position();	
		
		var windowpos = $(window).scrollTop();
		
		console.log('POS',pos,'windowpos',windowpos);

		if (windowpos >= pos.top) {
			s.addClass("stick");
			console.log('working');
		} else {
			s.removeClass("stick");	
			console.log('ongint');
		}
	});

	*/

	var s = $("#app_preview");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//console.log("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
		if (windowpos >= pos.top) {
			s.addClass("stick");
		} else {
			s.removeClass("stick");	
		}
	});

	$( document ).ajaxStart(function( event,request, settings ) {
			if(flagloader){
				//alert("asdf");
				//$('.loading_content2').show();
				//flagloader = false;
			}else{
				//alert("not add nea");
				$('.loading_content').show();
			}
		});

	$( document ).ajaxSuccess(function( event,request, settings ) {
		if(flagloader){
			//$('.loading_content2').hide();
			//flagloader = false;
		}else{
			$('.loading_content').hide();
			console.log(settings.url);
			
		}

/*		if(window.TabFlagOpen < 0 )
			window.TabFlagOpen = 0 ;
		else
			window.TabFlagOpen = window.TabFlagOpen - 1 ;

		if(window.TabFlagOpen < 0 )
			window.TabFlagOpen = 0 ;
*/		
		ulData(window.TabFlagOpen);

		console.log('suvcces',window.TabFlagOpen);

		});
	
	$( document ).ajaxComplete(function( event,request, settings ) {
		if(flagloader){
			//$('.loading_content2').hide();
		}else{
			$('.loading_content2').hide();
		}

		console.log('comllepl',window.TabFlagOpen);
		
		});

	$( document ).ajaxError(function( event,request, settings ) {
		if(flagloader){
			//$('.loading_content2').hide();
		}else{
			$('.loading_content').hide();
		}
		
		});
	
});

function refresh_iframe()
{
    //$('#myframe').attr('src', $('#myframe').attr('src'));
    var d = new Date;
    srcIframe =  IframeUrlSrc + '?time'+d.getMilliseconds()+'=' + d.getMilliseconds();
    
	console.log(srcIframe,IframeUrlSrc);
	
	$('#myframe').attr('src', srcIframe);

}

function buildApp()
{
	var dataPost = { 'ajax': 'finalpreview'};

	//console.log(dataPost); 
	$.post(baseurl+'/index.php?r=applicationnew/finalpreview',dataPost,function(reponse){

			//console.log(reponse);
			refresh_iframe();
			//$(arg).parent().parent().parent().remove();
		});

	
}

var amlicurl;


function createAppApi(url)
{
	/* $.get(baseurl+'/index?r=applicationnew/buildPhoneGapAppMy&id=471&id='+arg,function( data ) {
			console.log(data);
		}); */
	 $.get(url,function(data){ //console.log(data);
		 
			// location.reload();
			window.location.href = baseurl+'/index.php?applicationnew/dashboard';
			jQuery('.loading_content').hide();	
	  });
	
}

jQuery(document).ready(function(){
			jQuery('.generateappnew').click(function(event){
				jQuery('.loading_content').show();
				event.preventDefault();
				createAppApi($(this).attr('href'));

			});
	});

function ulData(arg)
{
	if(arg > 0 )
	{
		$( "#sortable" ).sortable( "option", "disabled", true );
	}else{
		$( "#sortable" ).sortable( "option", "disabled", false );
	}
}

// code by sob_k

function feature_listing()
{
	$('.edit_content_container').empty();
	$('.edit_content_container').hide();
	$('.content_listing').show();
	$( "#sortable" ).sortable( "option", "disabled", false );
}
//

</script>
<script>
$('#myModalMediaImageBg').on('hide.bs.modal', function (e) {
	jQuery('#myModalMediaImageBg').removeData("modal");
	})


function bg_color_cancel(flag,id)
{	
	if(flag==1)
	{
		setting_hide_app()
	}
	else if(flag==2)
	{
		setting_hide();
	}
	else if(flag==3)
	{
		setting_hide_sub(id);
		$(".Bg_display_sub_"+id).html('');
	}
		
}


function setting_show_sub(model_id)
{	
	$(".theme_content_"+model_id).hide();
	$("#submodule_"+model_id+" .single_page").show();
	$(".Bg_display_sub_"+model_id).html('');

	$('.app_info_sub').addClass('selected');
	$('.app_setting_sub').removeClass('selected');
	
}

function setting_hide_sub(model_id)
{
	
	$(".theme_content_"+model_id).show();
	$("#submodule_"+model_id+" .single_page").hide();
	$(".theme_content_"+model_id).show();
	$(".theme_setting_thumb_sub_"+model_id).show();
	
	$('.app_info_sub').removeClass('selected');
	$('.app_setting_sub').addClass('selected');
}


function setting_hide_sub_bg(model_id)
{
	var flag=3;
	default_setting_sub(model_id,flag)

}

function default_setting_sub(model_id,flag)
{
	  $.ajax({
	        type: 'POST',
	        url: baseurl+'/index.php?r=tutorial/check_appbg',
	        data: {sub_module_id:model_id,flag:flag},
	        success: function(response){
	        	//$(".theme_content_"+model_id).show();
	        	$("#submodule_"+model_id+" .single_page").hide();
	        	//$(".theme_content_"+model_id).show();
	        	$(".theme_setting_thumb_sub_"+model_id).show();
	        	
	        	$('.app_info_sub').removeClass('selected');
	        	$('.app_setting_sub').addClass('selected');
	        	if(response==1)
	        	{
	        		set_image_sub(model_id,flag);
	        	}
	        	else if (response==2)
	        	{
	        		set_color_sub(model_id,flag);
	        	}
	        	else
	        	{
	        		$(".theme_content_"+model_id).show();
	        		$("#submodule_"+model_id+" .single_page").hide();
	        		$(".theme_content_"+model_id).show();
	        		$(".theme_setting_thumb_sub_"+model_id).show();
	        		
	        		$('.app_info_sub').removeClass('selected');
	        		$('.app_setting_sub').addClass('selected');
	        	}
	        },
	        error: function(){
	            alert('error');
	        }
	    });

}

function set_color_sub(id,flag)
{
      
	  $.ajax({
	        type: 'POST',
	        url: baseurl+'/index.php?r=tutorial/image_backgroundcolor',
	        data: {id:id,flag:flag},
	        success: function(response){
	        	$(".theme_setting_thumb_sub_"+id).hide();
	        	$('.Bg_display_sub_'+id).html(response);
	        },
	        error: function(){
	            alert('error');
	        }
	    });
}


function set_image_sub(id,flag)
{	
		var obj = {};
		   if(flag==1)
	       { 
			   obj.app_id = id;
	       }
	       else if(flag==2)
	       {
	    	   obj.id = id;
	       }
	       else if(flag==3)
	       {
	    	   obj.sub_module_id = id;
	       }  
		   obj.flag=flag;
	    $.ajax({
	        type: 'POST',
	        url: baseurl+'/index.php?r=tutorial/image_background',
		    data: obj,
	        success: function(response){
	        	$(".theme_setting_thumb_sub_"+id).hide();
	        	$('.Bg_display_sub_'+id).html(response);
	        },
	        error: function(){
	            alert('error');
	        }
	    });
}

function remove_app_bg(id,status)
{
	if(id!==0)
	{
		  $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/remove_appbg',
			    data: {id:id,status:status},
		        success: function(response){
		        	var data =  JSON.parse(response);
			        
		        	if(data.status==1)
		        	{
		        		$('.background_thumb_port img').attr('src', data.image);
		        	}
		        	else if(data.status==2)
		        	{
		        		$('.background_thumb_land img').attr('src', data.image);
		        	}
		        },
		        error: function(){
		            alert('error');
		        }
		    });
	}
	else
	{
		alert('No image for remove');
	}
}

function openCloseMediaImageBg()
{	
	jQuery('#myModalMediaImageBg').modal('hide');
	jQuery('.modal-backdrop').remove();
	jQuery('#myModalMediaImageNameBg').removeData("modal");
	jQuery('#myModalMediaImageNameBg').modal({remote: "<?php echo CHtml::normalizeUrl(array('tutorial/uploadimage_background','layout'=>1))?>"});
		
}
</script>	

<script>
	function setappvalue(type=0,appid=0,moduleid=0,submoduleid=0)
	{	
		bgapp_type = type;
		bgapp_appid = appid;
		bgapp_moduleid = moduleid;
		bgapp_submoduleid= submoduleid;
	}

	function get_apptype()
	{
		return bgapp_type;
	}

	function get_bgapp_appid()
	{
		return bgapp_appid;
	}

	function get_bgapp_moduleid()
	{
		return bgapp_moduleid;
	}

	function get_bgapp_submoduleid()
	{
		return bgapp_submoduleid;
	}



	function save_bgcolor(flag,id)
    {
       var color = $('.gradx_code').html();
       var id = id;

       var flag = flag;
			var obj = {};
			   if(flag==1)
		       { 
				   obj.app_id = id;
		       }
		       else if(flag==2)
		       {
		    	   obj.id = id;
		       }
		       else if(flag==3)
		       {
		    	   obj.sub_module_id = id;
		       }  
			   obj.color = color;

  		
       $.ajax({
		        type: 'POST',
		        url: baseurl+'/index.php?r=tutorial/app_bgcolor',
		        data: obj,
		        success: function(response){
		        	//$('.theme_setting_thumb').hide();
		        	//$('.Bg_display').html(response);
		        },
		        error: function(){
		            alert('error');
		        }
		    });
    }
	
</script>

<style type="text/css">
.stick {
	position:fixed;
	top:0px;
	margin-top:5px;
}
</style>
