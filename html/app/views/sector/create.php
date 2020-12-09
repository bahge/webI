<?php
$ap = $this->data['ap'];
?>
<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/sector">Setores</a></li>
    <li>Novo Setor</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendSector">
            <input id="name" type="text" name="name"><br>
            <label for="name">Nome</label><br>
            <textarea id="description" name="description"></textarea>
            <label for="description">Descrição</label><br>
            <div class="select">
                <label for="priority">Prioridade</label><br>
                    <select id="priority" name="priority">
                    <option value="0">Sem prioridade</option>
                    <option value="1">Baixa</option>
                    <option value="2">Média</option>
                    <option value="3">Alta</option>
                </select>
            </div>
            <div class="select">
                <label for="ap">Plano de Ação</label><br>
                <select name="ap" id="ap">
                    <?
                    foreach ($ap as $acplan){
                        echo '<option value="'.$acplan['id'].'">'.$acplan['name'].'</option>';
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
        sendForm('sendSector', '<?= getenv('URLBASE');?>/sector/saveSector');
    }
</script>
