<h1 class="centered"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/cloud-header.png"></h1>
		
<h1 class="centered">
<!--    <a href="skycloud" target="_blank">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/cloud-button.png">
    </a>-->
    <?php
        echo CHtml::link(
                CHtml::image(Yii::app()->theme->baseUrl.'/images/cloud-button.png'),
                array('/application/dashboard'),
                array('target'=>'_blank')
        );
    ?>
</h1>
