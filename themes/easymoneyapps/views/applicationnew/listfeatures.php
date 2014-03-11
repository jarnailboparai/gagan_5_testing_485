<?php $url =  Yii::app()->getBaseUrl(true); ?>

<script type="text/javascript"  src="<?= $url ?>/js/nicEdit-latest.js"></script>
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
	display:none !important;
}

.body_rightModal #showMobile {
	/*display:none;*/
}
</style>
<?php if(count($selected)){ ?>
<?php echo $this->renderPartial('_formfeatureSelect', array('model'=>$modelMod,'data'=>$selected)); ?>
<?php } ?>
<div class="body_right width100">
    <h1 class="app_details_style style_left">
        Customize Modules <br/><span>Please enter relevant information to customize
            your App.  <?php echo $application_model->id; ?> 
            <?php echo Yii::app()->user->getState('username') . "_" . $application_model->title . "_" . $application_model->id; ?></span>
    </h1>
     <h1 class="app_details_style style_left">
  		 <?php echo CHtml::link('<span class="icon02"></span> Reflect changes in app ', array('applicationnew/finalpreview')); ?>
     </h1>
     
  
<div class="featurelist">
	<ul>
		<?php $li = "<li  id='module_%s' ><div class='wrapperli'><a href='%s' id='%s' >%s</a><span onclick='popupdetial(this)' >Edit</span>  <span onclick='popdetialHide(this)' >Hide</span> <span onclick='removeModule(this)' >Remove</span></div></li>"; 
		$liid = "<li  id='module_%s' ><div class='wrapperli'><a href='%s' id='%s' >%s</a><span onclick='popupdetial(this)' >Edit</span>  <span onclick='popdetialHide(this)' >Hide</span> <span onclick='removeModule(this)' >Remove</span> </div></li>";
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
				printf($liid,$fea->id,"/members/wizard/index.php?r=applicationnew/customizeModuleContent&module_id=".$fea->id.'&num_articles='.$num_articles,$fea->name,$title);
			}else{
				printf($li,$fea->id,"/members/wizard/index.php?r=applicationnew/customizemoduledetailsnew&module_id=".$fea->id,$fea->name,$title);
			}
			
			 
			
		} ?>
		
	</ul>
</div>

	<div id="customizePreview" class="map_mobile_view">

        <img width="395" height="722" src="/members/wizard/themes/easymoneyapps/images/preview-handset.png"><br>

        <iframe src="/members/wizard/applications/<?php echo Yii::app()->user->getState('username') . "_" . $application_model->title . "_" . $application_model->id; ?>/index.html" style="top:-692px !important;" class="iframe2" id="myframe"></iframe>

    </div>

</div>

<script>
function popupdetial(arg,flag=0)
{
	//console.log(jQuery(arg).find('a').attr('href') );
	//console.log(jQuery(arg).attr('href') );
	//console.log($(arg).parent().find('a').attr('href') );

	console.log($(arg).parent().find('a').attr('id') );

	//return false;
	
	if(flag)
	{
		window.location = $(arg).parent().find('a').attr('href') ;
	}
	
	
	$.ajax({
		//url: jQuery(arg).find('a').attr('href') ,
		//url: jQuery(arg).attr('href') ,
		url: $(arg).parent().find('a').attr('href'),
		}).done(function(response) {

			$(arg).parent().parent().find('div#formId').remove();
			
			$(arg).parent().parent().append("<div id='formId'>"+response+"</div>");
		});
}

function popdetialHide(arg)
{
	$(arg).parent().parent().find('div#formId').remove();
}

function popdetialHideOther(arg)
{
	$('div#formId').remove();
	
	$('#module_'+arg[2]).find('a').html(arg[0]);	
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
	
	var deleteId = $(arg).parent().parent().attr('id');

	deleteId = deleteId.split('_');

	var dataPost = { 'id': deleteId[1], 'ajax':'sub-modules-grid', 'delete':'1' };

	console.log(dataPost); 
	$.post('/members/wizard/index.php?r=applicationnew/selectPage',dataPost,function(reponse){

			//console.log(reponse);
			$(arg).parent().parent().remove();
		});

	//$(arg).parent().parent().remove();
	
}



</script>
