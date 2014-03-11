
<section>
    <div class="row" style="width:799px; margin: 0 auto;">
        <div class="manage_your" >Manage Your Apps:</div>
        <div class="span11 span11_1">
            <strong>LOCAL BUSINESS APPS:</strong>
            <table width="800" align="center">
                <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;">
                    <td width="300" align="center">APP NAME</td>
                    <td>CONTROLS</td>
                </tr>
                <?php
                $i = 0;
                foreach ($model as $obj):
                    $m = $obj['attributes'];
                    ?>
                    <?php if ($m['app_type'] == 1) {
                        $i++;
                        $localbusiness = true; ?>
                        <tr <?php if ($i % 2 == 0) echo 'style="background-color:#eeeeee;"'; ?> >
                            <td width="300"><?php echo $m['title']; ?></td>
                            <td><a href="<?php echo Yii::app()->createUrl('/applicationnew/details', array('app_id' => $m['id'])); ?>" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/edit-button.png" width="66" height="28" /></a>
                                <a href="<?php echo Yii::app()->createUrl('/applicationnew/finalPreview', array('app_id' => $m['id'])); ?>" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/preview-button.png" width="100" height="28" /></a>
                                <a href="<?php echo Yii::app()->createUrl('/notification/index', array('app_id' => $m['id'])); ?>" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/push-button.png" width="139" height="28" /></a>
                                <a href="javascript:void(0);" onclick="delete_app('<?php echo Yii::app()->createUrl('/applicationnew/delete', array('app_id' => $m['id'])); ?>');"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/delete-button.png" width="87" height="28" /></a>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                endforeach;
                ?>

<?php if (count($model) == 0 || !isset($localbusiness)): ?>
                    <tr>
                        <td colspan="2">No Application Found</td>
                    </tr>
<?php endif; ?>

            </table>

            <br />

            <strong>NICHE APPS:</strong>
            <table width="800">
                <tr style="font-size:12px; border-bottom:2px solid #666; background-color:#666; color:#FFF;">
                    <td width="300">APP NAME</td>
                    <td>CONTROLS</td>
                </tr>
                <?php
                $i = 0;
                foreach ($model as $obj):
                    $m = $obj['attributes'];
                    ?>
    <?php if ($m['app_type'] == 2) {
        $i++;
        $niche = true; ?>
                        <tr <?php if ($i % 2 == 0) echo 'style="background-color:#eeeeee;"'; ?> >
                            <td width="300"><?php echo $m['title']; ?></td>
                            <td><a href="<?php echo Yii::app()->createUrl('/applicationnew/details', array('app_id' => $m['id'])); ?>" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/edit-button.png" width="66" height="28" /></a>
                                <a href="<?php echo Yii::app()->createUrl('/applicationnew/finalPreview', array('app_id' => $m['id'])); ?>" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/preview-button.png" width="100" height="28" /></a>
                                <a href="<?php echo Yii::app()->createUrl('/notification/index', array('app_id' => $m['id'])); ?>" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/push-button.png" width="139" height="28" /></a>

                                <a href="javascript:void(0);" onclick="delete_app('<?php echo Yii::app()->createUrl('/applicationnew/delete', array('app_id' => $m['id'])); ?>');"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/delete-button.png" width="87" height="28" /></a>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                endforeach;
                ?>

                <?php if (count($model) == 0 || !isset($niche)): ?>
                    <tr>
                        <td colspan="2">No Application Found</td>
                    </tr>
<?php endif; ?>

            </table>

        </div>
    </div>
</section>
<section>
    <div class="pagination pagination-right">
        <ul>

        </ul>
    </div>
</section>
<?php $del_url = Yii::app()->createUrl('/applicationnew/delete', array('app_id' => $m['id']));
?>
<script type="text/javascript">
                                    function delete_app(del_url)
                                    {
                                        var x = window.confirm("Are you sure you want to delete this record?");
                                        if (x)
                                            window.location = del_url;

                                    }
</script>
