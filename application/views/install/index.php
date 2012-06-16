<div>
    <div class="page-header">
        <h2><?= lang('install.progress') ?> :</h2>
        <div class="progress">
            <div class="bar" id="installProgress"
                style="width: <?= $progress ?>%;"></div>
        </div>
        <div class="row-fluid center-align">
            <div class="span4"><span class="label<?=
                                                    (($step > Index::STEP_ANALYZE)
                                                        ? ' label-success'
                                                        : ''
                )?>"><?= lang('install.steps.analyze')?></span></div>

            <div class="span4"><span class="label"><?= lang('install.steps.database')?></span></div>
            <div class="span4"><span class="label"><?= lang('install.steps.right')?></span></div>
        </div>
    </div>
    <div class="row-fluid" id="installContent">
        <?= $content ?>
    </div>
</div>
