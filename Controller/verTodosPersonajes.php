<?php
// PENDIENTE INTENTAR CAMBIAR ESTO A UNA CLASE, HACER EL MODELO Y SU VISTA


// $col_personajes = new ColPersonajes();
// $personaje_array = $col_personajes->ver_todos();

// include_once './View/visualizar_personajes.php';


// PAGINACIÓN
$conexion = ConnDB::obtenerInstancia(); // <-- Creamos la instancia de la clase ConnDB que es la conexion a DB
$conexion->conectar(); // <-- Conectamos a la DB
$consulta_sql = "SELECT * FROM brawlers"; // <-- Creamos la consulta SQL
$cosultata_re = $conexion->ejecutarSQL($consulta_sql); // <-- Ejecutamos la consulta SQL
$total_de_registros = $cosultata_re->rowCount(); // <-- Obtenemos el total de registros
$pagina = false; // <-- Variable para almacenar la página actual


if ($total_de_registros > 0) {
    $num_registros_por_pagina = 3;
    $primera_vez = false;

    if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];
    }
    if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $num_registros_por_pagina;
    }


    $num_total_paginas = ceil($total_de_registros / $num_registros_por_pagina);
    $nueva_consulta_sql = "SELECT * FROM brawlers LIMIT " . $inicio . "," . $num_registros_por_pagina;
    $consulta_sql = $conexion->ejecutarSQL($nueva_consulta_sql);

    

    while ($fila = $conexion->siguiente_fila($consulta_sql)) {
        echo '<div class="brawler">';
        echo '<div>' . $fila['nombre'] . '</div>';
        echo '<div>' . $fila['descripcion'] . '</div>';
        echo '<div class="comentarios"><a class="com" href="index.php?vercoment=' . $fila['id'] . '">Ver comentarios</a><a class="com" href="index.php?comentar=' . $fila['id'] . '">Realizar comentario</a></div>';
        echo '</div>';
    }

    if ($num_total_paginas > 1) {
        if ($pagina > 1) {
            echo '<a href="index.php?pagina=' . ($pagina - 1) . '">Anterior</a>';
        }


        for ($i = 1; $i < $num_total_paginas + 1; $i++) {
            if ($pagina == $i) {
                echo $pagina;
            } else {
                echo '<a href="index.php?pagina=' . $i . '">' . $i . '</a>';
            }
        }
        if ($pagina < $num_total_paginas) {
            echo '<a href="index.php?pagina=' . ($pagina + 1) . '">Siguiente</a>';
        }
    }
}
