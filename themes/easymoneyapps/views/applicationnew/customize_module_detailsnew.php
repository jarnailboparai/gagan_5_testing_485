<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/easymoneyapps/css/customize_module_details.css">
<!-- <script src="<?= Yii::app()->request->baseUrl; ?>/ckeditor/ckeditor.js"></script> -->
<!--<script src="<?= Yii::app()->request->baseUrl; ?>/nicEdit/nicEdit.js"></script>-->
<!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> -->
<?php //$this->renderPartial("app_menu", array('style' => $style)); ?>
<script>
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
	        	popdetialHideOther(arg);
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
});
</script>
<div class="body_rightModal">

    <h1 class="app_details_style customH1">Customize Modules</h1>
    <div class="span6">
        <!--                <form class="form-horizontal" action="./Customize Module Detail_files/Customize Module Detail.htm" method="post" autocomplete="off" enctype="multipart/form-data">-->
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form',
        	//'action'=> 'index.php?r=applicationnew/customize_modules_details',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data',
            	'onsubmit' => 'return customizemodulenew();'
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
        $keyword_arr = array('news(keyword)', 'events(keyword)', 'twitter(keyword)', 'youtube(keyword)', 'photoGallery(keyword)');
        $username_arr = array('twitter', 'facebook', 'youtube');
        $rss_arr = array('rss_feeds');
        $photo_gallery_arr = array('photo_gallery',);
