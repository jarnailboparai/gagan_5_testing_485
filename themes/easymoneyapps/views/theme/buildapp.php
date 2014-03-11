<?php
echo "<a href='?r=theme/mytestzip'>Create Zip</a>";
?>
<style>
.span5 {
    width: 380px;
}
[class*="span"] {
    float: left;
    margin-left: 20px;
}
img {
    border: 0 none;
    height: auto;
    max-width: 100%;
}

#myframe {
    height: 520px;
    left: 37px;
    position: relative;
    top: -665px !important;
    width: 298px;
}
</style>
<div class="span5">
        <div id="iphonePreview">
            <img width="395" height="722" src="/images/preview-handset.png"><br>
            
            <iframe src="/zipdir/<?php echo $model['name']; ?>" id="myframe" style="visibility: visible; "></iframe>
        </div>
</div>
