<div class="body_left">
  <div class="leftmenu">
    <ul>
      <li <?php if(isset($style['details'])) echo $style['details']; ?> >
          <?php echo CHtml::link('<span class="icon01"></span> App Title & Icon', array('application/details')); ?>
      </li>
      <li <?php if(isset($style['modules'])) echo $style['modules']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon02"></span> Select Features', array('application/modules')); ?>
      </li>
      <li <?php if(isset($style['customize_modules'])) echo $style['customize_modules']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon03"></span> Customize Features', array('application/customizeModules')); ?>
      </li>
      <li <?php if(isset($style['module_order'])) echo $style['module_order']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon04"></span> Features Order', array('application/moduleOrder')); ?>
      </li>
      <li <?php if(isset($style['splash'])) echo $style['splash']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon05"></span> App Splash Screen', array('application/splash')); ?>
      </li>
      <li <?php if(isset($style['final_preview'])) echo $style['final_preview']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon06"></span> Custom Interface', array('application/finalPreview')); ?>
      </li>
      <li <?php if(isset($style['build_app_selections'])) echo $style['build_app_selections']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon07"></span> Build App Selections', array('application/buildappselections')); ?>
      </li>
      <li <?php if(isset($style['build_app'])) echo $style['build_app']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon08"></span> Download App', array('application/buildApp')); ?>
      </li>
           <li <?php if(isset($style['build_app'])) echo $style['build_app']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('<span class="icon08"></span> Zip build ', array('application/mytestzip')); ?>
      </li>
    </ul>
  </div>
  </div>
