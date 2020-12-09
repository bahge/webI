<?php


namespace app\models;
use app\helpers\crud;
use app\helpers\crudInterface;

class sector implements crudInterface
{
    private $id;
    private $name;
    private $description;
    private $priority;
    private $ap;
    private static $entity = 'sector';
    private $sector;

    /**
     * Função que auxilia na listagem de todos objetos sector retonando dentro de um array
     *
     * @return array
     */
    public static function listAll()
    {
        $read = new crud();
        $array = $read->read( self::$entity, '', null, null );
        $sectors = [];
        foreach ($array as $key) {
            $sector = new sector( $key['id'], $key['name'], $key['description'], $key['priority'], $key['ap'] );
            array_push( $sectors, $sector );
        }
        return $sectors;
    }

    /**
     * Função que auxilia na busca por um registro indivídual retornando um objeto sector
     *
     * @param $id
     * @return array
     */
    public function listById($id)
    {
        $idSector = (int) $id;
        $read = new crud();
        $sector = $read->read( self::$entity, 'WHERE id=:id', 'id=' . $idSector, null);
        return $sector[0];
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
        return $edit->update( self::$entity, [ 'name' => $this->sector->getName(), 'description' => $this->sector->getDescription(), 'priority' => $this->sector->getPriority(), 'ap' => $this->sector->getAp() ], [ 'id' => $id ] );
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
        $taskInUse = $delete->read(getenv('TBL_TASKS'), 'WHERE sector=:id', 'id=' . $id, array('name'));
        if (isset($taskInUse[0]['name'])){
            return array('Erro' => 'O setor está vinculado a tarefa: ' . $taskInUse[0]['name'] . ', remova primeiro a tarefa');
        } else {
            return $delete->delete(self::$entity, ['id' => $id]);
        }
    }

    /**
     * Função quando instanciada constroi um novo sector
     *
     * @param null $id
     * @param null $name
     * @param null $description
     * @param null $priority
     * @param null $ap
     */
    public function __construct($id = null, $name = null, $description = null, $priority = null, $ap = null)
    {
        $this->id = (!is_null( $id )) ? $id : null;
        $this->name = $name;
        $this->description = (!is_null( $description )) ? $description : null;
        $this->priority = $priority;
        $this->ap = (!is_null( $ap )) ? $ap : null;
    }

    /**
     * Função que auxilia na inserção de um registro
     *
     * @param sector $sector
     * @return mixed
     */
    public function save(sector $sector)
    {
        $create = new crud();
        if (is_null( $this->getId() )) {
            return $create->insert( self::$entity, [ 'name' => $sector->getName(), 'description' => $sector->getDescription(), 'priority' => $sector->getPriority(), 'ap' => $sector->getAp() ] );
        } else {
            $this->sector = $sector;
            return $this->editById( $sector->getId() );
        }
    }

    /**
     * Funções getters e setters para o encapsulamento dos parâmetros
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getAp()
    {
        return $this->ap;
    }
}