<?php

interface crudInterface
{
    /**
     * Função que auxilia na listagem de todos os dados
     * 
     * @return array            
     */
    public static function listAll();
    /**
     * Função que auxilia na busca por um registro
     * 
     * @return array            
     */
    public function listById($id);
    /**
     * Função que auxilia na edição de um registro
     * 
     * @return boolean            
     */
    public function editById($id);
    /**
     * Função que auxilia na remoção de um registro
     * 
     * @return boolean            
     */
    public function deleteById($id);
}