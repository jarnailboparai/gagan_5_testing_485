<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/easymoneyapps/css/customize_module_details.css">
<script src="<?= Yii::app()->request->baseUrl; ?>/ckeditor/ckeditor.js"></script>


<?php
$this->renderPartial("app_menu");
?>


<div class="row" style="float: left;" >
    <h1 class="app_details_style customH1">Customize Modules</h1>
    <div class="span6">
        <!--                <form class="form-horizontal" action="./Customize Module Detail_files/Customize Module Detail.htm" method="post" autocomplete="off" enctype="multipart/form-data">-->
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'
            ),
        ));

        $module_info = ModuleFile::model()->findByAttributes(array('name' => $model->name));
        if ($model->tab_title == NULL)
            $title = $module_info->title;
        else
            $title = $model->tab_title;

        $keyword_arr = array('news(keyword)', 'events(keyword)', 'twitter(keyword)', 'youtube(keyword)', 'photoGallery(keyword)');
        $username_arr = array('twitter', 'facebook', 'youtube');
        $rss_arr = array('rss_feeds');
        $photo_gallery_arr = array('photo_gallery',);
        $content_arr = array('about_us', 'location', 'opening_hours', 'testimonials', 'contact_us');
        $web_page_arr = array('web_page');
        $photos_arr = array('photos');
        $content = array('content', 'content2', 'content3', 'content4');
        $notification = array('notification');
        $admob = array('Admob');
        $optin_form = array('optin_form');
        ?>
        <fieldset >
            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php endif; ?>


            <?php if (in_array($model->name, $optin_form)): ?>

                <?php
                if ($model->description != NULL)
                    $description = $model->description;
                else
                    $description = '';
                ?>

                <div class="control-group">
                    <label class="control-label">Script:</label>
                    <div class="controls">
                        <textarea id="editor1"></textarea>
                        <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>
                        <div id="test" style="display: none" ><?= $description; ?></div>
                        <div id="backUpData" style="display: none" ></div>
                    </div>

                </div>
                <script>
                    $(document).ready(function() {
                        /**************Ckeditor-begin*******************/
                        CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/
                        CKEDITOR.instances.editor1.setData($('textarea[name="Module[description]"]').val());
                        $('#showMobile').click(function() {
                            var iframeObj = $('#myframe').contents();
                            if ($('#customizePreview').css('display') == 'none') {
                                $('#customizePreview').slideDown('slow');
                                iframeObj.find('#optin_content').html(CKEDITOR.instances.editor1.getData());
                            }
                            else {
                                iframeObj.find('#optin_content').html(CKEDITOR.instances.editor1.getData());
                            }
                            $('textarea[name="Module[description]"]').val(iframeObj.find('#optin_content').html());

                        });
                    }); /****Document Ready - END****/
                </script>
            <?php endif; ?>



            <?php if (in_array($model->name, $admob)): ?>

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
            <?php endif; ?>

            <?php if (in_array($model->name, $notification)): ?>


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
                </div>




            <?php endif; ?>


            <?php if (in_array($model->name, $photos_arr)): ?>


                <div class="control-group">

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

                </div>

            <?php endif; ?>


            <?php if (in_array($model->name, $keyword_arr)): ?>
                <div class="control-group">
                    <label class="control-label ctrl_style">Keyword </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'keyword', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (in_array($model->name, $username_arr)): ?>
                <div class="control-group">
                    <label class="control-label">Username </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'username', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (in_array($model->name, $rss_arr)): ?>
                <div class="control-group">
                    <label class="control-label">RSS Feed URL </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'rss_feed_url', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (in_array($model->name, $photo_gallery_arr)): ?>
                <div class="control-group">
                    <label class="control-label">Flickr ID </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'username', array('class' => 'span4')); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (in_array($model->name, $web_page_arr)): ?>
                <div class="control-group">
                    <label class="control-label">Page URL </label>
                    <div class="controls">
                        <?php echo $form->textField($model, 'web_page_url', array('class' => 'span4')); ?>
                        <label class="hint">http://www.yahoo.com</label>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (in_array($model->name, $content_arr)): ?>
                <div class="control-group">
                    <label class="control-label">Content </label>
                    <div class="controls">
                        <textarea id="editor1" name="Module[description]" ></textarea>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {

                        /**************Ckeditor-begin*******************/
                        CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/

                        $('#showMobile').click(function() {
                            var iframeObj = $('#myframe').contents();
                            if ($('#customizePreview').css('display') == 'none') {
                                $('#customizePreview').slideDown('slow');
                                iframeObj.find('.ui-content').html(CKEDITOR.instances.editor1.getData());
                            }
                            else {
                                iframeObj.find('.ui-content').html(CKEDITOR.instances.editor1.getData());
                            }


                        });
                    });</script>
            <?php endif; ?>


            <?php if (in_array($model->name, $content)): ?>
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
                        <textarea id="editor1"></textarea>
                        <textarea style="display: none" name="Module[description]" ><?= $description; ?></textarea>
                        <div id="test" style="display: none" ><?= $description; ?></div>
                        <div id="backUpData" style="display: none" ></div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        /**************Ckeditor-begin*******************/
                        CKEDITOR.replace('editor1', {width: 400});
                        /****************Ckeditor-end*****************/
                        var iframeObj = $('#myframe').contents();
                        var articles = "<?= $model->articles; ?>";
                        var i;
                        /************ARTICLE NAME KEYUP - Begin***********/
                        $('#changeArticleName').keyup(function() {
                            iframeObj = $('#myframe').contents();
                            iframeObj.find('a[href="#article' + $('#selectPage').val() + '"]').html($('#changeArticleName').val());
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
                            switch ($('#selectPage').val())
                            {
                                case '1':
                                    {

                                        iframeObj.find('#article1').html(CKEDITOR.instances.editor1.getData());
                                        console.log(iframeObj.find('#article1').html());
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
                                    }
                                    break;
                                case '2':
                                    {
                                        iframeObj.find('#article2').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();

                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                                case '3':
                                    {
                                        iframeObj.find('#article3').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();


                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                                case '4':
                                    {
                                        iframeObj.find('#article4').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();


                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                                case '5':
                                    {
                                        iframeObj.find('#article5').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();


                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                                case '6':
                                    {
                                        iframeObj.find('#article6').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();


                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                                case '7':
                                    {
                                        iframeObj.find('#article7').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();


                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                                case '8':
                                    {
                                        iframeObj.find('#article8').html(CKEDITOR.instances.editor1.getData());
                                        $('#backUpData').html(iframeObj.find('div[data-role="content"]').html());
                                        //                                        $('#backUpData').find('.content_block').hide();
                                        $('#backUpData').find('.content_navigation_link').removeClass('active');
                                        //                                        $('#backUpData').find('#backMenu').hide();
                                        //                                        $('#backUpData').find('#content_navigation_content').show();


                                        $('textarea[name="Module[description]"]').val($('#backUpData').html() + '<script type="text/javascript" >' + iframeObj.find('div[data-role="content"] script').html() + '<\/script>');
                                        $('#backUpData').empty();
                                    }
                                    break;
                            }
                        });
                        /***********SHOW/SEND Click - End***********************/

                        /*************SELECT ARTICLE - Begin**************/
                        var selectPage;
                        $('#selectPage').change(function() {
                            iframeObj = $('#myframe').contents();
                            selectPage = $(this).val();
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
                            //                            iframeObj.find('#content_navigation_content').fadeIn(500);
                            //                            setTimeout(function() {
                            //                                iframeObj.find('#content_navigation_content').fadeOut(500);
                            //                            }, 500);
                            //                            iframeObj.find('#backMenu').fadeOut(500);
                            //                            setTimeout(function() {
                            //                                iframeObj.find('#backMenu').fadeIn(500);
                            //                            }, 500);
                            //
                            //                            iframeObj.find('.content_block').slideUp(450);
                            //                            setTimeout(function() {
                            //                                iframeObj.find('#article' + selectPage).slideDown(500);
                            //                            }, 500);

                            switch (selectPage)
                            {
                                case '1':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article1').html());
                                    }
                                    break;
                                case '2':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article2').html());
                                    }
                                    break;
                                case '3':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article3').html());
                                    }
                                    break;
                                case '4':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article4').html());
                                    }
                                    break;
                                case '5':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article5').html());
                                    }
                                    break;
                                case '6':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article6').html());
                                    }
                                    break;
                                case '7':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article7').html());
                                    }
                                    break;
                                case '8':
                                    {
                                        CKEDITOR.instances.editor1.setData(iframeObj.find('#article8').html());
                                    }
                                    break;
                            }

                        });
                        /*************SELECT ARTICLE - End****************/

                        /*********Click ARTICLES In Iframe - Begin**********/
                        var linkCount;
                        $('#myframe').load(function() {
                            iframeObj = $('#myframe').contents();
                            iframeObj.find('.content_navigation_link h3 a').click(function() {

                                /**********SEND ARTICLE NAME - Begin************/
                                $('#changeArticleName').val($(this).text());
                                /**********SEND ARTICLE NAME - End**************/

                                linkCount = $(this).attr('href').slice(-1);
                                $('#selectPage option').removeAttr('selected');
                                $('#selectPage option').eq(linkCount).attr('selected', 'selected');
                                switch (linkCount)
                                {
                                    case '1':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article1').html());
                                        }
                                        break;
                                    case '2':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article2').html());
                                        }
                                        break;
                                    case '3':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article3').html());
                                        }
                                        break;
                                    case '4':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article4').html());
                                        }
                                        break;
                                    case '5':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article5').html());
                                        }
                                        break;
                                    case '6':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article6').html());
                                        }
                                        break;
                                    case '7':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article7').html());
                                        }
                                        break;
                                    case '8':
                                        {
                                            CKEDITOR.instances.editor1.setData(iframeObj.find('#article8').html());
                                        }
                                        break;
                                }

                            });
                        });
                        /*********Click ARTICLES In Iframe - End************/

                    }); /****Document Ready - END****/
                </script>
            <?php endif; ?>
            <?php if (!in_array($model->name, $admob)): ?>
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
                                    <li class="black_icons">Black Icons</li>
                                    <li class="white_icons">White Icons</li>
                                </ul>
                                <ul class="change_icon_block_tabs_content">
                                    <li id="grey_icons" class="current_tab_content">
                                        <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/icons_communication_1092.png" /></span>
                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/grey/icon(<?= $i; ?>).png" /></span>
                                        <?php } ?>
                                    </li>
                                    <li id="black_icons">
                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/black/icon(<?= $i; ?>).png" /></span>
                                        <?php } ?>
                                    </li>
                                    <li id="white_icons">
                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                            <span><img src="<?php Yii::getPathOfAlias('webroot'); ?>images/icons-png/white/icon(<?= $i; ?>).png" /></span>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="btn btn-primary3 btn-large" id="showMobile" >Send/Show</div>
                </div>

            <?php endif; ?>
            <div style="clear:both"></div>
            <input type="hidden" name="submitted" value="1">
            <div class="form-actions">
                <?php echo CHtml::submitButton('Save & Reload', array('class' => 'btn btn-primary btn-large', 'style' => 'float: left;margin-left: 35%;')); ?>
                <?php echo CHtml::link('Return to Tab List', array('/application/customizemodules'), array('class' => 'btn btn-large btn_radius btn-primary4')); ?>
            </div>
        </fieldset>

        <?php $this->endWidget(); ?>
    </div>
