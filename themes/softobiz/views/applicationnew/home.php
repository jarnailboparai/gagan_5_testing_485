<div class="middlebox">

    <div style="width:660px; height:480px; float:left; padding-top:30px;"><img src="<?= Yii::app()->theme->baseUrl; ?>/images/into-video-placeholder.jpg" width="640" height="480" /></div>

    <div style="width:280px; height:480px; float:left; padding-top:30px;">

        <div style="height:105px;"><?php echo CHtml::link('<img src="' . Yii::app()->theme->baseUrl . '/images/manage-button.jpg" width="280" height="90" border="0" />', array('application/dashboard')); ?></div>

        <div style="height:105px;"><?php echo CHtml::link('<img src="' . Yii::app()->theme->baseUrl . '/images/local-button.jpg" width="280" height="90" border="0" />', array('application/details','type' => 'new','app' => 'localBusiness')); ?></div>

        <div style="height:105px;"><?php echo CHtml::link('<img src="' . Yii::app()->theme->baseUrl . '/images/niche-button.jpg" width="280" height="90" border="0" />', array('application/details','type' => 'new','app' => 'niche')); ?></div>

<!--        Removed On clint request. 

<div style="height:105px;"><?php //echo CHtml::link('<img src="' . Yii::app()->theme->baseUrl . '/images/amazon-button.jpg" width="280" height="90" border="0" />', array('application/details','type' => 'new','app' => 'amazon')); ?></div>-->

    </div>

</div>
