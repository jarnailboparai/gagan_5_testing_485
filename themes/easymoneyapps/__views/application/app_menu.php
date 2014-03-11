  <div id="builder-nav">
    <ul>
      <li <?php if(isset($style['details'])) echo $style['details']; ?> >
          <?php echo CHtml::link('App Title & Icon', array('application/details')); ?>
      </li>
      <li <?php if(isset($style['modules'])) echo $style['modules']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('Select Features', array('application/modules')); ?>
      </li>
      <li <?php if(isset($style['customize_modules'])) echo $style['customize_modules']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('Customize Features', array('application/customizeModules')); ?>
      </li>
      <li <?php if(isset($style['module_order'])) echo $style['module_order']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('Features Order', array('application/moduleOrder')); ?>
      </li>
      <li <?php if(isset($style['splash'])) echo $style['splash']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('App Splash Screen', array('application/splash')); ?>
      </li>
      <li <?php if(isset($style['final_preview'])) echo $style['final_preview']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('Custom Interface', array('application/finalPreview')); ?>
      </li>
      <li <?php if(isset($style['build_app_selections'])) echo $style['build_app_selections']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('Build App Selections', array('application/buildappselections')); ?>
      </li>
      <li <?php if(isset($style['build_app'])) echo $style['build_app']; ?> <?php if(isset($disabled)) echo $disabled; ?> >
          <?php echo CHtml::link('Download App', array('application/buildApp')); ?>
      </li>
    </ul>
  </div>
