<div id="content" class="container">
    <h1><?= $title ?></h1>
        <?= $output['content'] ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
<?php foreach($onload as $script): ?>
        <?= $script ?>
<?php endforeach; ?>           
    });
</script>