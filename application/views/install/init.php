<div class="well" style="text-align:center;">
    <div class="form-inline">
        <?= form_label(lang('install.init.text'),'', array(
            'for' => 'language'
        )) ?> : 
        <?= modules::run('language_selector/display',array(
            'model' => $this->language_manager,
            'name'  => 'language',
            'id'    => 'language'
        )) ?>
        <?= form_button(array(
            'content'   => lang('interface.form.valid'),
            'class'     => 'btn',
            'onclick'   => 'installSelectLanguageInstall(\''.
                site_url(array('install/index', Index::$steps[Index::STEP_ANALYZE]))
                .'\', \'language\')')
        ) ?>
    </div>
</div>