<?php
final class DB
{
    private static $database_name;
    private static ?PDO $database = null;
    
    /**
     * Connects to the database using the environment variables, or the default values
     * if they are not set.
     *
     *
     * If the connection fails, an Error exception is thrown.
     *
     * @throws Error if there is an error connecting to the database.
     */
    public static function connect(): void
    {
        if (self::$database) return;

        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";

        self::$database = new PDO(
            $dsn,
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        self::$database_name = $_ENV['DB_NAME'];
    }

    /**
     * El método insertar en SQL de una manera automatizada. Solo requiere el nombre de la tabla y la data que quieres almacenar. 
     * Si usaste el Engine de Doctor Website, cada modelo tiene el nombre de la tabla que tiene un puente de comunicación.
     *
     *
     * @param string $table el nombre de la tabla SQL
     * @param array $data Lo que quieres almacenar en la tabla SQL.
     *
     */
    public static function insertar(string $table, array $data)
    {
        if (!self::$database) {
            die("Error: No hay conexión con la base de datos.");
        }
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = self::$database->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * La manera de añadirle condiciones a tu retorno. Solo requiere el nombre de la tabla y las columnas y la condición.
     * Si usaste el Engine de Doctor Website, cada modelo tiene el nombre de la tabla que tiene un puente de comunicación.
     *
     *
     * @param string $table el nombre de la tabla SQL
     * @param array $columnas Añadir condiciones para las columnas.  
     */
    public static function where(string $table, array $columnas)
    {
        self::connect();
        $sql = "SELECT * FROM $table WHERE ";
        $conditions = [];
        $values = [];
        
        foreach ($columnas as $columna => $valor) {
            $conditions[] = "$columna = ?";
            $values[] = $valor;
        }
        
        // Unimos las condiciones con 'AND'
        $sql .= implode(" AND ", $conditions);
        
        $stmt = self::$database->prepare($sql);
        $stmt->execute($values);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * La manera de columnas en un retorno. Solo requiere el nombre de la tabla y las columnas.
     * Si usaste el Engine de Doctor Website, cada modelo tiene el nombre de la tabla que tiene un puente de comunicación.
     *
     *
     * @param string $table el nombre de la tabla SQL
     * @param array $columnas Las columnas que quieres en el return.  
     */
    public static function select(string $table, array $columnas)
    {
        // Convertimos el array de columnas en un string separada por comas
        $columnas_str = implode(", ", $columnas);

        $sql = "SELECT $columnas_str FROM " . self::$database_name . ".$table";

        $statement = self::$database->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
