<?php
namespace app\models;

use app\helpers\crud;
use app\helpers\crudInterface;

class actionPlan implements crudInterface
{
    private $id;
    private $name;
    private $description;
    private static $entity = 'actionplan';

    /**
     * @inheritDoc
     */
    public static function listAll()
    {
        // Todo something
    }

    /**
     * @inheritDoc
     */
    public function listById($id)
    {
        // TODO: Implement listById() method.
    }

    /**
     * @inheritDoc
     */
    public function editById($id)
    {
        // TODO: Implement editById() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    /**
     * Função quando instanciada constroi um novo actionPlan
     *
     * @return void
     */
    public function __construct($id = null, $name = null, $description = null)
    {
        $this->id = (!is_null($id)) ? $id : null;
        $this->name = (string) $name;
        $this->description = (string) $description;
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