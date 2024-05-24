<?php

include_once './header.php';
?>

<form action="index.php" method="post">
    <fieldset>
        <legend>Nombre del brawler</legend>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
    </fieldset>
    <fieldset>
        <legend>Descripcion del brawler</legend>
        <label for="descripcion">Descripcion:</label>
        <textarea id="descripcion" name="descripcion" cols="40" rows="10"></textarea>
    </fieldset>
    <input type="submit" name="enviar" value="Enviar">
</form>