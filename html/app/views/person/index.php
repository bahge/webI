<ul class="breadcrumb">
    <li>Pessoas</li>
</ul>
<div class="row">
    <div class="col-1">
        <?php echo isset($this->data['msg']) ? $this->data['msg'] . '<br>': ''; ?>

        <a class="btn btn-primary" href="<?php echo getenv("URLBASE"); ?>/person/create">Nova pessoa</a><br><br>
        <table>
            <thead>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
            </thead>
            <tbody>
                <?php
                use app\models\person;
                $person = new person();
                $array = $person->listAll();
                foreach ($array as $obj) {
                ?>
                        <tr>
                            <td><?= $obj->getId(); ?></td>
                            <td><?= $obj->getName(); ?></td>
                            <td><?= $obj->getEmail(); ?></td>
                            <td><?= $obj->getPhone(); ?></td>
                            <td>
                                <a href="<?= getenv('URLBASE');?>/person/update/<?= $obj->getId(); ?>" class="btn btn-primary">Editar</a>
                                <a href="<?= getenv('URLBASE');?>/person/delete/<?= $obj->getId(); ?>" class="btn btn-danger">Apagar</a>
                            </td>
                        </tr>
                <?php
                }?>
            </tbody>
        </table>
    </div>
</div>


