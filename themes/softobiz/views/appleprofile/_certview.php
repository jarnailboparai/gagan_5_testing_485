      <tr>
        <td class="sno"><?php echo CHtml::encode($data->id); //echo CHtml::link(CHtml::encode($data->id), array('certview', 'id'=>$data->id)); ?></td>
        <td><?php echo CHtml::encode($data->phone_gap_key_title); ?></td>
        <td><?php echo CHtml::encode($data->apple_email); ?></td>
        <td><?php if(count($data->applicationprofile))  
        			echo CHtml::encode($data->applicationprofile->title);
        		
         ?></td>
        <td class="details">
<!--         	<a href="#" class="btn btn-info">Details</a> -->
        	<?php echo CHtml::link(CHtml::encode("Detalis"), array('certview', 'id'=>$data->id),array('class'=>'btn btn-info')); ?>
        </td>
        <td class="entry_actions"><div class="btn-group">
            <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><?php echo CHtml::link(CHtml::encode("Edit"), array('certupdate', 'id'=>$data->id)); ?></li>
              <li><?php echo CHtml::link(CHtml::encode("Delete"), array('certview', 'id'=>$data->id)); ?></li>
            </ul>
          </div></td>
      </tr>
