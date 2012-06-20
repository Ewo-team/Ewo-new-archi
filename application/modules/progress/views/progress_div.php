<div class="progress">
    <div class="bar" id="installProgress"
        style="width: <?= $progress ?>%;"></div>
</div>
<div class="row-fluid center-align" id="installProgressLabels">
<?php
    foreach($steps as $s => $step_txt){
        $addClass = '';
        if($step > $s)
            $addClass = ' label-success';
        else if($step == $s)
            $addClass = ' label-info';
        echo '<div class="span3"> <span class="label'.$addClass.'">'.lang('install.steps.'.$step_txt).'</span></div>';
    }
?>
</div>