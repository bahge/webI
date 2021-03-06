<?php
    $persons = $this->data['persons'];
    $states = $this->data['states'];
    $sectors = $this->data['sectors'];
?>
<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/tasks">Tarefas</a></li>
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
            <input id="when_pa" type="date" name="when_pa" value="<?= date('Y-m-d'); ?>"><br>
            <label for="why_pa">Por quê ?</label><br>
            <textarea id="why_pa" class="small" name="why_pa"></textarea>
            <label for="where_pa">Onde ?</label><br>
            <input id="where_pa" type="text" name="where_pa"><br>
            <label for="how_pa">Como ?</label><br>
            <textarea id="how_pa" class="small" name="how_pa"></textarea>
            <label for="howMuch_pa">Quanto custa ?</label><br>
            <input id="howMuch_pa" type="text" name="howMuch_pa" value="0"><br>
            <div class="select">
                <label for="state">Estado de Resolução</label><br>
                <select name="state" id="state">
                    <option value="0">--</option>
                    <?
                    foreach ($states as $state){
                        echo '<option value="'.$state['id'].'">'.$state['description'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="select">
                <label for="sector">Estado de Resolução</label><br>
                <select name="sector" id="sector">
                    <option value="0">--</option>
                    <?
                    foreach ($sectors as $sector){
                        echo '<option value="'.$sector['id'].'">'.$sector['name'].'</option>';
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
        var description = document.getElementById('what_pa');
        if (description.value === ''){ alert('O campo O que? não pode estar em branco!'); return; }
        sendForm('sendTask', '<?= getenv('URLBASE');?>/tasks/saveTask');
    }
</script>
