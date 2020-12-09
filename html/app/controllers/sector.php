<?php
namespace app\controllers;

use app\helpers\crud;
use app\helpers\views;
use app\models;
class sector implements stdController
{
    /**
     * Função index, renderiza a view com a lista de setores
     */
    public function index()
    {
        $page = new views('sector/index');
        $page->render();
    }

    /**
     * Função create, renderiza a view para inserir um novo setor
     */
    public function create()
    {
        $actionPlan = new crud();
        $array['ap'] = $actionPlan->read(getenv('TBL_AP'), '', '', array('id', 'name'));

        $page = new views('sector/create', $array);
        $page->render();
    }

    /**
     * Função update, renderiza a view passando os dados do setor para edição
     * @param $id
     */
    public function update($id)
    {
        $actionPlan = new crud();
        $array['ap'] = $actionPlan->read(getenv('TBL_AP'), '', '', array('id', 'name'));
        $sector = new models\sector();
        $array['sector'] = $sector->listById($id);
        if (!is_null($array['sector'])){
            $page = new views('sector/update', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Setor não encontrado';exit;
        }
    }

    /**
     * Função detete, renderiza a view com os dados do setor para confirmar a remoção do registro
     * @param $id
     */
    public function delete($id)
    {
        $actionPlan = new crud();
        $array['ap'] = $actionPlan->read(getenv('TBL_AP'), '', '', array('id', 'name'));
        $sector = new models\sector();
        $array['sector'] = $sector->listById($id);
        if (!is_null($array['sector'])){
            $page = new views('sector/delete', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Setor não encontrado';exit;
        }
    }

    /**
     * Função saveSector, recebe os dados de inserção de um setor, chamando a model de manipulação do BD
     */
    public function saveSector()
    {
        if (isset($_POST['name'])){
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_NUMBER_INT);
            $ap = filter_input(INPUT_POST, 'ap', FILTER_SANITIZE_NUMBER_INT);

            $sector = new models\sector(null, $name, $description, $priority, $ap );
            $save = $sector->save($sector);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$save['Erro'];
            }
        }
    }

    /**
     * Função updateSector, recebe os dados de edição de um setor, chamando a model de manipulação do BD
     */
    public function updateSector()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_NUMBER_INT);
            $ap = filter_input(INPUT_POST, 'ap', FILTER_SANITIZE_NUMBER_INT);

            $sector = new models\sector($id, $name, $description, $priority, $ap);
            $save = $sector->save($sector);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro atualizado com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$save['Erro'];
            }
        }
    }

    /**
     * Função deleteSector, recebe os dados para remoção de um setor, após a confirmação, chamando a model de manipulação do BD
     */
    public function deleteSector()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $sector = new models\sector();
            $delete = $sector->deleteById($id);
            if ($delete == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro removido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$delete['Erro'];
            }
        }
    }
}