<?php
    $persons = $this->data['persons'];
?>
<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/state">Tarefas</a></li>
    <li>Nova Tarefa</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendTask">
            <label for="what_pa">O que ?</label><br>
            <textarea id="what_pa" name="what_pa"></textarea>
            <div class="select">
                <label for="who_pa">Quem ?</label><br>
                <select name="who_pa" id="who_pa">
                    <?
                    foreach ($persons as $person){
                        echo '<option value="'.$person['id'].'">'.$person['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <label for="when_pa">Quando ?</label><br>
            <input id="when_pa" type="date" name="when_pa"><br>
            <label for="why_pa">Por quê ?</label><br>
            <textarea id="why_pa" name="why_pa"></textarea>
            <label for="where_pa">Onde ?</label><br>
            <input id="where_pa" type="text" name="where_pa"><br>
            <input class="btn btn-primary" type="button" onclick="validaForm()" value="Enviar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function validaForm(){
        var description = document.getElementById('description');
        if (description.value === ''){ alert('O campo descrição não pode estar em branco!'); return; }
        sendForm('sendTask', '<?= getenv('URLBASE');?>/state/saveState');
    }
</script>
