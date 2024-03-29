<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang['install.title']      = 'Installation';
$lang['install.progress']   = 'Progression';

/**
 * Nom des sections
 */
$lang['install.steps.init']     = 'Initialisation';
$lang['install.steps.analyze']  = 'Analyse';
$lang['install.steps.database'] = 'Base de donnée';
$lang['install.steps.rights']   = 'droit d\'accès aux fichiers';

/**
 * Section init
 */
$lang['install.init.text']  = 'Choisissez votre langage';

/**
 * Section analyze
 */
$lang['install.analyze.section.general']    = 'Informations générales';
$lang['install.analyze.section.db']         = 'Base de donnée';

$lang['install.analyze.base_url']       = 'Url de base';
$lang['install.analyze.lang']           = 'Langue par défaut';
$lang['install.analyze.env']            = 'Environnement';  
    $lang['install.analyze.base_url.ph']    = 'ex : http://localhost/ewo/';
    $lang['install.analyze.lang.ph']        = 'ex : french';
    $lang['install.analyze.env.ph']         = 'ex : development';
    

$lang['install.analyze.db.host']        = 'Nom de la base de données';
$lang['install.analyze.db.username']    = 'Nom d\'utilisateur';
$lang['install.analyze.db.password']    = 'Mot de passe';
$lang['install.analyze.db.base']        = 'Base principale';
    $lang['install.analyze.db.host.ph']     = 'ex : ewo';
    $lang['install.analyze.db.username.ph'] = 'ex : root';
    $lang['install.analyze.db.password.ph'] = 'ex : 123456';
    $lang['install.analyze.db.base.ph']     = 'ex : ewo';

/**
 * Section database
 */    
    
$lang['install.db.table_exists']        = 'Tables existantes';
$lang['install.db.table_not_exists']    = 'Tables manquantes';
    
/**
 * Errors
 */
    
$lang['install.error.analyze.lang_error']   = 'Cette langue n\'existe pas';
$lang['install.error.analyze.env_error']    = 'Cet environnement n\'existe pas';

    
/**
 * End of file
 */
