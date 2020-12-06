<?php
extract($this->data['user']);
$persons = $this->data['persons'];
?>
<ul class="breadcrumb bg-danger">
    <li><a href="<?php echo getenv("URLBASE"); ?>/user">Usuário</a></li>
    <li>Apagar</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendUser">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input id="login" type="text" name="login" value="<?= $login ?>"><br>
            <label for="login">Login</label><br>
            <input id="pass" type="password" name="pass" value="<?= $pass?>"><br>
            <label for="pass">Senha</label><br>
            <div class="select">
                <label for="nvl">Nível</label><br>
                <select name="nvl" id="nvl">
                    <option value="99" <?= ($nvl == 99 ? 'selected' : '') ?>>Usuário</option>
                    <option value="10" <?= ($nvl == 10 ? 'selected' : '') ?>>Moderador</option>
                    <option value="1" <?= ($nvl == 1 ? 'selected' : '') ?>>Administrador</option>
                </select>
            </div>
            <div class="select">
                <label for="stats">Status</label><br>
                <select name="stats" id="stats">
                    <option value="1" <?= ($stats == 1 ? 'selected' : '') ?>>Ativo</option>
                    <option value="0" <?= ($stats == 0 ? 'selected' : '') ?>>Inativo</option>
                </select>
            </div>
            <div class="select">
                <label for="personId">Pessoa</label><br>
                <select name="personId" id="personId">
                    <?
                    foreach ($persons as $person){
                        echo '<option value="'.$person['id'].'" '.( $personId === $person['id'] ? 'selected' : '').'>'.$person['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <input class="btn btn-danger" type="button" onclick="confirmPopup()" value="Apagar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function confirmPopup(){
        if (confirm("Tem certeza que deseja apagar o registro?")) {
            sendForm('sendUser', '<?= getenv('URLBASE');?>/user/deleteUser');
        } else {
            alert('🆄🅵🅰...!!')
        }
    }
</script>