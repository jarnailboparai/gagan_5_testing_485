<?php $this->beginContent('/layouts/main'); ?>

<div id="wrapper1">
    <div id="header1"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_1.jpg" width="400" height="94" /></div>
    <div id="navigation1">
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                /*
                array('label' => 'Members Home', 'url' => array('/site/welcome')),
                array('label' => 'Training', 'url' => array('/site/training')),
                array('label' => 'App Home', 'url' => array('/application/home')),
                array('label' => 'Logout', 'url' => array('/site/logout')),
                 * 
                 */
                array('label' => 'Members Home', 'url' => array('/application/home')),
                array('label' => 'Manage Apps', 'url' => array('/application/dashboard')),
                array('label' => 'Profiles', 'url' => array('/ios/view')),
                array('label' => 'Niche', 'url' => array('application/details','type' => 'new','app' => 'niche')),
                array('label' => 'Local Business', 'url' => array('application/details','type' => 'new','app' => 'localBusiness')),
                array('label' => 'Support', 'url' => '/members/support'),
                array('label' => 'Logout', 'url' => array('/site/logout')),
            ),
        ));
        ?>
    </div>


    <div class="container-content">

        <?php echo $content; ?>

    </div>
</div>
<?php $this->endContent(); ?>
