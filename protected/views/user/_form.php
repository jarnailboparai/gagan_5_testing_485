<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255,'value'=>'')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'repeat_password'); ?>
		<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>150,'value'=>'')); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'membership_type'); ?>
		<?php //echo $form->textField($model,'membership_type',array('size'=>7,'maxlength'=>7)); ?>
                <?php
                    if ($model->membership_type=='')
                        $model->membership_type='yearly';
                    $rad_arr = array(
                        'yearly'=>'<b>SkyBuilder One Year License</b> $997.00 for each one year<br><span class="small">A One Year Unlimited License for Access to SkyBuilder - Includes one Ticket to SkyBuilders LIVE!  (Best Value a %56 Savings)</span>',
                        'monthly'=>'<b>SkyBuilder Monthly License</b> $147.00 for each one month<br><span class="small">Pay per month - Cancel Anytime</span>'
                    );
                    echo $form->radioButtonList($model, 'membership_type', $rad_arr, array('separator'=>'<br />',
                            'labelOptions'=>array('style'=>'display:inline')
                        ));
                ?>
		<?php echo $form->error($model,'membership_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_system'); ?>
		<?php //echo $form->textField($model,'payment_system',array('size'=>8,'maxlength'=>8)); ?>
                <?php
                    if ($model->payment_system=='')
                        $model->payment_system = 'checkout';
                    $rad_arr = array(
                        'checkout'=>'<b>2Checkout</b><br><span class="small">Pay with a Credit Card</span>',
                        'paypal'=>'<b>PayPal</b><br><span class="small">Pay with your PayPal Account</span></label>'
                    );
                    echo $form->radioButtonList($model, 'payment_system', $rad_arr, array('separator'=>'<br />',
                            'labelOptions'=>array('style'=>'display:inline')
                        ));
                ?>
		<?php echo $form->error($model,'payment_system'); ?>
	</div>
        
        <div class="row">
            <span class="required">* </span>I Agree
            <?php echo $form->checkBox($model, 'iagree', array('checked'=>'checked', 'readonly'=>'true')); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
