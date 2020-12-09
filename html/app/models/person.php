<?php
namespace app\models;

use app\helpers\crud;
use app\helpers\crudInterface;

class person implements crudInterface
{
    private $id;
    private $name;
    private $email;
    private $phone;
    private static $entity = 'person';
    private $person;

    /**
     * Função que auxilia na listagem de todos objetos person retonando dentro de um array
     * 
     * @return array            
     */
    public static function listAll()
    {
        $read = new crud();
        $array = $read->read(self::$entity, '', null, null);
        $persons = [];
        foreach ($array as $key) {
            $person = new person($key['id'], $key['name'], $key['email'], $key['phone']);
            array_push($persons, $person);
        }
        return $persons;
    }

    /**
     * Função que auxilia na busca por um registro indivídual retornando um objeto person
     *
     * @param $id
     * @return array
     */
    public function listById($id)
    {
        $idPerson = (int) $id;
        $read = new crud();
        $person = $read->read(self::$entity, 'WHERE id=:id', 'id='. $idPerson, null);
        return $person[0];
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
        return $edit->update(self::$entity, ['name' => $this->person->getName(), 'email' => $this->person->getEmail(), 'phone' => $this->person->getPhone()], ['id' => $id]);
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
        $useInUser = $delete->read(getenv('TBL_USER'), 'WHERE personId=:id', 'id=' . $id, array('login'));
        $useInTask = $delete->read(getenv('TBL_TASKS'), 'WHERE who_pa=:id', 'id=' . $id, array('what_pa'));
        if (isset($useInUser[0]['login'])){
            return array('Erro' => 'A pessoa está vinculada ao usuário: ' . $useInUser[0]['login'] . ', remova primeiro o usuário');
        } else {
            if (isset($useInTask[0]['what_pa'])){
                return array('Erro' => 'A pessoa está vinculada a tarefe: ' . $useInTask[0]['what_pa'] . ', remova primeiro a tarefa');
            } else {
                return $delete->delete(self::$entity, ['id' => $id]);
            }
        }
    }

    /**
     * Função quando instanciada constroi uma nova person
     *
     * @param null $id
     * @param null $name
     * @param null $email
     * @param null $phone
     */
    public function __construct($id = null, $name = null, $email = null, $phone = null)
    {
        $this->id = (!is_null($id)) ? $id : null;
        $this->name = (string) $name;
        $this->email = (string) $email;
        $this->phone = (!is_null($phone)) ? $phone : '';
    }

    /**
     * Função que auxilia na inserção de um registro
     *
     * @param person $person
     * @return mixed
     */
    public function save(person $person)
    {
        $create = new crud();
        if (is_null($this->getId())){
            return $create->insert(self::$entity, ['name' => $person->getName(), 'email' => $person->getEmail(), 'phone' => $person->getPhone()]);
        } else {
            $this->person = $person;
            return $this->editById($person->getId());
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
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}