<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="utf-8">
        <title>App Gozilla</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <!-- <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet"> -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <!--<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">-->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/stylesob.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/slider.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/accrodin.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fonts.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/select_content.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tempory.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/js/uploadifive/uploadifive.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
      <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/html5shiv.js"></script>
    <![endif]-->
        <?php
        //Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
        <script>window.themeurl = '<?php echo Yii::app()->theme->baseUrl; ?>';
        window.baseurl = '<?php echo Yii::app()->getBaseUrl(true); ?>';
        </script>
        <!-- Fav and touch icons-->

        <!-- <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/examples/favicon.ico"> -->
        <!--        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI4_1EiCrW3c3pzqq5fLLMQkD0EwwD9pc&sensor=false"> -->
        <!--     </script> -->
        <!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
        </head>

        <body>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script> 
<?php /*<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script> */ ?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-dropdown.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-tooltip.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-modal.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-transition.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-collapse.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-scrollspy.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/accordin.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/perfect-scrollbar.js"></script> 
<script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('.scroll').perfectScrollbar();
		$('.scroll2').perfectScrollbar();
		$('.scroll3').perfectScrollbar();
        /*$('#FastWheelSpeed').perfectScrollbar({wheelSpeed:100});
        $('#SlowWheelSpeed').perfectScrollbar({wheelSpeed:1});*/
      });
    </script> 
    
<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script> 

<!-- jquery scroller --> 

<!-- Jquery Scroller Ends Here --> 

<?php echo $content; ?> 
<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://apis.google.com/js/client.js"></script>
<div class="loading_content"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/loading_page.gif"> </div>

</body>
</html>
