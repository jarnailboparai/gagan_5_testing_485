<?php $url =  Yii::app()->getBaseUrl(true); 
$pathurl = Yii::app()->theme->baseUrl;
?>
<script type="text/javascript"  src="<?= $url ?>/js/nicEdit-latest.js"></script>
<script>
	window.staticFlag = 0;
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
.pull-right.edit_icon span:nth-child(2){
	display: none;
}
.row-fluid.manage_apps.media_gallery.tab_gallery
{
	display:none;
}
</style>
<script type="text/javascript">
    var flagloader = false;
 </script>
<!-- Container -->

<div class="container selectfeatures">
          <div class="row-fluid select_content">
          <div class="span8">
          <div class="app_number">Add Features into <span class="number">Your App</span></div>
         	<!--  Crousel Starts Here -->
         	
         	 
          <a href="#" class="add_features">Add Features</a>
          <?php echo $this->renderPartial('_carsoulwrap',array('pathurl'=>$pathurl ,'model'=>$modelSelectAA,'data'=>$dataSelectAA,'url'=>$url));?>
          
         	<!--  Crousel ends here -->
            <div class="featurelist">
	<ul>
		<?php 
		$li = "<li  id='module_%s' ><div class='wrapperli'><a href='%s' id='%s' ><span class='content_list_icon'><img src='%s/img/%s.png'></span>%s</a><div class='pull-right edit_icon'><span onclick='javascript:popupdetial(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='popdetialHide(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeModule(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div></div></li>"; 
		$liid = "<li  id='module_%s' ><div class='wrapperli'><a href='%s' id='%s' ><span class='content_list_icon' ><img src='%s/img/%s.png'></span>%s</a><div class='pull-right edit_icon'><span id='staticPageFormButton_%s'   onclick='javascript:popupdetial(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='javascript:popupdetial(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeModule(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div></div> </li>";
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
				printf($liid,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizeModuleContent","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$fea->id,$pathurl,$pathurl,$pathurl);
			}else if(strpos($fea->name, 'photo') !== false){
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnewdesign","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl);
			}else if(strpos($fea->name, 'video') !== false){
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnewdesign","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl);
			}else{
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnew","module_id"=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl);
			}
			
//echo CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnew","module_id"=>$fea->id))	;		 
//('post/list', 'page'=>3)
		} ?>
		
	</ul>
	<div class="row">
  		 		
  		 		<?php echo CHtml::link("<img src='$pathurl/img/preview_button.png' />", array('applicationnew/finalpreview'),array('class'=>'dd','onclick'=>'javascript:buildApp();return false;')); ?>
  		 		<?php //echo CHtml::link("<img src='$pathurl/img/download_app2.png' height='64px' />", array('applicationnew/finalpreview'),array('class'=>'dd','height'=>'64px')); ?>
  		 		<a class='generateappnew' href='<?php echo CHtml::normalizeUrl(array('applicationnew/buildPhoneGapAppMy',"id"=>Yii::app()->user->getState('app_id')))?>' ><img src='<?= $pathurl ?>/img/download_app2.png' height='64px' /></a>
  		 		<?php $apk = "javascript:buildAppApk('".Yii::app()->user->getState('app_id')."');return false;";  //echo CHtml::link("Apk request", CHtml::normalizeUrl(array('applicationnew/buildPhoneGapAppMy',"id"=>Yii::app()->user->getState('app_id'))),array('class'=>'dd'/*,'onclick'=>$apk*/)); ?>
     </div>
</div>
           </div> 
            
            <div class="span4">
            <div class="app_preview">
            <div class="theme_preview">
           <iframe src="<?php echo $url ?>/applications/<?php echo Yii::app()->user->getState('username') . "_" . $application_model->title . "_" . $application_model->id; ?>/index.html" style="height:486px;width:100%;" class="iframe2" id="myframe"></iframe>
            
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
	$(arg).parent().parent().find('div#formId').remove();
 	$(arg).parent().parent().append("<div id='formId' style='display:block; height:200px; position:relative;'>"+loaderDivji+"</div>");
 	
	if(flag)
	{
		window.location = $(arg).parent().parent().find('a').attr('href') ;
	}


	
	$.ajax({
		type : "POST",
		url: $(arg).parent().parent().find('a').attr('href'),
		beforeSend : (function(){
			
			//$(arg).parent().parent().find('div#formId').html(loaderDivji);
			//console.log("amrit",'sdf');
			
		}),
		}).done(function(response) {

			//$(arg).parent().parent().find('div#formId').remove();

			//$(arg).parent().parent().append(loaderDivji);
			//$(arg).parent().parent().append("<div id='formId'>"+loaderDivji+response+"</div>");
			$('.loading_content2').hide();
			
			$(arg).parent().parent().find('div#formId').append(response);
			$(".row-fluid.manage_apps.media_gallery.tab_gallery").fadeIn();
			$(arg).parent().parent().find('div#formId').removeAttr('style');
			//$(arg).parent().parent().find('div#formId').css('position','none');
			//$('.loading_content2').hide();
			flagloader = false;

			
		});

	

	$(arg).attr('onclick','popdetialHide(this)');
	
}

function popdetialHide(arg)
{

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
	$('div#formId').remove();
	
	//$('#module_'+arg[2]).find('a').html(arg[0]);

	$s = '<span class="content_list_icon"><img src="'+themeurl+'/img/'+arg[1]+'.png"></span>'+arg[0];

	//console.log(arg);
	$('#module_'+arg[2]).find('a').html($s);
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
	var s = $(".app_preview");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
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
		});
	
	$( document ).ajaxComplete(function( event,request, settings ) {
		if(flagloader){
			//$('.loading_content2').hide();
		}else{
			$('.loading_content2').hide();
		}
		
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
    $('#myframe').attr('src', $('#myframe').attr('src'));

}

function buildApp()
{
	var dataPost = { 'ajax': 'finalpreview'};

	console.log(dataPost); 
	$.post(baseurl+'/index.php?r=applicationnew/finalpreview',dataPost,function(reponse){

			//console.log(reponse);
			refresh_iframe()
			//$(arg).parent().parent().parent().remove();
		});

	
}

var amlicurl;

function buildAppApk(arg)
{
	var dataPost = { 'id': arg};

	console.log(dataPost); 
	amlicurl = $.post('http://112.196.20.243:8021/members/wizard/shell/test.php?id='+arg,dataPost,function(reponse){

			console.log(reponse);
		});
	

	setTimeout('amlicurl.abort(); alert("Your request under process, we will let you when it is done ");',5000);
}

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


</script>
<style type="text/css">
.stick {
	position:fixed;
	top:0px;
	margin-top:5px;
}
</style>
