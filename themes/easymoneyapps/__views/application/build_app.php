<?php
$this->renderPartial("app_menu", array('style' => $style));
?>

<div class="rorgerw" style="margin-left: 200px;width: 800px;" >
    <h1 class="app_details_style123">Build History</h1>
    <div>
        <table style="width: 780px;" >
            <thead>
                <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;" >
                    <th>Serial</th>
<!--		    <th>Device</th>-->
                    <th>Build Status</th>
                    <th>Compiled</th>
                    <th>Android</th>
                    <th>IOS</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $count = 0;
                //echo "<pre>"; print_r($apps); echo "</pre>";
                foreach ($apps as $application):
                    $count++;
                    $android_location = $application['android_link'];
                    $ios_location = $application['ios_link'];
                    ?>
                    <tr style="background-color:#eeeeee;" >
                        <td><?php echo $count; ?></td>
                        <td><div id="build-status">Android: <?=$application['android_status']?></br>iOS: <?=$application['ios_status']?></div><div><?php echo CHtml::link("Refresh", "index.php?r=application/buildapp", array('class' => 'btn btn-large btn-success'));?></td> 
                        <td><?php echo $application['time']; ?></td>
                        <td>
                            <?php
                            if ($android_location != '')
                                echo CHtml::link("DOWNLOAD", $android_location, array('class' => 'btn btn-large btn-success'));
                            else
                                echo CHtml::button('DOWNLOAD', array('class' => 'btn btn-large btn-inverse disabled', 'rel' => 'popover', 'data-content' => 'Please wait for 1 minute while the application is being build', 'data-original-title' => 'Wait for Approx 1 Minute'));
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($ios_location != '')
                                echo CHtml::link("DOWNLOAD", $ios_location, array('class' => 'btn btn-large btn-success'));
                            else
                                echo CHtml::button('DOWNLOAD', array('class' => 'btn btn-large btn-inverse disabled', 'rel' => 'popover', 'data-content' => 'Please wait for 1 minute while the application is being build', 'data-original-title' => 'Wait for Approx 1 Minute', 'title' => 'Please Complete your Apple Profile'));
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
