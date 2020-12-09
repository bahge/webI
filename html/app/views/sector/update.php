<?php
$ap = $this->data['ap'];
extract($this->data['sector']);
?>
<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/sector">Setores</a></li>
    <li>Editar Setor</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendSector">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input id="name" type="text" name="name" value="<?= $name ?>"><br>
            <label for="name">Nome</label><br>
            <textarea id="description" name="description"><?= $description ?></textarea>
            <label for="description">Descrição</label><br>
            <div class="select">
                <label for="priority">Prioridade</label><br>
                <select id="priority" name="priority">
                    <option value="0" <?= ($priority == 0 ? 'selected' : '') ?>>Sem prioridade</option>
                    <option value="1" <?= ($priority == 1 ? 'selected' : '') ?>>Baixa</option>
                    <option value="2" <?= ($priority == 2 ? 'selected' : '') ?>>Média</option>
                    <option value="3" <?= ($priority == 3 ? 'selected' : '') ?>>Alta</option>
                </select>
            </div>
            <div class="select">
                <label for="ap">Plano de Ação</label><br>
                <select name="ap" id="ap">
                    <?
                    foreach ($ap as $acplan){
                        echo '<option value="'.$acplan['id'].'" '.( $ac === $acplan['id'] ? 'selected' : '').'>'.$acplan['name'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <input class="btn btn-primary" type="button" onclick="validaForm()" value="Enviar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function validaForm(){
        var description = document.getElementById('description');
        if (description.value === ''){ alert('O campo descrição não pode estar em branco!'); return; }
        sendForm('sendSector', '<?= getenv('URLBASE');?>/sector/updateSector');
    }
</script>
