<?=
form_open('', array(
    'class' => 'form-horizontal',
    'onsubmit' => 'return false;'
))
?>
    <div class="row-fluid">
        <div class="span10">
            <fieldset>
                <legend><?= lang('install.analyze.section.url') ?></legend>
                <div class="control-group">
                    <label class="control-label" for="install.analyze.base_url"><?= lang('install.analyze.base_url') ?></label>
                    <div class="controls">
                        <input type="text" name="install.analyze.base_url"  value="<?= site_url() ?>" placeholder="<?= lang('install.analyze.base_url.ph') ?>">
                    </div>  
                </div>
            </fieldset>
            <fieldset>
                <legend><?= lang('install.analyze.section.db') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.db.host"><?= lang('install.analyze.db.host') ?></label>
                            <div class="controls">
                                <input type="text" name="install.analyze.db.host" value="<?= $this->db->hostname ?>" placeholder="<?= lang('install.analyze.db.host.ph') ?>">
                            </div>  
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.db.username"><?= lang('install.analyze.db.username') ?></label>
                            <div class="controls">
                                <input type="text" name="install.analyze.db.username" value="<?= $this->db->username ?>" placeholder="<?= lang('install.analyze.db.username.ph') ?>">
                            </div>  
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.db.password"><?= lang('install.analyze.db.password') ?></label>
                            <div class="controls">
                                <input type="paddword" name="install.analyze.db.password"  value="<?= $this->db->password ?>" placeholder="<?= lang('install.analyze.db.password.ph') ?>">
                            </div>  
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="install.analyze.db.table"><?= lang('install.analyze.db.table') ?></label>
                            <div class="controls">
                                <input type="text" name="install.analyze.db.table" value="<?= $this->db->database ?>" placeholder="<?= lang('install.analyze.db.table.ph') ?>">
                            </div>  
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="span2" >
            <input class="knob" data-skin="tron" data-ticks="<?= $nbStep ?>" data-displayInput="false" data-readOnly="true" value="0"  data-width="150" />
        </div>
    </div>
    <div class="well">
        <button type="submit" class="btn">Submit</button>
    </div>
<?= form_close() ?>
<?= anchor_intern(site_url(array('install/index', Index::$steps[Index::STEP_DB])), 'next', '#installContent', '', 'installNav'); ?>

<?php 
    $this->layout->addOnload('$(".knob").knob();');
?>