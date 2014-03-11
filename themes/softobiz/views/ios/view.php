
<div class="span11 span11_1">
<h1 style="font-size: 20px;" >Configure Apple Profile 
<br/>
<small class="headingstyle01" >To allow the creation of iOS apps, please complete the following steps. Full instructions on how to complete each of these steps can be viewed by clicking "Configure" on the relevant item below.</small></h1>

<table style="width: 100%;" >
    <thead>
      <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;">
    <th width="60%">Step</th><th width="20%">Status</th><th width="20%">Configure</th>
      </tr>
    </thead>
    <tbody>
            <tr>
                <?php
                    $status = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? 'icon-ok' : 'icon-remove';
                ?>
                <td>Developer Details</td><td><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo Yii::app()->createUrl('/ios/developerdetails'); ?>"><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>			
            <tr style="background-color:#eeeeee;" >
                <?php
                    $status = ($model->p12_file!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model->p12_file!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model->p12_file!='') ? 'icon-ok' : 'icon-remove';
                    $disabled = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? '' : 'disabled=""';
                    $url = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? Yii::app()->createUrl('/ios/distributioncertificate') : '#';
                ?>
                <td>Distribution Certificate</td><td><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo $url ?>" <?php echo $disabled; ?>><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>			
<!--            <tr>
            <td>Ad Hoc Provisioning Profile</td><td><a class="btn btn-small btn-danger" href="http://skybuilder.net/members/skycloud/iosSetup.php#"><i class="icon-remove icon-white"></i> INCOMPLETE</a></td><td>N/A</td><td><a class="btn btn-small btn-warning" href="http://skybuilder.net/members/skycloud/iosSetup.php#" disabled=""><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>			-->
            <tr>
                <?php
                    $status = ($model->store_provisioning_profile!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model->store_provisioning_profile!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model->store_provisioning_profile!='') ? 'icon-ok' : 'icon-remove';
                    $disabled = ($model->p12_file!='') ? '' : 'disabled=""';
                    $url = ($model->p12_file!='') ? Yii::app()->createUrl('/ios/StoreProvisioningProfile') : '#';
                ?>
                <td>App Store Provisioning Profile</td><td><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo $url; ?>" <?php echo $disabled; ?>><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>							        
    </tbody>
</table>

<h1 style="font-size: 20px;" >Configure Android Profile 
<br/>
<small class="headingstyle01">SOME TEXT.</small></h1>

<table style="width: 100%;" >
    <thead>
      <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;">
    <th width="60%">Step</th><th width="20%">Status</th><th width="20%">Configure</th>
      </tr>
    </thead>
    <tbody>
            <tr>
                <?php
                    $status = ($model_android->android_keystore_name!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model_android->android_keystore_name!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model_android->android_keystore_name!='') ? 'icon-ok' : 'icon-remove';
                ?>
                <td>Developer Details</td><td><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo Yii::app()->createUrl('/android/developerdetails'); ?>"><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>			
       
    </tbody>
</table></div>
