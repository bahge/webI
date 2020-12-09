<?php
use app\models\sector;
use app\models\actionPlan;

$sector= new sector();
$array = $sector->listAll();

$ap = new actionPlan();
$aps = $ap->listAll();
foreach ($aps as $obj) {
    $idAp[$obj->getId()] = $obj->getName();
}
?>
<ul class="breadcrumb">
    <li>Setores</li>
</ul>
<div class="row">
    <div class="col-1">
        <?php echo isset($this->data['msg']) ? $this->data['msg'] . '<br>': ''; ?>
        <a class="btn btn-primary" href="<?php echo getenv("URLBASE"); ?>/sector/create">Novo Setor</a><br><br>
        <table>
            <thead>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Prioridade</th>
            <th>Plano de Ação</th>
            <th>Ações</th>
            </thead>
            <tbody>
            <?php
            foreach ($array as $obj) {
                ?>
                <tr>
                    <td><?= $obj->getId(); ?></td>
                    <td><?= $obj->getName(); ?></td>
                    <td><?= $obj->getDescription(); ?></td>
                    <td><?php
                        switch ($obj->getPriority()){
                            case '3':
                                echo 'Alta';
                                break;
                            case '2':
                                echo 'Média';
                                break;
                            case '1':
                                echo 'Baixa';
                                break;
                            default:
                                echo 'Sem prioridade';
                                break;
                        }
                        ?></td>
                    <td><?=
                        /** @var actionPlan $idAp */
                        $idAp[$obj->getAp()];
                        ?></td>
                    <td>
                        <a href="<?= getenv('URLBASE');?>/sector/update/<?= $obj->getId(); ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= getenv('URLBASE');?>/sector/delete/<?= $obj->getId(); ?>" class="btn btn-danger">Apagar</a>
                    </td>
                </tr>
            <?php } //Fecha o foreach?>
            </tbody>
        </table>
    </div>
</div>
