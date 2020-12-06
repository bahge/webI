<?php
namespace app\models;

use app\helpers\crud;
use app\helpers\crudInterface;

class user implements crudInterface
{
    private $id;
    private $login;
    private $pass;
    private $nvl;
    private $stats;
    private $personId;
    private static $entity = 'users';
    private $user;

    /**
     * Função de listagem de todos usuários
     *
     * @return array
     */
    public static function listAll()
    {
        $read = new crud();
        $array = $read->read(self::$entity, '', null, null);
        $users = [];
        foreach ($array as $key) {
            $user = new user($key['id'], $key['login'], $key['pass'], $key['nvl'], $key['stats'], $key['personId']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * Função de retorno de um user selecionado pelo Id
     *
     * @param $id
     * @return array
     */
    public function listById($id)
    {
        $idUser = (int) $id;
        $read = new crud();
        $user = $read->read(self::$entity, 'WHERE id=:id', 'id=' . $idUser, null);
        return $user[0];
    }

    /**
     * Função de edição de um user
     *
     * @param $id
     * @return boolean
     */
    public function editById($id)
    {
        $edit = new crud();
        return $edit->update(self::$entity, array(
            'login' => $this->user->getLogin(),
            'pass' => $this->user->getPass(),
            'nvl' => $this->user->getNvl(),
            'stats' => $this->user->getStats(),
            'personId' => $this->user->getPersonId()
        ), ['id' => $id]);
    }

    /**
     * Função que remove um user
     * @param $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $delete = new crud();
        return $delete->delete(self::$entity, ['id' => $id]);
    }

    /**
     * Função quando instanciada constroi um novo user
     * @param null $id
     * @param null $login
     * @param null $pass
     * @param null $nvl
     * @param null $stats
     * @param null $personId
     */
    public function __construct($id = null, $login = null, $pass = null, $nvl = null, $stats = null, $personId = null)
    {
        $this->id = (!is_null($id)) ? $id : null;
        $this->login = (string) $login;
        $this->pass = (string) $pass;
        $this->nvl = (!is_null($nvl)) ? $nvl : 99;
        $this->stats = (!is_null($stats)) ? $stats : 1;
        $this->personId = (!is_null($personId)) ? $personId : null;
    }

    /**
     * Função que insere ou atualiza um user
     *
     * @param user $user
     * @return mixed
     */
    public function save(user $user)
    {
        $create = new crud();
        if (is_null($this->getId())){
            return $create->insert(self::$entity, array(
                'login'=> $user->getLogin(),
                'pass'=> $user->getPass(),
                'nvl' => $user->getNvl(),
                'stats' => $user->getStats(),
                'personId' => $user->getPersonId()
            ));
        } else {
            $this->user = $user;
            return $this->editById($user->getId());
        }
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }
    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    /**
     * @return int|mixed
     */
    public function getNvl()
    {
        return $this->nvl;
    }
    /**
     * @param int|mixed $nvl
     */
    public function setNvl($nvl)
    {
        $this->nvl = $nvl;
    }
    /**
     * @return int|mixed
     */
    public function getStats()
    {
        return $this->stats;
    }
    /**
     * @param int|mixed $stats
     */
    public function setStats($stats)
    {
        $this->stats = $stats;
    }
    /**
     * @return mixed|null
     */
    public function getPersonId()
    {
        return $this->personId;
    }
    /**
     * @param mixed|null $personId
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;
    }
    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }


}