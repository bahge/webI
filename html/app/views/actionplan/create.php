<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/actionplan">Planos de Ação</a></li>
    <li>Novo Plano de Ação</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendActionPlan">
            <input id="name" type="text" name="name"><br>
            <label for="name">Nome</label><br>
            <textarea id="description" name="description"></textarea>
            <label for="description">Descrição</label><br>
            <input class="btn btn-primary" type="button" onclick="validaForm()" value="Enviar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function validaForm(){
        var name = document.getElementById('name');
        if (name.value === ''){ alert('O campo nome não pode estar em branco!'); return; }
        sendForm('sendActionPlan', '<?= getenv('URLBASE');?>/actionplan/saveActionPlan');
    }
</script>

