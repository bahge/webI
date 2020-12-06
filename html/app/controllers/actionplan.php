<?php
namespace app\controllers;

use app\helpers\views;
use app\models;
class actionplan implements stdController
{
    /**
     * Função index, renderiza a view com a lista de planos de ação
     */
    public function index()
    {
        $page = new views('actionplan/index');
        $page->render();
    }

    /**
     * Função create, renderiza a view para inserir um novo plano de ação
     */
    public function create()
    {
        $page = new views('actionplan/create');
        $page->render();
    }

    /**
     * Função update, renderiza a view passando os dados do plano de ação para edição
     * @param $id
     */
    public function update($id)
    {
        $actionplan = new models\actionPlan();
        $array = $actionplan->listById($id);
        if (!is_null($array)){
            $page = new views('actionplan/update', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Plano de ação não encontrado';exit;
        }
    }

    /**
     * Função detete, renderiza a view com os dados do plano de ação para confirmar a remoção do registro da person
     * @param $id
     */
    public function delete($id)
    {
        $actionplan = new models\actionPlan();
        $array = $actionplan->listById($id);
        if (!is_null($array)){
            $page = new views('actionplan/delete', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Plano de ação não encontrado';exit;
        }
    }

    /**
     * Função saveActionPlan, recebe os dados de inserção de um plano de ação, chamando a model de manipulação do BD
     */
    public function saveActionPlan()
    {
        if (isset($_POST['name'])){
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $actionplan = new models\actionPlan(null, $name, $description);
            $save = $actionplan->save($actionplan);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $save['Erro'];
            }
        }
    }

    /**
     * Função updateActionPlan, recebe os dados de edição de um plano de ação, chamando a model de manipulação do BD
     */
    public function updateActionPlan()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $actionplan = new models\actionPlan($id, $name, $description);
            $save = $actionplan->save($actionplan);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro atualizado com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $save['Erro'];
            }
        }
    }

    /**
     * Função deleteActionPlan, recebe os dados para remoção de um plano de ação, após a confirmação, chamando a model de manipulação do BD
     */
    public function deleteActionPlan()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $actionplan = new models\actionPlan();
            $delete = $actionplan->deleteById($id);
            if ($delete === true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro removido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' . $delete['Erro'];
            }
        }
    }
}