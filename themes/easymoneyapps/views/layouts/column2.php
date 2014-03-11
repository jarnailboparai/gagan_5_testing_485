<?php $this->beginContent('/layouts/main'); ?>

<div class="wrapper">
 <div class="headerWrapper">
 <div class="logo"><a href="#"></a></div>
  <div class="menu">      
		<?php 
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                /*
                array('label' => 'App Home', 'url' => array('/application/home')),
                array('label' => 'Profiles', 'url' => array('/ios/view')),
                array('label' => 'Member Dashboard', 'url' => array('/site/welcome')),
                array('label' => 'Logout', 'url' => array('/site/logout')),                                
                */
                
                array('label' => 'Members Home', 'url' => '/members'),
                array('label' => 'Manage Apps', 'url' => array('/application/dashboard')),
                array('label' => 'Profiles', 'url' => array('/ios/view')),
                array('label' => 'Niche', 'url' => array('application/details','type' => 'new','app' => 'niche')),
                array('label' => 'Local Business', 'url' => array('application/details','type' => 'new','app' => 'localBusiness')),
                array('label' => 'Support', 'url' => '/members/forum'),
                array('label' => 'Logout', 'url' => array('/site/logout')),
                
            ),
        ));
        ?>
  </div>
</div>
<div class="body_con">
		
		<?php echo $content; ?>
	   	
    </div>
 </div>
<?php $this->endContent(); ?>
