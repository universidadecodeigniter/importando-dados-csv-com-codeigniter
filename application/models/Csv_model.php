<?php

class Csv_model extends CI_Model {

  /**
    * Método construtor
    *
    * @access  public
    * @return  void
    */
    function __construct() {
        parent::__construct();
    }

    /**
      * Recupera todos os contatos da tabela 'contatos'
      *
      * @access  public
      * @return  void
      */
    function get_contatos() {
        $query = $this->db->get('contatos');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /**
      * Insere o contato na tabela 'contatos'
      *
      * @access  public
      * @return  void
      */
    function insert_csv($data) {
        $this->db->insert('contatos', $data);
    }
}
