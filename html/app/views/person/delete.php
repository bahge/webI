<?php
extract($this->data);
?>
<ul class="breadcrumb bg-danger">
    <li><a href="<?php echo getenv("URLBASE"); ?>/person">Pessoas</a></li>
    <li>Apagar</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendPerson">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input id="name" type="text" name="name" value="<?= $name ?>"><br>
            <label for="name">Nome</label><br>
            <input id="email" type="email" name="email" value="<?= $email ?>"><br>
            <label for="email">E-mail</label><br>
            <input id="phone" type="text" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $phone ?>"><br>
            <label for="phone">Telefone</label><br>
            <input class="btn btn-danger" type="button" onclick="confirmPopup()" value="Apagar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function confirmPopup(){
        if (confirm("Tem certeza que deseja apagar o registro?")) {
            sendForm('sendPerson', '<?= getenv('URLBASE');?>/person/deletePerson');
        } else {
            alert('Ufa!!')
        }
    }
</script>
