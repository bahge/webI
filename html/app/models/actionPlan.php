<?php

namespace app\models;

use app\helpers\crud;
use app\helpers\crudInterface;

class actionPlan implements crudInterface
{
    private $id;
    private $name;
    private $description;
    private static $entity = 'actionPlan';
    private $actionplan;

    /**
     * Função que auxilia na listagem de todos objetos actionPlan retonando dentro de um array
     *
     * @return array
     */
    public static function listAll()
    {
        $read = new crud();
        $array = $read->read( self::$entity, '', null, null );
        $actionsplans = [];
        foreach ($array as $key) {
            $actionplan = new actionPlan( $key['id'], $key['name'], $key['description'] );
            array_push( $actionsplans, $actionplan );
        }
        return $actionsplans;
    }

    /**
     * Função que auxilia na busca por um registro indivídual retornando um objeto actionPlan
     *
     * @param $id
     * @return array
     */
    public function listById($id)
    {
        $idAC = (int)$id;
        $read = new crud();
        $actionplan = $read->read( self::$entity, 'WHERE id=:id', 'id=' . $idAC, null );
        return $actionplan[0];
    }

    /**
     * Função que auxilia na edição de um registro
     *
     * @param $id
     * @return boolean
     */
    public function editById($id)
    {
        $edit = new crud();
        return $edit->update( self::$entity, [ 'name' => $this->actionplan->getName(), 'description' => $this->actionplan->getDescription() ], [ 'id' => $id ] );
    }

    /**
     * Função que auxilia na remoção de um registro
     *
     * @param $id
     * @return mixed
     */
    public function deleteById($id)
    {
        $delete = new crud();
        return $delete->delete( self::$entity, array( 'id' => $id ) );
    }

    /**
     * Função quando instanciada constroi um novo actionPlan
     *
     * @return void
     */
    public function __construct($id = null, $name = null, $description = null)
    {
        $this->id = (!is_null( $id )) ? $id : null;
        $this->name = (string)$name;
        $this->description = (string)$description;
    }

    /**
     * Função que auxilia na inserção de um registro
     *
     * @param actionPlan $ac
     * @return mixed
     */
    public function save(actionPlan $ac)
    {
        $create = new crud();
        if (is_null( $this->getId() )) {
            return $create->insert( self::$entity, [ 'name' => $ac->getName(), 'description' => $ac->getDescription() ] );
        } else {
            $this->actionplan = $ac;
            return $this->editById( $ac->getId() );
        }
    }

    /**
     * Funções getters e setters para o encapsulamento dos parâmetros
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}