//      $content_arr = array('about_us', 'location', 'opening_hours', 'testimonials', 'contact_us');
        $content_arr = array('about_us', 'opening_hours', 'testimonials', 'contact_us');
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

            <?php if (in_array($model->name, $optin_form)) { ?>
                <?php
                if ($model->description != NULL)
                    $description = $model->description;
                else
                    $description = '';
                ?>
                <div class="control-group">
                    <label class="control-label">Script:</label>
                    <div class="controls">
                        <textarea id="editor1" style="width: 400px;height: 300px" cols="100"></textarea>
                        <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>
                        <div id="test" style="display: none" ><?= $description; ?></div>
                        <div id="backUpData" style="display: none" ></div>
                    </div>
                </div>
                <script>
                    var nicedt;
                    //<![CDATA[
                    bkLib.onDomLoaded(function() {
                        nicedt = new nicEditor({maxHeight: 300, fullPanel: true}).panelInstance('editor1');
                        nicedt.instanceById('editor1').setContent($('textarea[name="Module[description]"]').val());
                    });
                    //]]>
                    $(document).ready(function() {
                        /**************Ckeditor-begin*******************/
                        //                        CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/
                        //                        CKEDITOR.instances.editor1.setData($('textarea[name="Module[description]"]').val());

                        $('#showMobile').click(function() {
                            refresh_iframe();
                            setTimeout(function() {
                                var iframeObj = $('#myframe').contents();
                                if ($('#customizePreview').css('display') == 'none') {
                                    $('#customizePreview').slideDown('slow');

                                    iframeObj.find('#optin_content').html(nicedt.instanceById('editor1').getContent());
                                    //                                    iframeObj.find('#optin_content').html(CKEDITOR.instances.editor1.getData());
                                }
                                else {
                                    iframeObj.find('#optin_content').html(nicedt.instanceById('editor1').getContent());
                                    //                                    iframeObj.find('#optin_content').html(CKEDITOR.instances.editor1.getData());
                                }
                                $('textarea[name="Module[description]"]').val(iframeObj.find('#optin_content').html());
                            }, 500);

                        });
                    }); /****Document Ready - END****/
                </script>

            <?php } ?>

            <?php if (in_array($model->name, $location)) { ?>

                <?php
                if ($model->description != NULL)
                    $description = $model->description;
                else
                    $description = '';
                ?>
                <div class="control-group">
                    <label class="control-label">Your Business location :</label>
                    <div class="controls">
                        <textarea name="Module[description]" ><?= $description; ?></textarea>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        /**************Ckeditor-begin*******************/
                        // CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/
                        //CKEDITOR.instances.editor1.setData($('textarea[name="Module[description]"]').val());
                        $('#customizePreview').slideDown('slow');
                        $('#showMobile').click(function() {
                            var iframeObj = $('#myframe').contents();
                            if ($('#customizePreview').css('display') == 'none') {
                                $('#customizePreview').slideDown('slow');
                                iframeObj.find('#address').val($('textarea[name="Module[description]"]').val());
                            }
                            else {
                                iframeObj.find('#address').val($('textarea[name="Module[description]"]').val());
                            }
                            $('textarea[name="Module[description]"]').val(iframeObj.find('#address').val());
                            document.getElementById("myframe").contentWindow.addMarkerForAddress();
                        });
                    }); /****Document Ready - END****/
                </script>
            <?php } ?>
            <?php if (in_array($model->name, $admob)) { ?>
                <?php
                if (empty($model->description)) {
                    $module_file_admob = ModuleFile::model()->findByAttributes(array('title' => 'Admob'));
                    $model->description = $module_file_admob->content;
                }
                ?>
                <div class="control-group">
                    <label class="control-label">Script:</label>
                    <div class="controls">
                        <?php echo $form->textArea($model, 'description', array('class' => 'span5', 'rows' => 5)); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (in_array($model->name, $notification)) { ?>
                <div class="control-group">
                    <label class="control-label">Name:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'name', array('class' => 'span4')); ?>
                    </div>
                    <label class="control-label">Email:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'email', array('class' => 'span4')); ?>
                    </div>
                    <label class="control-label">Sender ID:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'sender_id', array('class' => 'span4')); ?>
                    </div>
                    <label class="control-label">Google API Key:</label>
                    <div class="controls">
                        <?php echo $form->textField($notificationModel, 'google_api_key', array('class' => 'span4')); ?>
                    </div>
                    <label class="control-label">Apn Production certificate:</label>
                    <div class="controls">
                        <?php echo $form->fileField($notificationModel, 'certification_push_pem_path', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                    </div>
                    <div style=" clear: both"></div>
                    <label class="control-label">Apn Mobile Provision certificate:</label>
                    <div class="controls">
                        <?php echo $form->fileField($notificationModel, 'apn_mobileprovision', array('class' => 'input-file', 'id' => 'uploadedFile')); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (in_array($model->name, $photos_arr)) { ?>
                <div class="control-group">


                    <?php
                    if ($model->description != NULL)
                        $description = $model->description;
                    else
                        $description = '';
                    ?>
                    <?php
                    if ($model->images != NULL)
                        $images = $model->images;
                    else
                        $images = '';
                    ?>

                    <?php echo $form->labelEx($model, 'images'); ?>
                    <?php
                    $this->widget('CMultiFileUpload', array(
                        'name' => 'images',
                        'accept' => 'jpg|png',
                        'max' => 30,
                        'remove' => Yii::t('ui', 'Remove'),
                        'denied' => 'type is not allowed', //message that is displayed when a file type is not allowed
                        'duplicate' => 'file appears twice', //message that is displayed when a file appears twice
                        'htmlOptions' => array('size' => 25),
                    ));
                    ?>
                    <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>
                    <textarea style="display: none" name="upload_url" ><?= $images; ?></textarea>
                </div>
                <script>

                    var onImageClick;

                    $(document).ready(function() {

                        var flag = true;
                        $('#showMobile').click(function() {
                            var iframeObj = $('#myframe').contents();
                            flag = false;
                            var formData = new FormData($('#module-form')[0]);
                            var URL = '<?php echo Yii::app()->getBaseUrl(true) ?>/index.php?r=applicationnew/mytest';
                            $.ajax({
                                type: 'POST',
                                async: false,
                                url: URL,
                                data: formData,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    console.log(data);
                                    $('input[name^=images]').MultiFile("reset");
                                    //setTimeout(function() {
                                    if (data.photo_html != '') {
                                        iframeObj.find('#Gallery').html(data.photo_html);
                                        $('textarea[name="upload_url"]').val(data.upload_url);
                                        $('textarea[name="Module[description]"]').val(data.photo_html);
                                        iframeObj.find(".image_click").bind('click', onImageClick);
                                    }
                                    //}, 500);
                                },
                                error: function(data) { // if error occured
                                    console.log(data);
                                    alert(data);

                                },
                            });
                        });
                        $('#myframe').load(function() {
                            var iframeObj = $('#myframe').contents();
                            iframeObj.find('#Gallery').html($('textarea[name="Module[description]"]').val());
                            $('#myframe').contents().find(".image_click").bind('click', onImageClick);



                        });


                    });

                    onImageClick = function() {
                        
                        var image_item = $(this);
                        var URL = '<?php echo Yii::app()->getBaseUrl(true) ?>/index.php?r=applicationnew/mytest';
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            data: {remove: image_item.children("img").attr("alt")},
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                if(data.result==true){
                                image_item.remove();
                                $('textarea[name="Module[description]"]').val($('#myframe').contents().find('#Gallery').html());}
                            },
                            error: function(data) { // if error occured
                                console.log(data);
                            }
                        });
                    };

                    /****Document Ready - END****/




                </script>
            <?php } ?>
            <?php if (in_array($model->name, $keyword_arr)) { ?>
                <div class="control-group">
                    <label class="control-label ctrl_style">Keyword </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'keyword', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (in_array($model->name, $username_arr)) { ?>
                <div class="control-group">
                    <label class="control-label">Username </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'username', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if (in_array($model->name, $rss_arr)) { ?>
                <div class="control-group">
                    <label class="control-label">RSS Feed URL </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'rss_feed_url', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (in_array($model->name, $photo_gallery_arr)) { ?>
                <div class="control-group">
                    <label class="control-label">Flickr ID </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'username', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (in_array($model->name, $web_page_arr)) { ?>
                <div class="control-group">
                    <label class="control-label">Page URL </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'web_page_url', array('class' => 'span4')); ?>
                        <label class="hint">http://www.yahoo.com</label>
                    </div>
                </div>
            <?php } ?>
            <?php if (in_array($model->name, $content_arr)) { ?>
                <div class="control-group">
                    <label class="control-label">Content </label>
                    <div class="controls">
                        <textarea id="editor1" name="Module[description]" style="width: 400px;height: 300px" cols="100"><?= $model->description ?></textarea>
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
            <?php if (in_array(substr($model->name, 0, 7), $content)) { //die("sdf")?>
                <?php
                $cnt_nav = '';
                $cnt_blk = '';
                for ($i = 1; $i <= $model->articles; $i++) {

                    $cnt_nav .= '<li  class="content_navigation_link"><a href="#article' . $i . '">Article ' . $i . '</a></li>';
//                    $cnt_nav .= '<div class="content_navigation_link"><h3><a href="#article' . $i . '">Article ' . $i . '</a></h3></div>';

                    $cnt_blk .= '<div class="content_block" id="article' . $i . '"></div>';
                }
                ?>
                <?php
                if ($model->description != NULL)
                    $description = $model->description;
                else
                    $description = '';
                ?>
                <div class="control-group">
                    <label class="control-label">Customize Page:</label>
                    <div class="controls">
                        <select id="selectPage" >
                            <option value="0" disabled="disabled" selected="selected" >Select Page</option>
                            <?php for ($i = 1; $i <= $model->articles; $i++): ?>
                                <option value="<?= $i; ?>">Article <?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <label class="control-label" id="changeArticleNameLabel" style="display: none" >Article Name:</label>
                    <div class="controls">
                        <input type="text" id="changeArticleName" style="width: 210px;border-radius: 3px;display: none" />
                    </div>
                    <label class="control-label">Content:</label>
                    <div class="controls">
                        <textarea id="editor1" style="width: 400px; height: 300px" cols="100"></textarea>
                        <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>
                        <div id="test" style="display: none" ><?= $description; ?></div>
                        <div id="backUpData" style="display: none" ></div>
                    </div>
                </div>               
                <script>

                    var nicedt;
                    var cnt_nav;
                    //<![CDATA[
                    //bkLib.onDomLoaded(function() {
                    //   nicedt = new nicEditor({maxHeight: 400, fullPanel: true}).panelInstance('editor1');
                    //});
                    function myBk(){
                    	    nicedt = new nicEditor({maxHeight: 400, fullPanel: true}).panelInstance('editor1');
                    //	    nicedt = new nicEditor.panelInstance('editor1');
                    }
                    myBk();
                    // window.onload(myBk());
                    //]]>
                    $(document).ready(function() {
                        /**************Ckeditor-begin*******************/
                        //                        CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/
                        var iframeObj = $('#myframe').contents();
                        var articles = "<?= $model->articles; ?>";
                        var i;
                        var refresh_Flag = true;
                        /************ARTICLE NAME KEYUP - Begin***********/
                        $('#changeArticleName').keyup(function() {
                            iframeObj = $('#myframe').contents();

                            iframeObj.find('a[href="#article' + $('#selectPage').val() + '"]').html($('#changeArticleName').val());
                            $(cnt_nav.get($('#selectPage').val() - 1)).find("a").text($('#changeArticleName').val());

                            $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                            if ($('#selectPage option').size() != 2)
                                $('#backUpData').find('.content_block').hide();
                            $('#backUpData').find('.content_navigation_link').removeClass('active');
                            $('#backUpData').find('#backMenu').hide();
                            $('#backUpData').find('#content_navigation_content').show();
                            if ($('#selectPage option').size() != 2)
                                $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                            else
                                $('textarea[name="Module[description]"]').val($('#backUpData').html());
                            $('#backUpData').empty();
                        });
                        /************ARTICLE NAME KEYUP - End*************/


                        /***********SHOW/SEND Click - Begin*****************/
                        $('#showMobile').click(function() {
                            iframeObj = $('#myframe').contents();
                            /**************Iframe SHOW - Begin***************/
                            if ($('#customizePreview').css('display') == 'none') {
                                if ($('textarea[name="Module[description]"]').val() != '') {
                                    for (i = 1; i <= articles; i++) {
                                        iframeObj.find('#article' + i).html($('#test').find('#article' + i).html());
                                        iframeObj.find('a[href="#article' + i + '"]').html($('#test').find('a[href="#article' + i + '"]').html());
                                    }
                                }
                                $('#customizePreview').slideDown('slow');
                            }
                            /*************Iframe SHOW - End*****************/
                            iframeObj = $('#myframe').contents();
                            var artNum = $('#selectPage').val();

                            iframeObj.find('#article' + artNum).html(nicedt.instanceById('editor1').getContent());

                            $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                            $('#backUpData').find('.content_navigation_link').removeClass('active');
                            $('textarea[name="Module[description]"]').val($('#backUpData').html());
                            $('#backUpData').empty();
                            $('#myframe').get(0).contentWindow.refreshListView();
                        });

                        /***********SHOW/SEND Click - End***********************/

                        /*************SELECT ARTICLE - Begin**************/
                        var selectPage;
                        $('#selectPage').change(function() {
                            //alert('sadf');
                            iframeObj = $('#myframe').contents();
                            selectPage = $(this).val();
							console.log('asdf');
                            console.log(selectPage);
                            setTimeout(function() {

                                //refresh_Flag = false;

                                /**************Iframe SHOW - Begin***************/
                                //alert(selectPage);
                                if ($('#customizePreview').css('display') == 'none') {

                                    if ($('textarea[name="Module[description]"]').val() != '') {
                                        for (i = 1; i <= articles; i++) {
                                            iframeObj.find('#article' + i).html($('#test').find('#article' + i).html());
                                            iframeObj.find('a[href="#article' + i + '"]').html($('#test').find('a[href="#article' + i + '"]').html());
                                        }
                                    }
                                    $('#customizePreview').slideDown('slow');
                                }

                                /*************Iframe SHOW - End**************/

                                /**********CHANGE ARTICLE NAME - Begin************/

                                if ($('#selectPage option').size() != 2) {
                                    $('#changeArticleName').val(iframeObj.find('a[href="#article' + selectPage + '"]').html());
                                    $('#changeArticleNameLabel').show();
                                    $('#changeArticleName').show();
                                }

                                /**********CHANGE ARTICLE NAME - End**************/

                                iframeObj.find('.content_navigation_link').removeClass('active');

                                iframeObj.find('a[href="#article' + selectPage + '"]').parent().parent().addClass('active');
                                nicedt.instanceById('editor1').setContent(iframeObj.find('#article' + selectPage).html());
                                //                                CKEDITOR.instances.editor1.setData(iframeObj.find('#article' + selectPage).html());
                            }, 350);

                            if (refresh_Flag) {
                                //                                if ($('#myframe').attr('src', $('#myframe').attr('src'))) {
                                //                                    refresh_Flag = false;
                                //                                    document.getElementById('myframe').contentDocument.location.reload(true);
                                //
                                //                                    console.log('fressh');
                                //                                }
                                refresh_Flag = false;
                                $('#myframe').get(0).contentWindow.refreshListView();
                                console.log('fressh');
                            }

                        });
                        $('.on_save').click(function() {
                            $('#myframe').contents().find('#content_navigation_content').html(cnt_nav);
                            $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                            $('textarea[name="Module[description]"]').val($('#backUpData').html());

                        });

                        /*************SELECT ARTICLE - End****************/

                        /*********Click ARTICLES In Iframe - Begin**********/

                        var linkCount;

                        $('#myframe').load(function() {

                            iframeObj = $('#myframe').contents();
                            cnt_nav = '<?php echo $cnt_nav; ?>';
                            var cnt_blk = '<?php echo $cnt_blk; ?>';

                            var articleNumber;
                            iframeObj.find('#content_navigation_content').html(cnt_nav);
                            cnt_nav = $(cnt_nav);
                            //                            iframeObj.find('#content_navigation_content').listview("refresh");
                            //console.log($('#myframe').attr('src'));
                            iframeObj.find('#content_blocks').html(cnt_blk);


                            var links = iframeObj.find('.content_navigation_link  a');

                            iframeObj.find('.content_navigation_link a').bind("click", function() {

                                iframeObj.find('#content_navigation_content').hide();
                                var str = $(this).attr('href');
                                var slic = str.substring(8, 10);
                                articleNumber = slic
                                iframeObj.find('.content_navigation_link').removeClass('active');
                                $(this).parent().parent().addClass('active');
                                iframeObj.find('#article' + articleNumber).show();

                            });

                            iframeObj.find('.backClick').bind("click", function() {
                                iframeObj.find('#content_navigation_content').show();
                                iframeObj.find('#article' + articleNumber).hide();
                                checkTotleCount();
                            });

                            //alert(iframeObj.find('div[data-role="content"]').html());
                            //console.log(iframeObj);

                            iframeObj.find('.content_navigation_link  a').click(function() {

                                /**********SEND ARTICLE NAME - Begin************/

                                $('#changeArticleName').val($(this).text());

                                /**********SEND ARTICLE NAME - End**************/

                                var str = $(this).attr('href');
                                var slic = str.substring(8, 10);

                                linkCount = slic;

                                $('#selectPage option').removeAttr('selected');

                                $('#selectPage option').eq(linkCount).attr('selected', 'selected');

                                nicedt.instanceById('editor1').setContent(iframeObj.find('#article' + linkCount).html());

                                //                                CKEDITOR.instances.editor1.setData(iframeObj.find('#article' + linkCount).html());

                            });
                            checkTotleCount();
                            function checkTotleCount() {
                                if (iframeObj.find('.content_navigation_link a').length == 1) {
                                    iframeObj.find('#content_navigation_content').hide();
                                    iframeObj.find('#article1').show();
                                }
                            }

                        });

                        /*********Click ARTICLES In Iframe - End************/


                    }); /****Document Ready - END****/


                </script>

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
            $('input[name="Module[tab_icon]"]').val($(this).attr('src'));
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
            case 'notification':
                {
                    html = 'notification.html';
                }
                break;
        }
//        var imagesModel = <?= $uploadedImages; ?>;
//        if (imagesModel == 1) {
//            $('#myframe').attr('src', '<?php
//if ($model->images != NULL) {
//    $a = explode('..', $model->images);
//    echo Yii::app()->baseUrl . $a[1];
//}
?>///photos_preview.html');
//        } else {
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





