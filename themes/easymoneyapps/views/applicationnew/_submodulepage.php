<script><?php if(!$flagC) { ?>
jQuery(document).ready(function(){
	
	jQuery('#module-form').submit(function(e){
		 e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = JSON.parse(response);
	        	//popdetialHideOther(arg);
				popdetialHideOtherSub(arg);
	        	
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
}); 
<?php }else{ ?>

jQuery(document).ready(function(){
	
	jQuery('#module-form').submit(function(e){
		 e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('module-form');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert('eee');
				var arg = JSON.parse(response);
	        	//popdetialHideOther(arg);
				//popdetialHideOtherSub(arg);
				addNewLi(arg);
				$("#addSubPageForm").html('');
	        	
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
}); 

<?php } ?>
</script>
<div class="body_rightModal" id="body_rightModalSub">
    <h1 class="app_details_style customH1">Customize Modules</h1>
    <div class="span6">
        <!--                <form class="form-horizontal" action="./Customize Module Detail_files/Customize Module Detail.htm" method="post" autocomplete="off" enctype="multipart/form-data">-->
        <?php
        if($flagC)
        {
	        $form = $this->beginWidget('CActiveForm', array(
	            'id' => 'module-form',
	        	'action'=> CHtml::normalizeUrl(array('submodules/create')),
	            'enableAjaxValidation' => false,
	            'htmlOptions' => array(
	                'class' => 'form-horizontal',
	                'enctype' => 'multipart/form-data',
	            	'onsubmit' => 'return customizemodulenew();'
	            ),
	        ));
	        
	     ?><?php echo $form->hiddenField($model,'name',array('size'=>50,'maxlength'=>50,'value'=>'staticpage')); ?>
		<?php echo $form->hiddenField($model,'module_id',array('size'=>50,'maxlength'=>50,'value'=>$data->id)); ?>
		<?php echo $form->hiddenField($model,'activated',array('size'=>50,'maxlength'=>50,'value'=>'yes')); ?>
		
		<?php 
        
        }else{
	        $form = $this->beginWidget('CActiveForm', array(
	        		'id' => 'module-form',
	        		//'action'=> CHtml::normalizeUrl(array('submodules/update')),
	        		'enableAjaxValidation' => false,
	        		'htmlOptions' => array(
	        				'class' => 'form-horizontal',
	        				'enctype' => 'multipart/form-data',
	        				'onsubmit' => 'return customizemodulenew();'
	        		),
	        ));
       
        
        ?><?php echo $form->hiddenField($model,'name',array('size'=>50,'maxlength'=>50,'value'=>'staticpage')); ?>
        		<?php echo $form->hiddenField($model,'module_id',array('size'=>50,'maxlength'=>50,'value'=>$model->module_id)); ?>
        		<?php echo $form->hiddenField($model,'activated',array('size'=>50,'maxlength'=>50,'value'=>'yes')); ?>
         
        <?php }		
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
        $keyword_arr = array('news(keyword)', 'events(keyword)', 'twitter(keyword)', 'youtube(keyword)', 'photoGallery(keyword)');
        $username_arr = array('twitter', 'facebook', 'youtube');
        $rss_arr = array('rss_feeds');
        $photo_gallery_arr = array('photo_gallery',);
//      $content_arr = array('about_us', 'location', 'opening_hours', 'testimonials', 'contact_us');
        $content_arr = array('about_us', 'opening_hours', 'testimonials', 'contact_us','staticpage');
        $web_page_arr = array('web_page');
        $photos_arr = array('photos');
        $content = array('content', 'content2', 'content3', 'content4');
        $notification = array('notification');
        $admob = array('Admob');
        $optin_form = array('optin_form');
        $location = array('location');
        ?>
        <fieldset >
            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php endif; ?>
            
		
		
            <?php if (in_array($model->name, $content_arr)) { ?>
                <div class="control-group">
                    <label class="control-label">Content </label>
                    <div class="controls">
                        <textarea id="editor1" name="SubModules[description]" style="width: 400px;height: 300px" cols="100"><?= $model->description ?></textarea>
                    </div>
                </div>
                <script>
                    var nicedt;
                    //<![CDATA[
                  /*  bkLib.onDomLoaded(function() {
                        nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                        nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    }); */
                    //]]>
                    function myBk(){
                    	nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                       // nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    
               		}
                		myBk();
					
                        $(document).ready(function() {
                        /**************Ckeditor-begin*******************/
                        //                        CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/


                        $('#showMobile').click(function() {

                            refresh_iframe();
                            setTimeout(function() {
                                var iframeObj = $('#myframe').contents();
                                if ($('#customizePreview').css('display') == 'none') {
                                    $('#customizePreview').slideDown('slow');
                                    iframeObj.find('div[data-role="content"]').html(nicedt.instanceById('editor1').getContent());
                                }
                                else {
                                    iframeObj.find('div[data-role="content"]').html(nicedt.instanceById('editor1').getContent());
                                }

                            }, 500);

                        });


                    });</script>
            <?php } ?>

           <?php if (!in_array($model->name, $admob)) {
                ?>


                <div class="control-group">

                    <label class="control-label">Tab Title:</label>

                    <div class="controls">

                        <?php echo $form->textField($model, 'tab_title', array('class' => 'span4', 'value' => $title)); ?>

                    </div>

                </div>

                <div class="control-group">

                    <label class="control-label">Tab Icon:</label>

                    <div class="controls">

                        <div class="change_icon_block">

                            <?php echo $form->hiddenField($model, 'tab_icon'); ?>

                            <span class="change_icon_block_image_wrapper">

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

                        </div>



                    </div>

                    <div class="btn btn-primary3 btn-large" id="showMobile" >Send/Show</div>

                </div>



            <?php } ?>

            <div style="clear:both"></div>

            <input type="hidden" name="submitted" value="1">

            <div class="form-actions">

                <?php echo CHtml::submitButton('Save & Reload', array('onclick'=>"nicEditors.findEditor('editor1').saveContent();",'class' => 'btn btn-primary btn-large on_save', 'style' => 'float: left;margin-left: 35%;')); ?>

                <?php echo CHtml::link('Return to Tab List', array('/application/customizemodules'), array('class' => 'btn btn-large btn_radius btn-primary4')); ?>

            </div>

        </fieldset>



        <?php $this->endWidget(); ?>
    </div>
    <div id="customizePreview" style="display: none;" >

        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/preview-handset.png" width="395" height="722" /><br>

        <iframe id="myframe" class="iframe2" style="top:-692px !important;" src=""></iframe>

    </div>
</div>





<?php
if (substr($model->name, 0, 7) == 'content')
    $model_name = 'content';
else
    $model_name = $model->name;
?>
<script>

    $(document).ready(function() {
        var ifOb;
        $('#Module_tab_title').keyup(function() {
            ifOb = $('#myframe').contents();
            ifOb.find('h1').html($('#Module_tab_title').val());
            ifOb.find('.ui-btn-text').html($('#Module_tab_title').val());
        });
        $('#showMobile').click(function() {
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
        $('.change_icon_block_image_wrapper').click(function() {
            $('.change_icon_block_popup').fadeIn();
        });
        $('.change_icon_block_popup em').click(function() {
            $('.change_icon_block_popup').fadeOut();
        });
        $(document).click(function(e) {
            if ($(e.target).parents().filter('.change_icon_block').length == 0) {
                $('.change_icon_block_popup').fadeOut();
            }
        });
        $('.change_icon_block_tabs_content img').click(function() {
            $('.change_icon_block_image_wrapper img').attr('src', $(this).attr('src'));
            $('.change_icon_block_popup').fadeOut();
            $('input[name="SubModules[tab_icon]"]').val($(this).attr('src'));
            var iframeObj = $('#myframe').contents();
            iframeObj.find('#tab2 .ui-icon').css('background', 'url("../../' + $('.change_icon_block_image_wrapper img').attr('src') + '")  50% 50% no-repeat');
        });
        /********Iframe-begin********/

        var titlename = "<?= $model_name; ?>";
        var html = '';
        switch (titlename) {
            case 'optin_form':
                {
                    html = 'optin_form.html';
                }
                break;
            case 'news(keyword)':
                {
                    html = 'news.html';
                }
                break;
            case 'events(keyword)':
                {
                    html = 'events.html';
                }
                break;
            case 'youtube(keyword)':
                {
                    html = 'youtubeKeywords.html';
                }
                break;
            case 'photoGallery(keyword)':
                {
                    html = 'photoGalleryKeywords.html';
                }
                break;

            case 'local_news':
                {
                    html = 'localNews.html';

                }
                break;
            case 'local_events':
                {
                    html = 'localEvents.html';
                }
                break;
            case 'deals':
                {
                    html = 'deals.html';
                }
                break;
            case 'photo_gallery':
                {
                    html = 'photoGallery.html';
                }
                break;
            case 'about_us':
                {
                    html = 'aboutUs.html';
                }
                break;
            case 'location':
                {
                    html = 'location.html';
                }
                break;
            case 'opening_hours':
                {
                    html = 'openingHours.html';
                }
                break;
            case 'testimonials':
                {
                    html = 'testimonials.html';
                }
                break;
            case 'contact_form':
                {
                    html = 'contactForm.html';
                }
                break;
            case 'barcode_scanner':
                {
                    html = 'barcodescanner.html';
                }
                break;
            case 'twitter':
                {
                    html = 'twitter.html';
                }
                break;
            case 'facebook':
                {
                    html = 'facebook.html';
                }
                break;
            case 'youtube':
                {
                    html = 'youtube.html';
                }
                break;
            case 'twitter(keyword)':
                {
                    html = 'twitter.html';
                }
                break;
            case 'rss_feeds':
                {
                    html = 'rss.html';
                }
                break;
            case 'web_page':
                {
                    html = 'web_page.html';
                }
                break;
            case 'contact_us':
                {
                    html = 'contactUs.html';
                }
                break;
            case 'photos':
                {
                    html = 'photos.html';
                }
                break;
            case 'content':
                {
                    // var articles = "<?= $model->articles; ?>";
                    html = 'content_new.html';
                }

                break;
            case 'staticpage':
            {
                // var articles = "<?= $model->articles; ?>";
                html = 'content_new.html';
            }

            	break;
            case 'notification':
                {
                    html = 'notification.html';
                }
                break;
        }

            var src = '<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/' + html;

            $('#myframe').attr('src', src);

//        }

        $('#showMobile').click(function() {

            if (titlename == 'facebook' || titlename == 'twitter(keyword)' || titlename == 'twitter' || titlename == 'youtube' || titlename == 'youtube(keyword)' || titlename == 'notification' || titlename == 'photo_gallery' || titlename == 'rss_feeds') {
                refresh_iframe();
            }

            var iframeObj = $('#myframe').contents();

            console.log(iframeObj.find('#optin_content').html() + " ON 2 CLICK");

            /********youtubeKEYWORD-BEGIN*********/

            if (html == 'youtubeKeywords.html' && $('#Module_keyword').val().trim() != '') {

                var iframeObj = $('#myframe').contents();

                $('#youtubeBackUp').empty();

                $('#youtubeBackUp').youTubeChannel({
                    userName: $('#Module_keyword').val(),
                    channel: "uploads",
                    hideAuthor: true,
                    numberToDisplay: 30,
                    linksInNewWindow: true



                }, "android");

                setTimeout(function() {

                    var a = $('#youtubeBackUp').html();

                    iframeObj.find('#youtubevideos').html(a);

                }, 500);

            }

            /*************youtubeKEYWORD-END*******************/

            /******************RSS-BEGIN***************/

            if (html == 'rss.html' && $('#Module_rss_feed_url').val().trim() != '') {

                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('application/getFeedContent'); ?>',
                    type: "POST",
                    data: {'feed': $('#Module_rss_feed_url').val()},
                    success: function(data) {

                        var iframeObj = $('#myframe').contents();

                        iframeObj.find('.ui-content').html(data);

                        iframeObj.find('img').css('max-width', '100%');

                        iframeObj.find('iframe').css('max-width', '100%');

                    }

                });

            }

        });

        /******************RSS-END***************/

        /********************Change Image - Begin**********************/

        $('#myframe').load(function() {

            var iframeObj = $('#myframe').contents();

            iframeObj.find('h1').html($('#Module_tab_title').val());

            iframeObj.find('.ui-btn-text').html($('#Module_tab_title').val());

            if ($('.change_icon_block_image_wrapper img').attr('src') != 'images/icons-png/icons_communication_1092.png')
                iframeObj.find('#tab2 .ui-icon').css('background', 'url("../../' + $('.change_icon_block_image_wrapper img').attr('src') + '")  50% 50% no-repeat');


        });

        /*******************Chaneg Image - End*****************/

        /*********Iframe-end******/

    }); /*document ready - end*/

    function refresh_iframe()
    {
        $('#myframe').attr('src', $('#myframe').attr('src'));

    }

</script>

<div style="display: none;" id="youtubeBackUp"></div>

<script type="text/javascript" src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/jquery.youtube.channel2.js"></script>

<script type="text/javascript" charset="utf-8" src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/video.js"></script>

<script type="text/javascript" src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/jquery/jfeed.js"></script>

