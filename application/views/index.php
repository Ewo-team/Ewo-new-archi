<form class="well">
<?php 
echo form_open('', array(
    'class' => 'well'
));
    echo form_label(lang('interface.log.mdp'));
?>
  <label></label>
  <input type="text" class="span3" placeholder="Type something…">
  <span class="help-block">Example block-level help text here.</span>
  <label class="checkbox">
    <input type="checkbox"> Check me out
  </label>
  <button type="submit" class="btn">Submit</button>
<?php
form_close();
?>