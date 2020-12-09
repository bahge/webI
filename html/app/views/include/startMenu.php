<div class="titlebar">
    <i class="iconnavbar" onclick="menuResponsive()">☰</i>
    <ul class="menu" id="navbar">
        <li><a href="<?php echo getenv("URLBASE"); ?>/home">Página Inicial</a></li>
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