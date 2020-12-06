<?php
extract($this->data);
?>
<ul class="breadcrumb bg-danger">
    <li><a href="<?php echo getenv("URLBASE"); ?>/actionplan">Planos de Ação</a></li>
    <li>Apagar</li>
</ul>
<div class="row">
    <div class="col-1">
        <form id="sendActionPlan">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input id="name" type="text" name="name" value="<?= $name ?>"><br>
            <label for="name">Nome</label><br>
            <textarea id="description" name="description"><?= $description ?></textarea>
            <label for="description">Descrição</label><br>
            <input class="btn btn-danger" type="button" onclick="confirmPopup()" value="Apagar" name="submit" id="btnsend">
        </form>
    </div>
</div>

<script>
    function confirmPopup(){
        if (confirm("Tem certeza que deseja apagar o registro?")) {
            sendForm('sendActionPlan', '<?= getenv('URLBASE');?>/actionplan/deleteActionPlan');
        } else {
            alert('🆄🅵🅰...!!')
        }
    }
</script>
