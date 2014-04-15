<?php $this->beginContent('/layouts/mainsob'); ?>




    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
   
            <div class="container">
            
            <div class="navbar navbar-inverse">
            
            
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo CHtml::normalizeUrl(array('applicationnew/dashboard'))?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/app_logo.png" /></a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
            <ul class="nav pull-right">
            <li><a href="https://www.facebook.com/groups/appgorilla" target="_blank"><span class="menu_fb"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/fb_icon.png" /></span>App Gorilla FB Group</a></li>
            <li><a href="<?php echo CHtml::normalizeUrl(array('applicationnew/dashboard'))?>">Manage Apps</a></li>
            <li class="active_menu"><a href="<?php echo CHtml::normalizeUrl(array('applicationnew/details','type' => 'new','app' => 'localBusiness')) ?>"><span class="create_app_icon">Create App</span></a></li>
            <li><a href="<?php echo CHtml::normalizeUrl(array('tutorial/index'))?>">Tutorials</a></li>
           	<li><a href="http://support.gorillaenterprise.com/hc/en-us/categories/200035822-App-Gorilla" target="_blank">Support</a></li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile<b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li><a href="#"><i class="icon-large icon-lock"></i>Change Password</a></li>
            <li><a href="#"><i class="icon-large icon-edit"></i>Edit account</a></li>
             <li><a href="<?php echo CHtml::normalizeUrl(array('aweber/index'))?>"><i class="icon-large  icon-plus"></i>Add API</a></li>
            <li class="divider"></li>
            
            <li><a href="<?php echo CHtml::normalizeUrl(array('/site/logout'))?>"><i class="icon-large icon-off"></i>Logout</a></li>
            </ul>
            </li>
            
            
            
            </ul>
            </div><!--/nav-collapse -->
            
            </div><!-- /navbar -->
            
            </div> 
            
                   
            
    </div>
    <!-- /navbar-wrapper -->

  

		<div class="container"> 
          <?php echo $content; ?>
        </div>
        <script>
        function submitFormMain(arg)
        {
        	var form = document.forms[arg];

        	$(form).submit();
        	console.log(arg);
        }
        /*	
        $(document).ready(function(){
        	$('.eeee').tooltip('hide');
        });
        */
        
        </script>
        <script type="text/javascript">
		var Accordion1 = new Spry.Widget.Accordion("Accordion1");
    </script>
      <!-- /END THE container -->

      <!-- FOOTER -->
      <footer>
        <div class="container">
  
        <p>&copy; Copyright 2013 - App Gorilla - All rights reserved.
</p>
        
        
        </div>
      </footer>
  <!-- FOOTER -->
  
   <!-- /container -->




<?php $this->endContent(); ?>