</div>

<div id="customizePreview" style="display: none;" >
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/preview-handset.png" width="395" height="722" /><br>
    <iframe id="myframe" class="iframe2" style="top:-692px !important;" src=""></iframe>
</div>

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

        var titlename = "<?= $model->name; ?>";
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
                    var articles = "<?= $model->articles; ?>";
                    html = 'content_' + articles + '.html';
                }
                break;
            case 'content2':
                {
                    var articles = "<?= $model->articles; ?>";
                    html = 'content_' + articles + '.html';
                }
                break;
            case 'content3':
                {
                    var articles = "<?= $model->articles; ?>";
                    html = 'content_' + articles + '.html';
                }
                break;
            case 'content4':
                {
                    var articles = "<?= $model->articles; ?>";
                    html = 'content_' + articles + '.html';
                }
                break;
            case 'notification':
                {
                    html = 'notification.html';
                }
                break;
        }

        var imagesModel = <?= $uploadedImages; ?>;
        if (imagesModel == 1) {
            $('#myframe').attr('src', '<?php
        if ($model->images != NULL) {
            $a = explode('..', $model->images);
            echo Yii::app()->baseUrl . $a[1];
        }
        ?>/photos_preview.html');
        } else {
            $('#myframe').attr('src', '<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/' + html);
        }

        $('#showMobile').click(function() {
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

</script>
<div style="display: none;" id="youtubeBackUp"></div>

<script type="text/javascript" src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/jquery.youtube.channel2.js"></script>
<script type="text/javascript" charset="utf-8" src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/video.js"></script>
<script type="text/javascript" src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/jquery/jfeed.js"></script>


