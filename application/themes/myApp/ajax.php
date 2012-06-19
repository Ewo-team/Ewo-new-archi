<?php
header("Cache-Control: no-cache"); 
$output['onload'] = '';
if(count($onload) > 0){
    foreach($onload as $script)
        $output['onload'] .= $script;   
    $output['onload'] = '
        <script type="text/javascript">
            jQuery(document).ready(function(){'.
            $output['onload']
            . '});
        </script>';
}

if(array_key_exists('loadLibs', $output) && $output['loadLibs']){
    $output['css'] = '';
    foreach($css as $url)
        $output['css'] .= '<link rel="stylesheet" type="text/css" media="screen" href="'.$url.'" />';
    $output['js'] = '';
    foreach($js as $url)
        $output['js'] .= '<script type="text/javascript" src="'.$url.'"></script>';
    $output['onload'] = '';
       
}
unset($output['loadLibs']);
echo json_encode($output);
