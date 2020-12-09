<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/state">Estados de Resolução</a></li>
    <li>Novo Estado de Resolução</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendState">
            <textarea id="description" name="description"></textarea>
            <label for="description">Descrição</label><br>
            <select id="type" name="type">
                <option value="0">Não Categorizado</option>
                <option value="1">Pessoas</option>
                <option value="2">Imobilizado</option>
                <option value="3">Investimento</option>
            </select>
            <label for="type">Categoria</label><br>
            <input class="btn btn-primary" type="button" onclick="validaForm()" value="Enviar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function validaForm(){
        var description = document.getElementById('description');
        if (description.value === ''){ alert('O campo descrição não pode estar em branco!'); return; }
        sendForm('sendState', '<?= getenv('URLBASE');?>/state/saveState');
    }
</script>
