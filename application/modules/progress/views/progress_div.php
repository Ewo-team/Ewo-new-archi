<div class="progress">
    <div class="bar" id="installProgress"
        style="width: <?= $progress ?>%;"></div>
</div>
<div class="row-fluid center-align" id="installProgressLabels">
<?php
    foreach($steps as $s => $step_txt){
        echo '<div class="span4"> <span class="label '.(($step > $s)
                                                ? ' label-success'
                                                : '').'">'.lang('install.steps.'.$step_txt).'</span></div>';
    }
?>
</div>