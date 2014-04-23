
<div class="app_number">
	<div class="msg">
		<?php if(Yii::app()->user->hasFlash('success')):?>
		    <div class="info alert alert-success fade in">
		        <?php echo Yii::app()->user->getFlash('success'); ?><button class="close" data-dismiss="alert" type="button">×</button>
		    </div>
		<?php endif; ?>
	</div>
	<div class="btn-group pull-left navbottom <?php echo $data['tabselect']; ?>">
		
		<a href="<?php echo CHtml::normalizeUrl(array('appsetting/appinfo','id'=>$id))?>">	
			<button class="btn app_info">
				<span>App Info</span>
			</button>
		</a>
		
		<a href="<?php echo CHtml::normalizeUrl(array('appsetting/apptheme','id'=>$id))?>">	
		<button class="btn look">
			<span>Look & Feel</span>
		</button>
		</a>
		
		<a href="<?php echo CHtml::normalizeUrl(array('applicationnew/listfeatures'))?>">	
		<button class="btn list">
			<i class="icon-th-list"></i><span> List Features</span>
		</button>
		</a>
	
	</div>

</div>
<script>
	$(".msg .alert").delay(4000).slideUp("slow");
</script>
