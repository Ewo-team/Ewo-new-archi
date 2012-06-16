<div class="alert alert-error">
  <button class="close" data-dismiss="alert">×</button>
  <strong>Erreur !</strong> la base de donnée n'est pas disponnible
</div>
<?= anchor_intern(site_url(array('install/index',Index::$steps[Index::STEP_ANALYZE])),  'previous','#installContent', '', 'installNav');?>