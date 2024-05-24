<?php

include './header.php';
include './Model/ConnDB.php';

// -----------------------------------------------

if (isset($_GET['grabarper'])) {
    include_once './Controller/grabarPersonajes.php';
    mostrar_formulario();
} elseif (isset($_POST['nombre'])) {
    include_once './Controller/grabarPersonajes.php';
    grabar_datos();
} elseif (isset($_POST['palabrabuscar'])) {
    $palabraBuscar = $_POST['palabrabuscar'];
    if ($palabraBuscar != "") {
        include_once './Controller/buscarPalabra.php';
        buscar($palabraBuscar);
    }
} elseif (isset($_GET['vercoment'])) {
    $id_personaje = $_GET['vercoment'];
    include_once './Controller/verComentarios.php';
} elseif (isset($_GET['comentar'])) {
    $id_personaje = $_GET['comentar'];
    include_once './Controller/comentarPersonaje.php';
    mostrar_formulario($id_personaje);
} elseif (isset($_POST['comentario'])) {
    include_once './Controller/comentarPersonaje.php';
    grabar_formulario();
} else {
    include_once './Controller/verTodosPersonajes.php';
}

include './footer.php';
