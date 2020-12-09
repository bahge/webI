<?php
namespace app\controllers;

use app\helpers\views;
use app\helpers\crud;
use app\models;
class user implements stdController
{
    /**
     * Função index, renderiza a view com a lista de users
     */
    public function index()
    {
        $page = new views('user/index');
        $page->render();
    }

    /**
     * Função create, renderiza a view para inserir um novo user
     */
    public function create()
    {
        $person = new crud();
        $array['persons'] = $person->read(getenv('TBL_PERSON'), '', '', array('id', 'name'));

        $page = new views('user/create', $array);
        $page->render();
    }

    /**
     * Função update, renderiza a view passando os dados do user para edição
     * @param $id
     */
    public function update($id)
    {
        $person = new crud();
        $array['persons'] = $person->read(getenv('TBL_PERSON'), '', '', array('id', 'name'));
        $user = new models\user();
        $array['user'] = $user->listById($id);
        if (!is_null($array['user'])){
            $page = new views('user/update', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Usuário não encontrado';exit;
        }
    }

    /**
     * Função detete, renderiza a view com os dados do user para confirmar a remoção do registro
     * @param $id
     */
    public function delete($id)
    {
        $person = new crud();
        $array['persons'] = $person->read(getenv('TBL_PERSON'), '', '', array('id', 'name'));
        $user = new models\user();
        $array['user'] = $user->listById($id);
        if (!is_null($array['user'])){
            $page = new views('user/delete', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Usuário não encontrado';exit;
        }
    }

    /**
     * Função saveUser, recebe os dados de inserção de um user, chamando a model de manipulação do BD
     */
    public function saveUser()
    {
        if (isset($_POST['login'])){
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
            $nvl = filter_input(INPUT_POST, 'nvl', FILTER_SANITIZE_NUMBER_INT);
            $stats = filter_input(INPUT_POST, 'stats', FILTER_SANITIZE_NUMBER_INT);
            $personId = filter_input(INPUT_POST, 'personId', FILTER_SANITIZE_NUMBER_INT);

            $user = new models\user(null, $login, $pass, $nvl, $stats, $personId);
            $save = $user->save($user);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$save['Erro'];
            }
        }
    }

    /**
     * Função updateUser, recebe os dados de edição de um user, chamando a model de manipulação do BD
     */
    public function updateUser()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
            $nvl = filter_input(INPUT_POST, 'nvl', FILTER_SANITIZE_NUMBER_INT);
            $stats = filter_input(INPUT_POST, 'stats', FILTER_SANITIZE_NUMBER_INT);
            $personId = filter_input(INPUT_POST, 'personId', FILTER_SANITIZE_NUMBER_INT);


            $user = new models\user($id, $login, $pass, $nvl, $stats, $personId);
            $save = $user->save($user);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro atualizado com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$save['Erro'];
            }
        }
    }

    /**
     * Função deleteUser, recebe os dados para remoção de um user, após a confirmação, chamando a model de manipulação do BD
     */
    public function deleteUser()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $user = new models\user();
            $delete = $user->deleteById($id);
            if ($delete == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro removido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$delete['Erro'];
            }
        }
    }
}