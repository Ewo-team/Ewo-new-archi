<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of news_midel
 *
 * @author Benjamin Herbomez <benjamin.herbomez@esial.com>
 */
class News_Model extends CI_Model{
    protected $table = 'news';
    protected $table_u = 'utilisateur';

    
    public function getNews($nb = 5,$deb = 0){
        return $this->db->select('
            n.id    as id,
            u.nom   as auteur,
            n.titre as titre,
            n.corps as corps,
            n.date  as date')
                    ->from($this->table.' n')
                    ->join($this->table_u.' u','u.id = n.auteur')
                    ->limit($nb, $deb)
                    ->order_by('id', 'desc')
                    ->get()
                    ->result();
    }
}
