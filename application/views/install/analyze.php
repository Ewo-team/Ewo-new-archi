<?=
form_open('', array(
    'class' => 'form-horizontal',
    'onsubmit' => 'return false;'
))
?>
    <div class="row-fluid">
        <div class="span10">
            <fieldset id=install_analyze_general">
                <legend><?= lang('install.analyze.section.general') ?> <i></i></legend>
                <div class="row-fluid control-group">
                    <div class="span6">     
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.base_url"><?= lang('install.analyze.base_url') ?></label>
                            <div class="controls">
                                <input type="text" name="install.analyze.base_url"  value="<?= site_url() ?>" placeholder="<?= lang('install.analyze.base_url.ph') ?>">
                            </div> 
                        </div>
                    </div>
                    <div class="span6">     
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.lang"><?= lang('install.analyze.lang') ?></label>
                            <div class="controls">
                                <?= modules::run('selector/display',array(
                                    'list'      => $this->language_manager->getAvailableLanguages(),
                                    'selected'  => $this->language_manager->getLanguage(),
                                    'name'      => 'install.analyze.lang',
                                    'id'        => 'install_analyze_lang'
                                )) ?>
                            </div> 
                        </div>
                    </span>
                </div>
            </fieldset>
            <fieldset id="install_analyze_db">
                <legend><?= lang('install.analyze.section.db') ?><i></i></legend>
                <div class="row-fluid control-group">
                    <div class="span6">
                        <label class="control-label" for="install.analyze.db.host"><?= lang('install.analyze.db.host') ?></label>
                        <div class="controls">
                            <input type="text" name="install.analyze.db.host" value="<?= $this->db->hostname ?>" placeholder="<?= lang('install.analyze.db.host.ph') ?>">
                        </div>  
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.db.username"><?= lang('install.analyze.db.username') ?></label>
                            <div class="controls">
                                <input type="text" name="install.analyze.db.username" value="<?= $this->db->username ?>" placeholder="<?= lang('install.analyze.db.username.ph') ?>">
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="row-fluid control-group">
                    <div class="span6">
                        <label class="control-label" for="install.analyze.db.password"><?= lang('install.analyze.db.password') ?></label>
                        <div class="controls">
                            <input type="password" name="install.analyze.db.password"  value="<?= $this->db->password ?>" placeholder="<?= lang('install.analyze.db.password.ph') ?>">
                        </div>  
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.db.base"><?= lang('install.analyze.db.base') ?></label>
                            <div class="controls">
                                <input type="text" name="install.analyze.db.base" value="<?= $this->db->database ?>" placeholder="<?= lang('install.analyze.db.base.ph') ?>">
                            </div>  
                        </div>
                    </div>
                </div>
            </fieldset>
            
            
        </div>
        <div class="span2" >
            <input id="check_progress" class="knob" data-skin="tron" data-ticks="<?= $nbStep ?>" data-displayInput="false"  value="0"  data-width="150" />
            <?=
                form_button(array(
                    'content'   => lang('interface.form.valid'),
                    'class'     => 'btn',
                    'onclick'   => 'launchAnalyze({
                        lang : \''.site_url(array('install','general','check_language')).'\',
                        db: \''.site_url(array('install','database','check_database_connection')).'\'
                    });'
                ))    //site_url(array('install','database','check_database'))
            ?>
        </div>
    </div>
    <div class="well center-align">
        <?= form_button(array(
            'content'   => lang('interface.nav.previous'),
            'class'     => 'btn',
            'onclick'   => anchor_intern_function(site_url(array('install/index', Index::$steps[Index::STEP_INIT])), '#installContent', 'installNav')
            ))
        ?>
        <?= form_button(array(
            'content'   => lang('interface.nav.next'),
            'class'     => 'btn',
            'onclick'   => anchor_intern_function(site_url(array('install/index', Index::$steps[Index::STEP_DB])), '#installContent', 'installNav')
            ))
        ?>
    </div>
<?= form_close() ?>

<?php 
    $this->layout->addOnload('$(".knob").knob();');
?>