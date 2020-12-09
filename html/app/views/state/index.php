<ul class="breadcrumb">
    <li>Estados de Resolução</li>
</ul>
<div class="row">
    <div class="col-1">
        <?php echo isset($this->data['msg']) ? $this->data['msg'] . '<br>': ''; ?>

        <a class="btn btn-primary" href="<?php echo getenv("URLBASE"); ?>/state/create">Novo Estado de Resolução</a><br><br>
        <table>
            <thead>
            <th>#</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Ações</th>
            </thead>
            <tbody>
            <?php
            use app\models\state;
            $state = new state();
            $array = $state->listAll();
            foreach ($array as $obj) {
                ?>
                <tr>
                    <td><?= $obj->getId(); ?></td>
                    <td><?= $obj->getDescription(); ?></td>
                    <td><?php $val = $obj->getType();
                        switch ($val){
                            case '1':
                                echo 'Pessoas';
                                break;
                            case '2':
                                echo 'Imobilizado';
                                break;
                            case '3':
                                echo 'Investimento';
                                break;
                            default:
                                echo 'Não Categorizado';
                                break;
                        }

                        ?></td>
                    <td>
                        <a href="<?= getenv('URLBASE');?>/state/update/<?= $obj->getId(); ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= getenv('URLBASE');?>/state/delete/<?= $obj->getId(); ?>" class="btn btn-danger">Apagar</a>
                    </td>
                </tr>
                <?php
            }?>
            </tbody>
        </table>
    </div>
</div>