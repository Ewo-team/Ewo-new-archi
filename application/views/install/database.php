    <div class="row-fluid">
        <div class=" page-header"><h3><?= lang('install.db.table_exists')?></h3></div>
    </div>
    <div class="row-fluid">
    <?php 
        $i  = 0;
        asort($tables);
        $tables = array_reverse($tables);
        foreach($tables as $table => $exists){
            $mod = $i % 4;
            $error = false;
            if($mod == 0)
               echo '
    <div class="row-fluid">';
            
            if($exists){
                $badge = 'success';
                $glyph = 'icon-ok-sign';
            }
            else{
                $badge = 'important';
                $glyph = 'icon-exclamation-sign'; 
                if(!$error){
                    $error = true;
                    $i = 0;
                    echo '
    </div>
    <div class="row-fluid">
        <div class=" page-header"><h3>'.lang('install.db.table_not_exists').'</h3></div>
    </div>
    <div class="row-fluid">';
                }
            }
            
                echo '
        <span class="span3">
            <span class="label label-'.$badge.'"><i class="'.$glyph.' icon-white"></i>
                ',$table,'
            </span>
        </span>';
                
            if($mod == 3)
                echo '
    </div>';
        }
         if($mod != 3)
                echo '
        </div>';
    ?>
    </div>
    <div class="well center-align">
        <?= form_button(array(
            'content'   => lang('interface.nav.previous'),
            'class'     => 'btn',
            'onclick'   => anchor_intern_function(site_url(array('install/index', Index::$steps[Index::STEP_ANALYZE])), '#installContent', 'installNav')
            ))
        ?>
        <?= form_button(array(
            'content'   => lang('interface.nav.next'),
            'class'     => 'btn',
            'onclick'   => anchor_intern_function(site_url(array('install/index', Index::$steps[Index::STEP_RIGHTS])), '#installContent', 'installNav')
            ))
        ?>
    </div>
