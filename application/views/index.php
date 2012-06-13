<form class="well">
<?php 
echo form_open('', array(
    'class' => 'well'
));
    echo
        form_label(lang('interface.log.mdp')),
        form_input(array(
            'name'          => 'username',
            'id'            => 'username',
            'class'         => 'span3',
            'placeholder'   => lang('interface.form.enterPwd'),
        )),
        form_label(lang('interface.log.mdp')),
        form_password(array(
        'name'          => 'username',
        'id'            => 'username',
        'class'         => 'span3',
        'placeholder'   => lang('interface.form.enterPwd'),
    ));
?>
  <span class="help-block">Example block-level help text here.</span>
  <button type="submit" class="btn">Submit</button>
<?php
form_close();
?>