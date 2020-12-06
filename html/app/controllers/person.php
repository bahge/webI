<?php
namespace app\controllers;

use app\helpers\views;
use app\models;
class person implements stdController
{
    /**
     * Função index, renderiza a view com a lista de persons
     */
    public function index()
    {
        $page = new views('person/index');
        $page->render();
    }

    /**
     * Função create, renderiza a view para inserir uma nova person
     */
    public function create()
    {
        $page = new views('person/create');
        $page->render();
    }

    /**
     * Função update, renderiza a view passando os dados da person para edição
     * @param $id
     */
    public function update($id)
    {
        $person = new models\person();
        $array = $person->listById($id);
        if (!is_null($array)){
            $page = new views('person/update', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Pessoa não encontrada';exit;
        }
    }

    /**
     * Função detete, renderiza a view com os dados da person para confirmar a remoção do registro da person
     * @param $id
     */
    public function delete($id)
    {
        $person = new models\person();
        $array = $person->listById($id);
        if (!is_null($array)){
            $page = new views('person/delete', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Pessoa não encontrada';exit;
        }
    }

    /**
     * Função savePerson, recebe os dados de inserção de uma person, chamando a model de manipulação do BD
     */
    public function savePerson()
    {
        if (isset($_POST['name'])){
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

            $person = new models\person(null, $name, $email, $phone);
            $save = $person->save($person);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $save['Erro'];
            }
        }
    }

    /**
     * Função updatePerson, recebe os dados de edição de uma person, chamando a model de manipulação do BD
     */
    public function updatePerson()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

            $person = new models\person($id, $name, $email, $phone);
            $save = $person->save($person);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro atualizado com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $save['Erro'];
            }
        }
    }

    /**
     * Função deletePerson, recebe os dados para remoção de uma person, após a confirmação, chamando a model de manipulação do BD
     */
    public function deletePerson()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $person = new models\person();
            $delete = $person->deleteById($id);
            if ($delete === true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro removido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $delete['Erro'];
            }
        }
    }
}