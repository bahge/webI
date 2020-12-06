<?php
use app\models\user;
use app\models\person;

$user = new user();
$array = $user->listAll();

$person = new person();
$persons = $person->listAll();
foreach ($persons as $obj) {
    $idPerson[$obj->getId()] = $obj->getName();
}
?>
<ul class="breadcrumb">
    <li>Usuários</li>
</ul>
<div class="row">
    <div class="col-1">
        <?php echo isset($this->data['msg']) ? $this->data['msg'] . '<br>': ''; ?>
        <a class="btn btn-primary" href="<?php echo getenv("URLBASE"); ?>/user/create">Novo Usuário</a><br><br>
        <table>
            <thead>
                <th>#</th>
                <th>Login</th>
                <th>Nível</th>
                <th>Pessoa</th>
                <th>Status</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?php
                    foreach ($array as $obj) {
                ?>
                <tr>
                    <td><?= $obj->getId(); ?></td>
                    <td><?= $obj->getLogin(); ?></td>
                    <td><?php
                        switch ($obj->getNvl()){
                            case '99':
                                echo 'Usuário';
                                break;
                            case '10':
                                echo 'Moderador';
                                break;
                            default:
                                echo 'Administrador';
                                break;
                        }
                        ?></td>
                    <td><?=
                        /** @var person $idPerson */
                        $idPerson[$obj->getPersonId()];
                        ?></td>
                    <td><?= ($obj->getStats() == '1' ? 'Ativo' : 'Inativo'); ?></td>
                    <td>
                        <a href="<?= getenv('URLBASE');?>/user/update/<?= $obj->getId(); ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= getenv('URLBASE');?>/user/delete/<?= $obj->getId(); ?>" class="btn btn-danger">Apagar</a>
                    </td>
                </tr>
                <?php } //Fecha o foreach?>
            </tbody>
        </table>
    </div>
</div>