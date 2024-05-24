<?php
// Definición de la clase Comentario
class Comentario
{
    // Propiedades privadas de la clase
    private $id; // ID del comentario
    private $id_personaje; // ID del personaje asociado al comentario
    private $texto; // Texto del comentario
    private $mi_connDB; // Objeto para la conexión a la base de datos

    // Constructor de la clase
    public function __construct($id_personaje, $texto)
    {
        $this->id = null; // Inicializa el ID del comentario como nulo
        $this->id_personaje = $id_personaje; // Asigna el ID del personaje
        $this->texto = $texto; // Asigna el texto del comentario
        $this->mi_connDB = ConnDB::obtenerInstancia(); // Obtiene una instancia de la conexión a la base de datos
    }

    // Métodos 'getter' para obtener los valores de las propiedades
    public function get_id()
    {
        return $this->id; // Devuelve el ID del comentario
    }

    public function get_id_personaje()
    {
        return $this->id_personaje; // Devuelve el ID del personaje
    }

    public function get_texto()
    {
        return $this->texto; // Devuelve el texto del comentario
    }

    // Método para visualizar la información del comentario
    public function visualizar_comentario()
    {
        $cadena_de_datos = $this->id_personaje . '#' . $this->texto; // Concatena el ID del personaje y el texto del comentario
        return $cadena_de_datos; // Devuelve la cadena de datos
    }

    // Método para recuperar un comentario de la base de datos
    public function recuperar_comentario($id)
    {
        try {
            $this->mi_connDB->conectar(); // Intenta conectarse a la base de datos
            if ($id > 0) { // Verifica que el ID proporcionado sea mayor que 0
                // Prepara la consulta SQL para recuperar el comentario
                $consulta_sql = "SELECT * FROM comentarios WHERE id = '" . $id . "'";
                // Ejecuta la consulta SQL
                $consulta = $this->mi_connDB->ejecutarSQL($consulta_sql);
                // Obtiene la fila resultante de la consulta
                $fila = $this->mi_connDB->siguiente_fila($consulta);
                if ($fila) {
                    // Si se encuentra una fila, asigna los valores a las propiedades
                    $this->id = $fila['id'];
                    $this->texto = $fila['texto'];
                } else {
                    // Si no se encuentra una fila, lanza una excepción
                    throw new Exception("No se encontró el comentario con el ID: $id");
                }
            } else {
                // Si el ID proporcionado no es válido, lanza una excepción
                throw new Exception("El ID del comentario debe ser mayor que 0.");
            }
        } catch (Exception $e) {
            // Captura cualquier excepción y lanza una nueva con el mensaje de error
            throw new Exception('No se pudo recuperar el comentario: ' . $e->getMessage());
        }
    }

    // Método para insertar un nuevo comentario en la base de datos
    public function insertar_comentario()
    {
        try {
            $this->mi_connDB->conectar(); // Intenta conectarse a la base de datos
            // Prepara la consulta SQL para insertar el nuevo comentario
            $consulta_sql = "INSERT INTO comentarios (id,idP, texto) VALUES (NULL,'" . $this->id_personaje . "', '" . $this->texto . "')";
            // Ejecuta la consulta SQL
            $this->mi_connDB->ejecutarSQL($consulta_sql);
        } catch (PDOException $e) {
            // Captura las excepciones específicas de PDO y lanza una nueva excepción
            throw new Exception('No se pudo insertar el comentario: ' . $e->getMessage());
        }
    }
}
