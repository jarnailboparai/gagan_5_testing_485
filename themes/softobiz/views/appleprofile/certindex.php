<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<link href="<?php echo $pathurl; ?>/css/app_entries.css" rel="stylesheet" type="text/css" />

<?php echo CHtml::link(CHtml::encode("Create New"), array('certcreate'),array('class'=>'btn btn-info')); ?> 
<!-- container -->
<div class="container">
  <div class="row-fluid">
    <table cellpadding="0" cellspacing="0" border="0" class="app_entries table table-striped">
      <tr>
        <th>Sno</th>
        <th>Title</th>
        <th>Email</th>
        <th>App Name</th>
        <th>Details</th>
        <th>Actions</th>
      </tr>
      
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_certview',
)); ?>

    </table>
    <!-- 
    <div class="pagination pagination-centered">
              <ul>
                <li class="disabled"><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
             </ul>
      </div>
       -->
  </div>
</div>
