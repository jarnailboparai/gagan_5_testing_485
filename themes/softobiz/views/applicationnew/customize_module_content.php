<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/softobiz/css/customize_module_details.css">
<?php $url =  Yii::app()->getBaseUrl(true); ?>

<script type="text/javascript"  src="<?= $url ?>/js/nicEdit-latest.js"></script>

<?php //$this->renderPartial("app_menu", array('style' => $style)); ?>

<?php if($model->page_type == 1){ ?>
 <?php echo $this->renderPartial('_feature_title',array('model'=>$model));?>
	<?php echo $this->renderPartial("_modulepage", array("model"=>$model)); ?>

<?php }elseif ($model->page_type == 2) { ?>
	 <?php echo $this->renderPartial('_feature_title',array('model'=>$model));?>
	<?php echo $this->renderPartial("_modulemultipage", array("model"=>$model)); ?>
	
	<?php //echo $this->renderPartial("_submodulepage", array("model"=>$submodel,'data'=>$model)); ?>
	
	<?php //echo count($model->subModules);  ?>
	<div class="sub_page_wrapper">
	<div class="inner_accordin">
	<div class="subpage_title">
	<span class="pull-left">Subpages</span><span id="addSubPage" class="btn pull-left add_page_btn" onclick="addSubPage('<?php echo $model->id;?>');">Add Subpage</span>
	<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
	<div class="addSubPageForm" id="addSubPageForm"></div>
	<div class="clearfix"></div>
	</div>
	
	<?php foreach($model->subModules as $sub){
		
		//echo "<li id='submodules_$sub->id'>$sub->tab_title</li>";
	} ?>
	
	<!-- Multiple pages panel starts here -->
    <!-- <div class="single_page multiplepages"> <a href="#" class="btn pull-right add_page_btn">Add Page</a>
                  <table class="title_table">
                <tr>
                      <td><input type="text" placeholder="Title"></td>
                      <td><div class="select_icon" title="Select Icon"></div></td>
                    </tr>
              </table>
                  <div class="content_editor"> <img src="images/content_editor.jpg" alt="content editor" /> </div>
                  <div class="pages_link">
                <table class="table">
                      <tr>
                    <td><a href="#" class="multipage_link">Content link1</a></td>
                    <td width="12%"><div class="pull-right edit_icon"><span><a href="#" title="Edit"><img src="images/edit_content.png" alt="edit"></a></span><span><a href="#" title="Refresh"><img src="assets/img/refresh.png" alt="refresh"></a></span><span><a href="#" title="Remove"><img src="assets/img/trash_icon.png" alt="refresh"></a></span></div></td>
                  </tr>
                      <tr>
                    <td><a href="#" class="multipage_link">Content link2</a></td>
                    <td width="12%"><div class="pull-right edit_icon"><span><a href="#" title="Edit"><img src="assets/img/edit_content.png" alt="edit"></a></span><span><a href="#" title="Refresh"><img src="assets/img/refresh.png" alt="refresh"></a></span><span><a href="#" title="Remove"><img src="assets/img/trash_icon.png" alt="refresh"></a></span></div></td>
                  </tr>
                      <tr>
                    <td><a href="#" class="multipage_link">Content link3</a></td>
                    <td width="12%"><div class="pull-right edit_icon"><span><a href="#" title="Edit"><img src="assets/img/edit_content.png" alt="edit"></a></span><span><a href="#" title="Refresh"><img src="assets/img/refresh.png" alt="refresh"></a></span><span><a href="#" title="Remove"><img src="assets/img/trash_icon.png" alt="refresh"></a></span></div></td>
                  </tr>
                      <tr>
                    <td><a href="#" class="multipage_link">Content link4</a></td>
                    <td width="12%"><div class="pull-right edit_icon"><span><a href="#" title="Edit"><img src="assets/img/edit_content.png" alt="edit"></a></span><span><a href="#" title="Refresh"><img src="assets/img/refresh.png" alt="refresh"></a></span><span><a href="#" title="Remove"><img src="assets/img/trash_icon.png" alt="refresh"></a></span></div></td>
                  </tr>
                      <tr>
                    <td><a href="#" class="multipage_link">Content link5</a></td>
                    <td width="12%"><div class="pull-right edit_icon"><span><a href="#" title="Edit"><img src="assets/img/edit_content.png" alt="edit"></a></span><span><a href="#" title="Refresh"><img src="assets/img/refresh.png" alt="refresh"></a></span><span><a href="#" title="Remove"><img src="assets/img/trash_icon.png" alt="refresh"></a></span></div></td>
                  </tr>
                    </table>
              </div>
                  <div class="button_panel">
                <input name="" class="btn btn-success" type="button" value="Save">
                <input name="" type="button" class="btn cancel_multipage" value="Cancel">
              </div>
                </div> -->
            
            <!-- Multiple pages ends here -->
	<?php $this->renderPartial('_orderlist');?>
	<ul id="wrapperliUl">
		<?php //$li = "<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' >%s</a><div class='pull-right edit_icon'><span onclick='popupdetialSub(this)' >Edit</span>  <span onclick='popdetialHideSub(this)' >Hide</span> </div></li>"; 
		//$liid = "<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' >%s</a><span onclick='popupdetialSub(this)' >Edit</span>  <span onclick='popdetialHideSub(this)' >Hide</span> <span onclick='removeSubMenu(this)' >Remove</span></div> </div></li>";
	
	$li = "<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' ><span class='content_list_icon' ><img src='%s/img/%s.png'></span>%s</a><div class='pull-right edit_icon'><span onclick='popupdetial(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='popdetialHide(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeModule(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div> </div></li>";
	$liid = "<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' ><span class='content_list_icon' ><img src='%s/img/%s.png'></span>%s</a><div class='pull-right edit_icon'><span onclick='popupdetialSub(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='popdetialHideSub(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeSubMenu(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div></div></li>";
	/*
		
		foreach($model->subModules as $fea)
		{
			if ($fea->tab_title == NULL)
				$title = $fea->name;
			else
				$title = $fea->tab_title;
			
			if ($title == '')
				$title = $fea->name;
			
			//$pos = strpos($fea->name, 'content');
			
			$pathurl = Yii::app()->theme->baseUrl;
			
			if($fea->articles == null || $fea->articles == '' ){
				$num_articles = 0;
				
			}else{
				$num_articles = $fea->articles;
			}
			
			if(strpos($fea->name, 'staticpage') !== false){
				printf($liid,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizeSubModuleContent","sub_module_id"=>$fea->id,"num_articles"=>$num_articles)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl);
			}else{
				printf($li,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizemoduledetailsnew","module_id="=>$fea->id)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl);
			}
			
			 
			
		} */ ?>
		
	<?php  foreach($model->subModules as $fea)
		{
			if ($fea->tab_title == NULL)
				$title = $fea->name;
			else
				$title = $fea->tab_title;
			
			if ($title == '')
				$title = $fea->name;
			
			//$pos = strpos($fea->name, 'content');
			
			$pathurl = Yii::app()->theme->baseUrl;
			
			if($fea->articles == null || $fea->articles == '' ){
				$num_articles = 0;
				
			}else{
				$num_articles = $fea->articles;
			}
			
			if(strpos($fea->name, 'staticpage') !== false){
				//printf($liid,$fea->id,CHtml::normalizeUrl(array("applicationnew/customizeSubModuleContent","sub_module_id"=>$fea->id,"num_articles"=>$num_articles)),$fea->name,$pathurl,$fea->name,$title,$pathurl,$pathurl,$pathurl);
			
			?>					
			<li id="submodule_<?php echo $fea->id?>">
					<div class="wrapperli">
						<a id="staticpage" href="<?php echo CHtml::normalizeUrl(array("applicationnew/customizeSubModuleContent","sub_module_id"=>$fea->id,"num_articles"=>$num_articles)) ?>">
							<span class="content_list_icon">
								<?php echo CHtml::image($pathurl.'/img/'.$fea->name.".png");  ?>
							</span><?php echo $title; ?>
						</a>
						<div class="pull-right edit_icon">
							<span class="drag"><?php echo CHtml::image($pathurl."/img/drag.png");  ?></span>
							<span onclick="popupdetialSub(this)"><?php echo CHtml::image($pathurl."/img/edit_content.png","edit");  ?></span>
							<span onclick="popdetialHideSub(this)"><?php echo CHtml::image($pathurl."/img/refresh.png","refresh");  ?></span>
							<span onclick="removeSubMenu(this)"><?php echo CHtml::image($pathurl."/img/trash_icon.png","remove");  ?></span>
						</div>
					</div>
				</li>

			<?php }else{
			
			} ?>
			
			<?php }  ?>
		
	</ul>	
	</div>
<script>
function popupdetialSub(arg,flag)
{	
	// code by sob_k
	// only one tab open in one time
	setting_show();
	$('#wrapperliUl li #formId').remove();
	// code end by sob_k
	//console.log(jQuery(arg).find('a').attr('href') );
	//console.log(jQuery(arg).attr('href') );
	//console.log($(arg).parent().find('a').attr('href') );

	console.log($(arg).parent().parent().find('a').attr('id') );

	//return false;
	
	if(flag)
	{
		window.location = $(arg).parent().parent().find('a').attr('href') ;
	}
	
	
	$.ajax({
		//url: jQuery(arg).find('a').attr('href') ,
		//url: jQuery(arg).attr('href') ,
		url: $(arg).parent().parent().find('a').attr('href'),
		}).done(function(response) {

			$(arg).parent().parent().parent().find('div#formId').remove();
			
			$(arg).parent().parent().parent().append("<div id='formId'>"+response+"</div>");
		});
}

function popdetialHideSub(arg)
{
	$(arg).parent().parent().parent().find('div#formId').remove();
}

function popdetialHideOtherSub(arg,idd)
{
	//console.log('asdf',idd,arg[2]);
	//$('div#formId #body_rightModalSub').remove();

	$('#submodule_'+arg[2]).find("div#formId").remove();

	$s = '<span class="content_list_icon"><img src="'+themeurl+'/img/'+arg[1]+'.png"></span>'+arg[0];

	console.log(arg);

	$('#submodule_'+arg[2]).find('a').html($s);
	
	//$('#submodule_'+arg[2]).find('a').html(arg[0]);	
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

	$("#addSubPage").hide();
	//var url = "/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&flagC=1" ;
	var url = baseurl+"/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id="+arg+"&flagC=1"
	$.ajax({
		url: url,
		}).done(function(response) {

			$("#addSubPageForm").html('');
			
			$("#addSubPageForm").append("<div id='formId'>"+response+"</div>");

			$("#addSubPage").addClass("make_abso");
		});
}

function addNewLi(arg)
{

	var sssimage = '<span class="content_list_icon"><img alt="staticpage" src="/members/wizard/themes/softobiz/img/staticpage.png"></span>';
	$liid = "<li  id='submodule_"+arg[2]+"' >";
	$liid += "<div class='wrapperli'>";
	$liid += "<a href='"+baseurl+"/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id="+arg[2]+"&num_articles=0' id='"+arg[1]+"' >"+sssimage+arg[0]+"</a>";
	$liid += "<div class='pull-right edit_icon'>"
	$liid += "<span class='drag'><img src='"+themeurl+"/img/drag.png' alt='edit'></span>"; 	
	$liid += "<span onclick='popupdetialSub(this)' ><img src='"+themeurl+"/img/edit_content.png' alt='edit'></span>"; 
	$liid += " <span onclick='popdetialHideSub(this)' ><img src='"+themeurl+"/img/refresh.png' alt='refresh'></span>";
	$liid += "<span onclick='removeSubMenu(this)' ><img src='"+themeurl+"/img/trash_icon.png' alt='remove'></span>";
	$liid += "</div></div></li>";

	//"<li  id='submodule_%s' ><div class='wrapperli'><a href='%s' id='%s' ><span><img src='%s/img/face_book_edit.png'></span>%s</a><div class='pull-right edit_icon'><span onclick='popupdetialSub(this)' ><img src='%s/img/edit_content.png' alt='edit'></span>  <span onclick='popdetialHideSub(this)' ><img src='%s/img/refresh.png' alt='refresh'></span> <span onclick='removeSubMenu(this)' ><img src='%s/img/trash_icon.png' alt='remove'></span></div></div></li>";
	//$fea->id,"/members/wizard/index.php?r=applicationnew/customizeSubModuleContent&sub_module_id=".$fea->id.'&num_articles='.$num_articles,$fea->name,$title

	$('#wrapperliUl').append($liid);
}

function removeSubMenu(arg)
{
	//console.log(arg); return false;

	var deleteId = $(arg).parent().parent().parent().attr('id');

	//console.log(deleteId); return false;
	
	deleteId = deleteId.split('_');

	var dataPost = { 'id': deleteId[1], 'ajax':'sub-modules-grid'};

	$.post(baseurl+'/index.php?r=submodules/delete&ajax=sub-modules-grid&id='+deleteId[1],dataPost,function(reponse){

			//console.log(reponse);
			$(arg).parent().parent().parent().remove();
		});
	
	

}

//addNewLi(["amrirt","staticpage","5"]);

</script>
	</div>
<?php }else{
	
	echo $this->renderPartial('_formpagetype', array('model'=>$model,'module_id'=>$model->id));
	
	
	
}?>


