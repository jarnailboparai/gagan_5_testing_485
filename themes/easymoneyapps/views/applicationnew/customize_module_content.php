<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/easymoneyapps/css/customize_module_details.css">
<?php $url =  Yii::app()->getBaseUrl(true); ?>

<script type="text/javascript"  src="<?= $url ?>/js/nicEdit-latest.js"></script>

<?php //$this->renderPartial("app_menu", array('style' => $style)); ?>

<?php if($model->page_type == 1){ ?>

	<?php echo $this->renderPartial("_modulepage", array("model"=>$model)); ?>

<?php }elseif ($model->page_type == 2) { ?>
	
	<?php //echo $this->renderPartial("_submodulepage", array("model"=>$submodel,'data'=>$model)); ?>
	
	<?php //echo count($model->subModules);  ?>
	<div style="float:left; border:2px solid;">
	
	<span id="addSubPage" onclick="addSubPage('<?php echo $model->id;?>');">Add Subpage</span>
	<div class="addSubPageForm" id="addSubPageForm"></div>
	
	<?php foreach($model->subModules as $sub){
		
		//echo "<li id='submodules_$sub->id'>$sub->tab_title</li>";
	} ?>
	
	<ul id="wrapperliUl">
		<?php $li = "<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' >%s</a><span onclick='popupdetialSub(this)' >Edit</span>  <span onclick='popdetialHideSub(this)' >Hide</span> </div></li>"; 
		$liid = "<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' >%s</a><span onclick='popupdetialSub(this)' >Edit</span>  <span onclick='popdetialHideSub(this)' >Hide</span> <span onclick='removeSubMenu(this)' >Remove</span> </div></li>";
		foreach($model->subModules as $fea)
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
				printf($liid,$fea->id,"/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id=".$fea->id.'&num_articles='.$num_articles,$fea->name,$title);
			}else{
				printf($li,$fea->id,"/members/wizard/index.php?r=applicationnew/customizemoduledetailsnew&module_id=".$fea->id,$fea->name,$title);
			}
			
			 
			
		} ?>
		
	</ul>	
<script>
function popupdetialSub(arg,flag=0)
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

function popdetialHideSub(arg)
{
	$(arg).parent().parent().find('div#formId').remove();
}

function popdetialHideOtherSub(arg)
{
	$('div#formId #body_rightModalSub').remove();
	
	$('#submodule_'+arg[2]).find('a').html(arg[0]);	
}

jQuery(document).ready(function(){

	jQuery(".featurelist ul li a").click(function(event){
			//console.log('sss');
			event.preventDefault();
			
		});
	
});


function customizemodulenew(){
	
}

function addSubPage(arg){

	//var url = "/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&flagC=1" ;
	var url = "/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id="+arg+"&flagC=1"
	$.ajax({
		url: url,
		}).done(function(response) {

			$("#addSubPageForm").html('');
			
			$("#addSubPageForm").append("<div id='formId'>"+response+"</div>");
		});
}

function addNewLi(arg)
{
	$liid = "<li  id='submodule_"+arg[2]+"' >";
	$liid += "<div class='wrapperli'>";
	$liid += "<a href='/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id="+arg[2]+"&num_articles=0' id='"+arg[1]+"' >"+arg[0]+"</a>";
	$liid += "<span onclick='popupdetialSub(this)' >Edit</span>"; 
	$liid += " <span onclick='popdetialHideSub(this)' >Hide</span>";
	$liid += "<span onclick='removeSubMenu(this)' >Remove</span> </div></li>";

	//$fea->id,"/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id=".$fea->id.'&num_articles='.$num_articles,$fea->name,$title

	$('#wrapperliUl').append($liid);
}

function removeSubMenu(arg)
{
	//console.log(arg);

	var deleteId = $(arg).parent().parent().attr('id');

	deleteId = deleteId.split('_');

	var dataPost = { 'id': deleteId[1], 'ajax':'sub-modules-grid'};

	$.post('/members/wizard/index.php?r=submodules/delete&ajax=sub-modules-grid&id='+deleteId[1],dataPost,function(reponse){

			//console.log(reponse);
			$(arg).parent().parent().remove();
		});
	
	

}

//addNewLi(["amrirt","staticpage","5"]);

</script>
	</div>
<?php }else{
	
	echo $this->renderPartial('_formpagetype', array('model'=>$model));
	
}?>


