<?php


namespace app\models;
use app\helpers\crud;
use app\helpers\crudInterface;

class tasks implements crudInterface
{
    private $id;
    private $what_pa;
    private $who_pa;
    private $when_pa;
    private $why_pa;
    private $where_pa;
    private $how_pa;
    private $howMuch_pa;
    private $state;
    private $sector;
    private static $entity = 'tasks';
    private $task;

    /**
     * Função que auxilia na listagem de todos objetos tasks retonando dentro de um array
     *
     * @return array
     */
    public static function listAll()
    {
        $read = new crud();
        $array = $read->read(self::$entity, '', null, null);
        $tasks = [];
        foreach ($array as $key) {
            $task = new tasks($key['id'], $key['what_pa'], $key['who_pa'], $key['when_pa'], $key['why_pa'], $key['where_pa'], $key['how_pa'], $key['howMuch_pa'], $key['state'], $key['sector']);
            array_push($tasks, $task);
        }
        return $tasks;
    }

    /**
     * Função que auxilia na busca por um registro indivídual retornando um objeto task
     *
     * @param $id
     * @return array
     */
    public function listById($id)
    {
        $idTask = (int) $id;
        $read = new crud();
        $task = $read->read(self::$entity, 'WHERE id=:id', 'id='. $idTask, null);
        return $task[0];
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
        return $edit->update(self::$entity, ['what_pa' => $this->task->getWhatPa(), 'who_pa' => $this->task->getWhoPa(),
            'when_pa' => $this->task->getWhenPa(), 'why_pa' => $this->task->getWhyPa(), 'where_pa' => $this->task->getWherePa(),
            'how_pa' => $this->task->getHowPa(), 'howMuch_pa' => $this->task->getHowMuchPa(), 'state' => $this->task->getState(),
            'sector' => $this->task->getSector() ], ['id' => $id]);
    }

    /**
     * Função que auxilia na remoção de um registro
     *
     * @param $id
     * @return mixed | boolean
     */
    public function deleteById($id)
    {
        $delete = new crud();
        return $delete->delete(self::$entity, ['id' => $id]);
    }

    /**
     * Função quando instanciada constroi um novo state
     *
     */
    public function __construct($id = null, $what_pa = null, $who_pa = null, $when_pa = null, $why_pa = null, $where_pa = null, $how_pa = null, $howMuch_pa = null, $state = null, $sector = null)
    {
        $this->id = (!is_null( $id )) ? $id : null;
        $this->what_pa = $what_pa;
        $this->who_pa = (!is_null($who_pa)) ? $who_pa : 0;
        $this->when_pa = (!is_null($when_pa)) ? $when_pa : null;
        $this->why_pa = (!is_null($why_pa)) ? $why_pa : null;
        $this->where_pa = (!is_null($where_pa)) ? $where_pa : null;
        $this->how_pa = (!is_null($how_pa)) ? $how_pa : null;
        $this->howMuch_pa = (!is_null($howMuch_pa)) ? $howMuch_pa : null;
        $this->state = (!is_null($state)) ? $state : 0;
        $this->sector = (!is_null($sector)) ? $sector : 0;
    }

    /**
     * Função que auxilia na inserção de um registro
     *
     * @param tasks $task
     * @return mixed
     */
    public function save(tasks $task)
    {
        $create = new crud();
        if (is_null( $this->getId() )) {
            return $create->insert( self::$entity, [ 'what_pa' => $task->getWhatPa(), 'who_pa' => $task->getWhoPa(),
                'when_pa' => $task->getWhenPa(), 'why_pa' => $task->getWhyPa(), 'where_pa' => $task->getWherePa(),
                'how_pa' => $task->getHowPa(), 'howMuch_pa' => $task->getHowMuchPa(), 'state' => $task->getState(),
                'sector' => $task->getSector() ] );
        } else {
            $this->task = $task;
            return $this->editById( $task->getId() );
        }
    }

    /**
     * Funções getters e setters para o encapsulamento dos parâmetros
     */
    public function getId()
    {
        return $this->id;
    }

    public function getWhatPa()
    {
        return $this->what_pa;
    }

    public function getWhoPa()
    {
        return $this->who_pa;
    }

    public function getWhenPa()
    {
        return $this->when_pa;
    }

    public function getWhyPa()
    {
        return $this->why_pa;
    }

    public function getWherePa()
    {
        return $this->where_pa;
    }

    public function getHowPa()
    {
        return $this->how_pa;
    }

    public function getHowMuchPa()
    {
        return $this->howMuch_pa;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getSector()
    {
        return $this->sector;
    }

}