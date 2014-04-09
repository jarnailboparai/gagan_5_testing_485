 <?php $pathurl = Yii::app()->theme->baseUrl;  ?>
 <link href="<?php echo $pathurl; ?>/css/colorpicker/gradX.css" rel="stylesheet" type="text/css" /> 
 <link href="<?php echo $pathurl; ?>/css/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo $pathurl; ?>/js/colorpicker/colorpicker.js" type="text/javascript"></script>
 <script src="<?php echo $pathurl; ?>/js/colorpicker/dom-drag.js" type="text/javascript"></script>
 <script src="<?php echo $pathurl; ?>/js/colorpicker/gradX.js" type="text/javascript"></script>
 
        <table width="100%" cellpadding="0" cellspacing="0" class="colorpicker_table">
  <tr>
  <td>
  <div id="gradX" ></div></td>
<td>
        <div class="targets">
            
            <div class="target" id="target2"><div class="target_text">Target #2</div></div>

        </div>
</td>
</tr>
<tr>
<td colspan="2">
<div class="color_save"><a href="#" class="btn btn-success" onclick="save_bgcolor()">Save Backcolor</a>
<a href="#" class="btn" onclick="bg_color_cancel(<?php echo $flag;?>,<?php echo $module_id;?>)">Back to Theme Settings</a>


</div>
</td>
</tr>
</table>
        <script>

            gradX("#gradX", {
                targets: [".target"],
				sliders: [
						   {
						     color: "#000",
						     position: 1
						   },
						   {
						     color: "#000",
						     position: 80
						   }
 						 ]
          		  });
			

        </script>

 
