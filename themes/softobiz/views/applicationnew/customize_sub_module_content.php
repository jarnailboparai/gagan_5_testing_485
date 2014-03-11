<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/themes/easymoneyapps/css/customize_module_details.css">
<?php $url =  Yii::app()->getBaseUrl(true); ?>
<script type="text/javascript"  src="<?= $url ?>/js/nicEdit-latest.js"></script>

<?php echo $this->renderPartial("_submodulepage", array("model"=>$model,'data'=>$model,'flagC'=>$flagC)); ?>
