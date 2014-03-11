<?php
$this->renderPartial("app_menu", array('style' => $style));
?>

<div class="row">
    <h1 class="app_details_style">
        Select Modules <br/><span>Please select below the tabs you would like to
            include in your app.</span>
    </h1>
    <div class="span7">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'module-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
            ),
        ));
        ?>
        <fieldset>


            <div class="control-group">
                <div class="controls" style="margin-left: 0px;">
                    <?php
                    $app_type = $app_model->app_type;
                    $options1 = array(
                        'content' => 'Content		<p style="display:none;"> explanation here </p>',
                        'content2' => 'Content 2		<p style="display:none;"> explanation here </p>',
                        'content3' => 'Content 3		<p style="display:none;"> explanation here </p>',
                        'content4' => 'Content 4		<p style="display:none;"> explanation here </p>',
                        'about_us' => 'About Us		<p style="display:none;"> explanation here </p>',
                        'opening_hours' => 'Opening Hours	<p style="display:none;"> explanation here </p>',
                        'add_phone_number' => 'Add Phone Number	<p style="display:none;"> explanation here </p>',
                        'notification' => 'Enable Push Button Notification		<p style="display:none;"> explanation here </p>',
                        'location' => 'Location		<p style="display:none;"> explanation here </p>',
                        'facebook' => 'Facebook		<p style="display:none;"> Facebook explanation here </p>',
                        'twitter(keyword)' => 'Twitter		<p style="display:none;"> Twitter explanation here </p>',
                        'youtube(keyword)' => 'Youtube		<p style="display:none;"> Youtube explanation here </p>',
                        'photos' => 'Photos	<p style="display:none;"> Photo Search explanation here </p>',
                            //'rss_feeds' => 'RSS Feeds		<p style="display:none;"> RSS Feeds explanation here </p>',
                            //'testimonials' => 'Testimonials	<p style="display:none;"> explanation here </p>',
                            //'web_page' => 'Web Page		<p style="display:none;"> explanation here </p>',
                            //'barcode_scanner' => 'Barcode Scanner <p style="display:none;"> explanation here </p>',
                            //'coupons'				=>	'Coupons		<p style="display:none;"> explanation here </p>',
                    );
                    $options2 = array(
                        //'news(keyword)' => 'News (Keyword)		<p style="display:none;"> explanation here </p>',
                        //'events(keyword)' => 'Events (Keyword)	<p style="display:none;"> explanation here </p>',
                        'content' => 'Content		<p style="display:none;"> explanation here </p>',
                        'content2' => 'Content 2		<p style="display:none;"> explanation here </p>',
                        'content3' => 'Content 3		<p style="display:none;"> explanation here </p>',
                        'content4' => 'Content 4		<p style="display:none;"> explanation here </p>',
                        'rss_feeds' => 'RSS Feeds		<p style="display:none;"> RSS Feeds explanation here </p>',
                        'facebook' => 'Facebook			<p style="display:none;"> explanation here </p>',
                        'twitter(keyword)' => 'Twitter			<p style="display:none;"> explanation here </p>',
                        'youtube(keyword)' => 'Youtube			<p style="display:none;"> explanation here </p>',
                        'optin_form' => 'Optin Form		<p style="display:none;"> explanation here </p>',
                        'about_us' => 'About Us		<p style="display:none;"> explanation here </p>',
                        'notification' => 'Enable Push Button Notification		<p style="display:none;"> explanation here </p>',
                        'Admob' => 'Admob			<p style="display:none;"> explanation here </p>',
                        'reviews' => 'Reviews			<p style="display:none;"> explanation here </p>',
                            //'photoGallery(keyword)' => 'Photo Search		<p style="display:none;"> explanation here </p>',
                            //'local_news' => 'Local News			<p style="display:none;"> explanation here </p>',
                            //'local_events' => 'Local Events		<p style="display:none;"> explanation here </p>',
                            //'deals' => 'Deals				<p style="display:none;"> explanation here </p>',
                            //'notifications' => 'Notifications		<p style="display:none;"> explanation here </p>',
                    );
                    $options3 = array(
                        //'news(keyword)' => 'News (Keyword)		<p style="display:none;"> explanation here </p>',
                        //'events(keyword)' => 'Events (Keyword)	<p style="display:none;"> explanation here </p>',
                        'amazon_products' => 'Amazon Products		<p style="display:none;"> explanation here </p>',
                        'rss_feeds' => 'RSS Feeds		<p style="display:none;"> RSS Feeds explanation here </p>',
                        'facebook' => 'Facebook			<p style="display:none;"> explanation here </p>',
                        'twitter(keyword)' => 'Twitter			<p style="display:none;"> explanation here </p>',
                        'youtube(keyword)' => 'Youtube			<p style="display:none;"> explanation here </p>',
                        'optin_form' => 'Optin Form		<p style="display:none;"> explanation here </p>',
                        'about_us' => 'About Us		<p style="display:none;"> explanation here </p>',
                        'notification' => 'Enable Push Button Notification		<p style="display:none;"> explanation here </p>',
                        'Admob' => 'Admob			<p style="display:none;"> explanation here </p>',
                        'reviews' => 'Reviews			<p style="display:none;"> explanation here </p>',
                            //'photoGallery(keyword)' => 'Photo Search		<p style="display:none;"> explanation here </p>',
                            //'local_news' => 'Local News			<p style="display:none;"> explanation here </p>',
                            //'local_events' => 'Local Events		<p style="display:none;"> explanation here </p>',
                            //'deals' => 'Deals				<p style="display:none;"> explanation here </p>',
                            //'notifications' => 'Notifications		<p style="display:none;"> explanation here </p>',
                    );
                    if ($app_type == 1) {
                        $arr = $options1;
                    } else if ($app_type == 2) {
                        $arr = $options2;
                    } else if ($app_type == 3) {
                        $arr = $options3;
                    }
                    else
                        $arr = $options1;
                    $select_arr = array();
                    if (in_array('news(keyword)', $modules))
                        array_push($select_arr, 'news(keyword)');
                    if (in_array('events(keyword)', $modules))
                        array_push($select_arr, 'events(keyword)');
                    if (in_array('twitter(keyword)', $modules))
                        array_push($select_arr, 'twitter(keyword)');
                    if (in_array('youtube(keyword)', $modules))
                        array_push($select_arr, 'youtube(keyword)');
                    if (in_array('photoGallery(keyword)', $modules))
                        array_push($select_arr, 'photoGallery(keyword)');
                    if (in_array('local_news', $modules))
                        array_push($select_arr, 'local_news');
                    if (in_array('local_events', $modules))
                        array_push($select_arr, 'local_events');
                    if (in_array('deals', $modules))
                        array_push($select_arr, 'deals');
                    if (in_array('twitter', $modules))
                        array_push($select_arr, 'twitter');
                    if (in_array('facebook', $modules))
                        array_push($select_arr, 'facebook');
                    if (in_array('youtube', $modules))
                        array_push($select_arr, 'youtube');
                    if (in_array('rss_feeds', $modules))
                        array_push($select_arr, 'rss_feeds');
                    if (in_array('photo_gallery', $modules))
                        array_push($select_arr, 'photo_gallery');
                    if (in_array('about_us', $modules))
                        array_push($select_arr, 'about_us');
                    if (in_array('location', $modules))
                        array_push($select_arr, 'location');
                    if (in_array('opening_hours', $modules))
                        array_push($select_arr, 'opening_hours');
                    if (in_array('testimonials', $modules))
                        array_push($select_arr, 'testimonials');
                    if (in_array('web_page', $modules))
                        array_push($select_arr, 'web_page');
                    if (in_array('contact_us', $modules))
                        array_push($select_arr, 'contact_us');
                    if (in_array('barcode_scanner', $modules))
                        array_push($select_arr, 'barcode_scanner');
                    if (in_array('content', $modules))
                        array_push($select_arr, 'content');
                    if (in_array('photos', $modules))
                        array_push($select_arr, 'photos');
                    if (in_array('content2', $modules))
                        array_push($select_arr, 'content2');
                    if (in_array('content3', $modules))
                        array_push($select_arr, 'content3');
                    if (in_array('content4', $modules))
                        array_push($select_arr, 'content4');
                    if (in_array('notification', $modules))
                        array_push($select_arr, 'notification');
                    if (in_array('Admob', $modules))
                        array_push($select_arr, 'Admob');
                    if (in_array('optin_form', $modules))
                        array_push($select_arr, 'optin_form');




                    echo '<div class="builder-main" >';
                    $i = 0;

                    //var_dump($select_arr);die;
                    foreach ($arr as $key => $arrValue) {
                        if (in_array($key, $select_arr))
                            $checked = 'checked="checked"';
                        else
                            $checked = '';
                        if (($key == 'content2' || $key == 'content3' || $key == 'content4') && $checked == '')
                            $display = 'style="display: none"';
                        else
                            $display = '';
                        echo '<div class="feature-icons-box" ' . $display . ' >';
                        echo '<div class="feature-icon" ><img src="' . Yii::app()->theme->baseUrl . '/images/icon_new/' . $key . '.jpg" width="150" height="140" /></div>';
                        echo '<div class="feature-check" ><center>';

                        if ($key == 'content' || $key == 'content2' || $key == 'content3' || $key == 'content4') {
                            $a1 = '';
                            $a3 = '';
                            $a5 = '';
                            $a8 = '';


                            switch ($key) {
                                case 'content':
                                    $article = $articles[0];
                                    break;
                                case 'content2':
                                    $article = $articles[1];
                                    break;
                                case 'content3':
                                    $article = $articles[2];
                                    break;
                                case 'content4':
                                    $article = $articles[3];
                                    break;
                            }


                            switch ($article) {
                                case '1':
                                    $a1 = 'selected="selected"';
                                    break;
                                case '3':
                                    $a3 = 'selected="selected"';
                                    break;
                                case '5':
                                    $a5 = 'selected="selected"';
                                    break;
                                case '8':
                                    $a8 = 'selected="selected"';
                                    break;
                                default:
                                    $a3 = 'selected="selected"';
                            }
                            echo '
                        <select style="width: 80px;float: left;margin-top: -3px;"  name="Module[articles][]" >
                            <option value="1" ' . $a1 . ' >1</option>
                            <option value="3" ' . $a3 . ' >3</option>
                            <option value="5" ' . $a5 . ' >5</option>
                            <option value="8" ' . $a8 . ' >8</option>
                        </select>';
                            if ($key == 'content') {
                                echo '
                                <select style="width: 120px;float: left;position: relative;top: -169px;left: 12px;border-radius: 10px;outline: none;" id="contentCountChange" >
                                    <option value="0" disabled="disabled" selected="selected" >Content Count</option>
                                    <option value="1">1 Content</option>
                                    <option value="2">2 Content</option>
                                    <option value="3">3 Content</option>
                                    <option value="4">4 Content</option>
                                </select>';
                            }
                        }
                        echo '<input value="' . $key . '" type="checkbox"  id="Module_name_' . $i . '" ' . $checked . '  name="Module[name][]" ><label style="display:inline;" for="Module_name_' . $i . '">' . $arrValue . '</label></center></div>';
                        echo '</div>';
                        $i++;
                    }

                    echo '</div>';
                    ?>


                </div>

                <script type="text/javascript">
                    $(document).ready(function() {

                        /*******Content count change - Begin*******/
                        $('#contentCountChange').change(function() {

                            switch ($('#contentCountChange').val())
                            {
                                case '1':
                                    {
                                        $('input[value="content2"]').parent('center').parent('div').parent('div').hide();
                                        $('input[value="content2"]').removeAttr('checked', 'checked');
                                        $('input[value="content3"]').parent('center').parent('div').parent('div').hide();
                                        $('input[value="content3"]').removeAttr('checked', 'checked');
                                        $('input[value="content4"]').parent('center').parent('div').parent('div').hide();
                                        $('input[value="content4"]').removeAttr('checked', 'checked');
                                    }
                                    break;
                                case '2':
                                    {
                                        $('input[value="content2"]').parent('center').parent('div').parent('div').show();
                                        $('input[value="content3"]').parent('center').parent('div').parent('div').hide();
                                        $('input[value="content3"]').removeAttr('checked', 'checked');
                                        $('input[value="content4"]').parent('center').parent('div').parent('div').hide();
                                        $('input[value="content4"]').removeAttr('checked', 'checked');
                                    }
                                    break;
                                case '3':
                                    {
                                        $('input[value="content2"]').parent('center').parent('div').parent('div').show();
                                        $('input[value="content3"]').parent('center').parent('div').parent('div').show();
                                        $('input[value="content4"]').parent('center').parent('div').parent('div').hide();
                                        $('input[value="content4"]').removeAttr('checked', 'checked');
                                    }
                                    break;
                                case '4':
                                    {
                                        $('input[value="content2"]').parent('center').parent('div').parent('div').show();
                                        $('input[value="content3"]').parent('center').parent('div').parent('div').show();
                                        $('input[value="content4"]').parent('center').parent('div').parent('div').show();
                                    }
                                    break;
                            }

                        });
                        /*******Content count change - End*******/



                        $(".tooltip-selector").each(function() {
                            $(this).tooltip();
                            $(this).click(function() {
                                return false;
                            })
                        });
                    });
                    var webPageFields = 1;
                    var blogFeedsFields = 1;
                    var tieredFields = 1;

                    function addTieredCheckbox() {
                        tieredFields += 1;
                        if (tieredFields < 6) {
                            document.getElementById('tieredSection').innerHTML += '<label class="checkbox" for="tiered' + tieredFields + '"><input type="checkbox" id="tiered' + tieredFields + '" name="tiered' + tieredFields + '" value="1" ><a href="#" rel="tooltip" title="WYSIWYG page with multiple tiers" class="tooltip-selector">Tiered Pages</a></label>';
                        } else if (tieredFields == 6) {
                            document.getElementById('tieredSection').innerHTML += "<br />The maximum number of tiered tabs is 5.";
                            document.form.add.disabled = true;
                        }
                    }

                    function addWebPageCheckbox() {
                        webPageFields += 1;
                        if (webPageFields < 6) {
                            document.getElementById('webPageSection').innerHTML += '<label class="checkbox" for="webPage' + webPageFields + '"><input type="checkbox" id="webPage' + webPageFields + '" name="webPage' + webPageFields + '" value="1" ><a href="#" rel="tooltip" title="Link to any website" class="tooltip-selector">Web Page</a></label>';
                        } else if (webPageFields == 6) {
                            document.getElementById('webPageSection').innerHTML += "<br />The maximum number of webpage tabs is 5.";
                            document.form.add.disabled = true;
                        }
                    }

                    function addBlogFeedsCheckbox() {

                        blogFeedsFields += 1;
                        if (blogFeedsFields < 6) {
                            document.getElementById('blogFeedsSection').innerHTML += '<label class="checkbox" for="blogFeeds' + blogFeedsFields + '"><input type="checkbox" id="blogFeeds' + blogFeedsFields + '" name="blogFeeds' + blogFeedsFields + '" value="1" ><a href="#" rel="tooltip" title="Link to any website" class="tooltip-selector">RSS Feeds</a></label>';
                        } else if (blogFeedsFields == 6) {
                            document.getElementById('blogFeedsSection').innerHTML += "<br />The maximum number of RSS feeds tabs is 5.";
                            document.form.add.disabled = true;
                        }
                    }

                    function showhint(element) {
                        var tr = element.parentNode.parentNode;
                        var span = $('span', tr);
                        var p = $('p', tr);
                        span.html(p.html());
                        span.show();
                    }

                    function hidehint(element) {
                        var tr = element.parentNode.parentNode;
                        var span = $('span', tr);
                        span.hide();
                    }

                </script>

                <input type="hidden" id="submitted" name="submitted" value="1">
                <div class="form-actions continue_button" style="margin-left: -155px;">
                    <button type="submit" class="btn btn-primary btn-large">Save &amp;
                        Continue</button>
                    <!--  <button type="submit" class="btn btn-large">Cancel</button> -->
                </div>

            </div>

        </fieldset>
<?php $this->endWidget(); ?>
    </div>
</div>
