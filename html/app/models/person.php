<?php

require_once(ABS_PATH . '/app/helpers/crud.php');
class person implements crudInterface
{
    private $id;
    private $name;
    private $email;
    private $phone;
    private static $entity = 'persons';

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
            $person = new person($key['id'], $key['user'], $key['email'], null);
            array_push($persons, $person);
        }
        return $persons;
    }

    /**
     * Função que auxilia na busca por um registro indivídual retornando um objeto person
     * 
     * @return array            
     */
    public function listById($id)
    {
        $read = new crud();
        $person = $read->read(self::$entity, 'WHERE id=:id', 'id={$id}', null);
        var_dump($person);
    }

    /**
     * Função que auxilia na edição de um registro
     * 
     * @return boolean            
     */
    public function editById($id)
    {

    }

    /**
     * Função que auxilia na remoção de um registro
     * 
     * @return boolean            
     */
    public function deleteById($id)
    {

    }

    /**
     * Função quando instanciada constroi uma nova person
     * 
     * @return void           
     */
    public function __construct($id = null, $name = null, $email = null, $phone = null)
    {
        $this->id = (!is_null($id)) ? $id : null;
        $this->name = (string) $name;
        $this->email = (string) $email;
        $this->phone = (!is_null($phone)) ? $phone : '';
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