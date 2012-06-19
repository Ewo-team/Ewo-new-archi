<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <head>
            <title><?= $title ?></title>
            <meta http-equiv="Content-Type" content="text/html; charset=<?= $charset ?>" />
            <?php foreach($css as $url): ?>
                <link rel="stylesheet" type="text/css" media="screen" href="<?= $url ?>" />
            <?php endforeach; ?>
            
            <?php foreach($js as $url): ?>
                        <script type="text/javascript" src="<?= $url ?>"></script> 
            <?php endforeach; ?>
    </head>

    <body>
        <?= $output ?>
    </body>
</html>
<?php
log_message('debug', 'use html renderer');