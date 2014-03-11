<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>App Builder</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">

        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
        <style>
            body {
               /*  padding-top: 60px; 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements Noman -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php echo $content; ?>
    </body>
</html>
