<?php
namespace app\controllers;

use app\helpers\views;
use app\models;
class state implements stdController
{

    public function index()
    {
        $page = new views('state/index');
        $page->render();
    }

    /**
     * Função create, renderiza a view para inserir um estado de resolução
     */
    public function create()
    {
        $page = new views('state/create');
        $page->render();
    }

    /**
     * Função update, renderiza a view passando os dados do estado de resolução para edição
     * @param $id
     */
    public function update($id)
    {
        $state = new models\state();
        $array = $state->listById($id);
        if (!is_null($array)){
            $page = new views('state/update', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Estado de Resolução não encontrado';exit;
        }
    }

    /**
     * Função detete, renderiza a view com os dados do estado de Resolução para confirmar a remoção do registro do objeto
     * @param $id
     */
    public function delete($id)
    {
        $state = new models\state();
        $array = $state->listById($id);
        if (!is_null($array)){
            $page = new views('state/delete', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Estado de Resolução não encontrado';exit;
        }
    }

    /**
     * Função saveState, recebe os dados de inserção de um estado de resolução, chamando a model de manipulação do BD
     */
    public function saveState()
    {
        if (isset($_POST['description'])){
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);


            $state = new models\state(null, $description, $type);
            $save = $state->save($state);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $save['Erro'];
            }
        }
    }

    /**
     * Função updateState, recebe os dados de edição de um estado de resolução, chamando a model de manipulação do BD
     */
    public function updateState()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);

            $state = new models\state($id, $description, $type);
            $save = $state->save($state);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro atualizado com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $save['Erro'];
            }
        }
    }

    /**
     * Função deleteState, recebe os dados para remoção de um estado de resolução, após a confirmação, chamando a model de manipulação do BD
     */
    public function deleteState()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $state = new models\state();
            $delete = $state->deleteById($id);
            if ($delete === true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro removido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $delete['Erro'];
            }
        }
    }
}