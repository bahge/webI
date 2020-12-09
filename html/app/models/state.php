<?php


namespace app\models;
use app\helpers\crud;
use app\helpers\crudInterface;

class state implements crudInterface
{
    private $id;
    private $description;
    private $type;
    private static $entity = 'state';
    private $state;

    /**
     * Função que auxilia na listagem de todos objetos state retonando dentro de um array
     *
     * @return array
     */
    public static function listAll()
    {
        $read = new crud();
        $array = $read->read( self::$entity, '', null, null );
        $states = [];
        foreach ($array as $key) {
            $state = new state( $key['id'], $key['description'], $key['type'] );
            array_push( $states, $state );
        }
        return $states;
    }

    /**
     * Função que auxilia na busca por um registro indivídual retornando um objeto state
     *
     * @param $id
     * @return array
     */
    public function listById($id)
    {
        $idState = (int) $id;
        $read = new crud();
        $state = $read->read( self::$entity, 'WHERE id=:id', 'id=' . $idState, null);
        return $state[0];
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
        return $edit->update( self::$entity, [ 'description' => $this->state->getDescription(), 'type' => $this->state->getType() ], [ 'id' => $id ] );
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
        $taskInUse = $delete->read(getenv('TBL_TASKS'), 'WHERE state=:id', 'id=' . $id, array('what_pa'));
        if (isset($taskInUse[0]['what_pa'])){
            return array('Erro' => 'O estado de resolução está vinculado a tarefa: ' . $taskInUse[0]['name'] . ', remova primeiro a tarefa');
        } else {
            return $delete->delete(self::$entity, ['id' => $id]);
        }
    }

    /**
     * Função quando instanciada constroi um novo state
     *
     * @param null $id
     * @param null $description
     * @param null $type
     */
    public function __construct($id = null, $description = null, $type = null)
    {
        $this->id = (!is_null( $id )) ? $id : null;
        $this->description = $description;
        $this->type = (!is_null( $type )) ? $type : null;
    }

    /**
     * Função que auxilia na inserção de um registro
     *
     * @param state $state
     * @return mixed
     */
    public function save(state $state)
    {
        $create = new crud();
        if (is_null( $this->getId() )) {
            return $create->insert( self::$entity, [ 'description' => $state->getDescription(), 'type' => $state->getType() ] );
        } else {
            $this->state = $state;
            return $this->editById( $state->getId() );
        }
    }

    /**
     * Funções getters e setters para o encapsulamento dos parâmetros
     */
    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }
}