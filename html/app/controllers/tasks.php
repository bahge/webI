<?php
namespace app\controllers;

use app\helpers\views;
use app\helpers\crud;
use app\models;
class tasks implements stdController
{
    /**
     * Função index, renderiza a view com a lista de tarefas
     */
    public function index()
    {
        $read = new crud();
        $array['tasks'] = $read->read(getenv('TBL_TASKS'), '', '', array('id', 'what_pa', 'when_pa'));
        $page = new views('tasks/index', $array);
        $page->render();
    }

    /**
     * Função create, renderiza a view para inserir uma nova tarefa
     */
    public function create()
    {
        $read = new crud();
        $array['states'] = $read->read(getenv('TBL_STATE'), '', '', array('id', 'description'));
        $array['sectors'] = $read->read(getenv('TBL_SECTOR'), '', '', array('id', 'name'));
        $array['persons'] = $read->read(getenv('TBL_PERSON'), '', '', array('id', 'name'));

        $page = new views('tasks/create', $array);
        $page->render();
    }

    /**
     * Função update, renderiza a view passando os dados da tarefa para edição
     * @param $id
     */
    public function update($id)
    {
        $read = new crud();
        $array['states'] = $read->read(getenv('TBL_STATE'), '', '', array('id', 'description'));
        $array['sectors'] = $read->read(getenv('TBL_SECTOR'), '', '', array('id', 'name'));
        $array['persons'] = $read->read(getenv('TBL_PERSON'), '', '', array('id', 'name'));

        $task = new models\tasks();
        $array['task'] = $task->listById($id);
        if (!is_null($array['task'])){
            $page = new views('tasks/update', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Tarefa não encontrada';exit;
        }
    }

    /**
     * Função detete, renderiza a view com os dados da tarefa para confirmar a remoção do registro
     * @param $id
     */
    public function delete($id)
    {
        $read = new crud();
        $array['states'] = $read->read(getenv('TBL_STATE'), '', '', array('id', 'description'));
        $array['sectors'] = $read->read(getenv('TBL_SECTOR'), '', '', array('id', 'name'));
        $array['persons'] = $read->read(getenv('TBL_PERSON'), '', '', array('id', 'name'));

        $task = new models\tasks();
        $array['task'] = $task->listById($id);
        if (!is_null($array['task'])){
            $page = new views('tasks/delete', $array);
            $page->render();
        } else {
            echo '🅴🆁🆁🅾: Tarefa não encontrada';exit;
        }
    }

    /**
     * Função saveTask, recebe os dados de inserção de uma tarefa, chamando a model de manipulação do BD
     */
    public function saveTask()
    {
        if (isset($_POST['what_pa'])){
            $what_pa = filter_input(INPUT_POST, 'what_pa', FILTER_SANITIZE_STRING);
            $who_pa = filter_input(INPUT_POST, 'who_pa', FILTER_SANITIZE_NUMBER_INT);
            $when_pa = filter_input(INPUT_POST, 'when_pa', FILTER_DEFAULT);
            $why_pa = filter_input(INPUT_POST, 'why_pa', FILTER_SANITIZE_STRING);
            $where_pa = filter_input(INPUT_POST, 'where_pa', FILTER_SANITIZE_STRING);
            $how_pa = filter_input(INPUT_POST, 'how_pa', FILTER_SANITIZE_STRING);
            $howMuch_pa = filter_input(INPUT_POST, 'howMuch_pa', FILTER_SANITIZE_NUMBER_FLOAT);
            $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT);
            $sector = filter_input(INPUT_POST, 'sector', FILTER_SANITIZE_NUMBER_INT);

            $task = new models\tasks(null, $what_pa,$who_pa,$when_pa,$why_pa,$where_pa,$how_pa,$howMuch_pa, $state, $sector);
            $save = $task->save($task);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$save['Erro'];
            }
        }
    }

    /**
     * Função updateTask, recebe os dados de edição de uma tarefa, chamando a model de manipulação do BD
     */
    public function updateTask()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $what_pa = filter_input(INPUT_POST, 'what_pa', FILTER_SANITIZE_STRING);
            $who_pa = filter_input(INPUT_POST, 'who_pa', FILTER_SANITIZE_NUMBER_INT);
            $when_pa = filter_input(INPUT_POST, 'when_pa', FILTER_DEFAULT);
            $why_pa = filter_input(INPUT_POST, 'why_pa', FILTER_SANITIZE_STRING);
            $where_pa = filter_input(INPUT_POST, 'where_pa', FILTER_SANITIZE_STRING);
            $how_pa = filter_input(INPUT_POST, 'how_pa', FILTER_SANITIZE_STRING);
            $howMuch_pa = filter_input(INPUT_POST, 'howMuch_pa', FILTER_SANITIZE_NUMBER_FLOAT);
            $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT);
            $sector = filter_input(INPUT_POST, 'sector', FILTER_SANITIZE_NUMBER_INT);

            $task = new models\tasks($id, $what_pa,$who_pa,$when_pa,$why_pa,$where_pa,$how_pa,$howMuch_pa, $state, $sector);
            $save = $task->save($task);

            if ($save == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro inserido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$save['Erro'];
            }
        }
    }

    /**
     * Função deleteTask, recebe os dados para remoção de uma tarefa, após a confirmação, chamando a model de manipulação do BD
     */
    public function deleteTask()
    {
        if (isset($_POST['id'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $task = new models\tasks();
            $delete = $task->deleteById($id);
            if ($delete == true) {
                echo '🆂🆄🅲🅴🆂🆂🅾: Registro removido com sucesso.';
            } else {
                echo '🅴🆁🆁🅾: ' .$delete['Erro'];
            }
        }
    }
}