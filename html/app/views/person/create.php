<ul class="breadcrumb">
    <li><a href="<?php echo getenv("URLBASE"); ?>/person">Pessoas</a></li>
    <li>Nova Pessoa</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendPerson">
            <input id="name" type="text" name="name"><br>
            <label for="name">Nome</label><br>
            <input id="email" type="email" name="email"><br>
            <label for="email">E-mail</label><br>
            <input id="phone" type="text" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br>
            <label for="phone">Telefone</label><br>
            <input class="btn btn-primary" type="button" onclick="validaForm()" value="Enviar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function validaForm(){
        var name = document.getElementById('name');
        var email = document.getElementById('email');
        if (name.value === ''){ alert('O campo nome não pode estar em branco!'); return; }
        if (email.value === ''){ alert('O campo e-mail não pode estar em branco!'); return; }
        sendForm('sendPerson', '<?= getenv('URLBASE');?>/person/savePerson');
    }
</script>
