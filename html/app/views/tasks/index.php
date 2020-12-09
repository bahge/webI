<?php
$array = $this->data['tasks'];
?>
<ul class="breadcrumb">
    <li>Lista de Tarefas</li>
</ul>
<div class="row">
    <div class="col-1">
        <?php echo isset($this->data['msg']) ? $this->data['msg'] . '<br>': ''; ?>

        <a class="btn btn-primary" href="<?php echo getenv("URLBASE"); ?>/tasks/create">Nova Tarefa</a><br><br>
        <table>
            <thead>
            <th>#</th>
            <th>O que?</th>
            <th>Quando ?</th>
            <th>Ações</th>
            </thead>
            <tbody>
            <?php
            foreach ($array as $task) {
                ?>
                <tr>
                    <td><?= $task['id']; ?></td>
                    <td><?= $task['what_pa']; ?></td>
                    <td><?= date('d/m/Y', strtotime($task['when_pa'])); ?></td>
                    <td>
                        <a href="<?= getenv('URLBASE');?>/tasks/update/<?= $task['id']; ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= getenv('URLBASE');?>/tasks/delete/<?= $task['id']; ?>" class="btn btn-danger">Apagar</a>
                    </td>
                </tr>
                <?php
            }?>
            </tbody>
        </table>
    </div>
</div>