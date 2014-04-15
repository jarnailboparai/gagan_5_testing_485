<div class="container">
<div class="row-fluid manageapp">

<div class="form-signin aweber_form">

<!-- Testing area starts here -->
    <div class="tabbable tabs-left">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tbody><tr><td class="tab_list">
              <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:void(0)" data-toggle="tab">API Integration</a></li>
                 <!-- <li><a data-toggle="tab" href="#lC">Section 3</a></li>-->
              </ul>
              </td>
              <td>
              <div class="tab-content">
                <div class="tab-pane active" id="lA">
                <!-- form starts here -->
                <form class=" webform">
  <h4 class="form-signin-heading">AWeber</h4>
    <?php if(!count($model)){ ?>
    <div class="activation">
<!--     <a class="btn btn-success btn-large" href="#">ACTIVATION</a> -->
    <?php echo CHtml::link('ACTIVATION', CHtml::normalizeUrl(array('aweber/appverify')),array('class'=>'btn btn-success btn-large')); ?>
    
    </div>
    <?php }else{?>
  <div class="jordan_wrap">
  	<?php if($modelList) {?>
  	<?php 
  		//$htmlOptions =     array('size' => '1', 'prompt'=>'-- select list --','class'=>'pull-left' );
  		$htmlOptions = array('size'=>1,'class'=>'pull-left');
  		echo CHtml::listBox('slect',$model, $data, $htmlOptions); 
  	?>

  <?php echo CHtml::link('Refresh', CHtml::normalizeUrl(array('aweber/appverify')),array('class'=>'btn btn-primary pull-left')); ?>
  <div class="notification pull-left">Refresh to get updated list from AWeber</div>
  	<?php } else {?>
  	 Not any list form Aweber account find <br>
  	 Please Add List to your Aweber account Then click  <?php echo CHtml::link('Refresh', CHtml::normalizeUrl(array('aweber/appverify')),array('class'=>'btn btn-primary')); ?> here to get updated list  
  	<?php } ?>
  <div class="clearfix"></div>
  </div>
  <?php } ?>
</form>
                
                <!-- form ends here -->
                <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="lB">
               
                <form class="response">
  <h4 class="form-signin-heading">Tab2</h4>
  <div class="pushnotification">
   <label>Name</label>
    <input type="text" class="">
  </div>
  <div class="row-fluid">
    <div class="span12">
    <label>Email Address</label>
      <input type="text" class="">
   
   <label>Sender ID</label>
    <input type="text" class="">
     <label>Google API Key</label>
    <input type="text" class="">
 
       <label>Residential Address</label>
      <input type="text" class="">
   
    <a role="button" class="btn btn-success btn-lg">Submit</a><a role="button" class="btn btn-lg">Cancel</a> 
    </div>
 	 </div>
 
  
</form>
<div class="clearfix"></div>
                </div>
                <!--<div id="lC" class="tab-pane">
                  <p>What up girl, this is Section C.</p>
                </div>
              </div>
            </div>

<!-- Testing area ends here -->



<div class="clearfix"></div>
</div>
</td>
</tr>
</tbody></table>
</div>

<!-- Testing area ends here -->
</div>

</div>
</div>
