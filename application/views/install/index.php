<div>
    <div class="page-header">
        <h2><?= lang('install.progress') ?> :</h2>
        
        <?= modules::run('progress/index', $steps, $step) ?>
    </div>
    <div class="error"></div>
    <div class="row-fluid" id="installContent">
        <?= $content ?>
    </div>
</div>
