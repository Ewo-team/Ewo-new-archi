<form>
  <label>Label name</label>
  <input type="text" class="span3" placeholder="Type something…">
  <span class="help-block">Example block-level help text here.</span>
  <label class="checkbox">
    <input type="checkbox"> Check me out
  </label>
  <div class="well">
      <button type="submit" class="btn">Submit</button>
    </div> 
</form>
<?= anchor_intern(site_url(array('install/index',Index::$steps[Index::STEP_DB])),  'next','#installContent');?>