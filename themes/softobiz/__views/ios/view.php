<h1 style="font-size: 20px;" >Configure Apple Profile 
<br/>
<small style="font-size: 15px;" >To allow the creation of iOS apps, please complete the following steps. Full instructions on how to complete each of these steps can be viewed by clicking "Configure" on the relevant item below.</small></h1>

<table style="width: 700px;" >
    <thead>
      <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;">
    <th>Step</th><th>Status</th><th>Configure</th>
      </tr>
    </thead>
    <tbody>
            <tr>
                <?php
                    $status = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? 'icon-ok' : 'icon-remove';
                ?>
                <td>Developer Details</td><td><a style="color: #CC9933;text-decoration: none;" href="#"><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></a></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo Yii::app()->createUrl('/ios/developerdetails'); ?>"><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>			
            <tr style="background-color:#eeeeee;" >
                <?php
                    $status = ($model->p12_file!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model->p12_file!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model->p12_file!='') ? 'icon-ok' : 'icon-remove';
                    $disabled = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? '' : 'disabled=""';
                    $url = ($model->apple_email!='' && $model->phone_gap_key_title!='') ? Yii::app()->createUrl('/ios/distributioncertificate') : '#';
                ?>
                <td>Distribution Certificate</td><td><a style="color: #CC9933;text-decoration: none;" href="#" rel="tooltip" data-original-title="Please check the Developer&#39;s Name in previous step and follow instructions again."><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></a></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo $url ?>" <?php echo $disabled; ?>><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
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
                <td>App Store Provisioning Profile</td><td><a style="color: #CC9933;text-decoration: none;" href="#"><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></a></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo $url; ?>" <?php echo $disabled; ?>><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>							        
    </tbody>
</table>

<h1 style="font-size: 20px;" >Configure Android Profile 
<br/>
<small style="font-size: 15px;" >SOME TEXT.</small></h1>

<table style="width: 700px;" >
    <thead>
      <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;">
    <th>Step</th><th>Status</th><th>Configure</th>
      </tr>
    </thead>
    <tbody>
            <tr>
                <?php
                    $status = ($model_android->android_keystore_name!='') ? 'COMPLETE' : 'INCOMPLETE';
                    $btn = ($model_android->android_keystore_name!='') ? 'btn-success' : 'btn-danger';
                    $icon = ($model_android->android_keystore_name!='') ? 'icon-ok' : 'icon-remove';
                ?>
                <td>Developer Details</td><td><a style="color: #CC9933;text-decoration: none;" href="#"><i class="<?php echo $icon; ?> icon-white"></i> <?php echo $status; ?></a></td><td><a style="color: #CC9933;text-decoration: none;" href="<?php echo Yii::app()->createUrl('/android/developerdetails'); ?>"><i class="icon-edit icon-white"></i> CONFIGURE</a></td>
            </tr>			
       
    </tbody>
</table>
