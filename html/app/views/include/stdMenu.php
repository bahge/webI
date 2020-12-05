<div class="titlebar">
    <i class="iconnavbar" onclick="menuResponsive()">☰</i>
    <ul class="menu" id="navbar">
        <li><a href="<?php echo getenv("URLBASE"); ?>/home">Página Inicial</a></li>
        <li><a href="<?php echo getenv("URLBASE"); ?>/person">Pessoas</a></li>
        <li><a href="<?php echo getenv("URLBASE"); ?>/user">Usuários</a></li>
        <li><a href="<?php echo getenv("URLBASE"); ?>/actionplan">Planos de Ação</a></li>
        <li><a href="<?php echo getenv("URLBASE"); ?>/sector">Setores</a></li>
        <li><a href="<?php echo getenv("URLBASE"); ?>/tasks">Tarefas</a></li>
        <li><a href="<?php echo getenv("URLBASE"); ?>/state">Estados</a></li>
    </ul>
</div>
<script>
    function menuResponsive() {
        var navbar = document.getElementById("navbar");
        if (navbar.className === "menu") {
            navbar.className += " responsive";
        } else {
            navbar.className = "menu";
        }
    }
</script>