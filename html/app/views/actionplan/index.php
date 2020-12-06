<ul class="breadcrumb">
    <li>Planos de Ação</li>
</ul>
<div class="row">
    <div class="col-1">
        <?php echo isset($this->data['msg']) ? $this->data['msg'] . '<br>': ''; ?>

        <a class="btn btn-primary" href="<?php echo getenv("URLBASE"); ?>/actionplan/create">Novo Plano de Ação</a><br><br>
        <table>
            <thead>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
            </thead>
            <tbody>
            <?php
            use app\models\actionPlan;
            $ac = new actionPlan();
            $array = $ac->listAll();
            foreach ($array as $obj) {
                ?>
                <tr>
                    <td><?= $obj->getId(); ?></td>
                    <td><?= $obj->getName(); ?></td>
                    <td><?= $obj->getDescription(); ?></td>
                    <td>
                        <a href="<?= getenv('URLBASE');?>/actionplan/update/<?= $obj->getId(); ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= getenv('URLBASE');?>/actionplan/delete/<?= $obj->getId(); ?>" class="btn btn-danger">Apagar</a>
                    </td>
                </tr>
                <?php
            }?>
            </tbody>
        </table>
    </div>
</div>