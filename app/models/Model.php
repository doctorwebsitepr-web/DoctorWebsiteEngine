<?php
require_once BASE_PATH . 'app/models/DB.php';
class Model
{
    protected static $table; // The name of the table associated with the model
    protected $attributes = []; // The attributes of the model
    public $values = []; // The sanitized values of the model
    private static $initialized = false; // A flag indicating whether the model has been initialized
    protected static $primary_key = 'id'; // The primary key of the model
    protected static $hidden = [];  // An array of attributes that should not be serialized
    /**
     * Sets the table name for the model based on the class name.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    protected function __construct(array $attributes, array $sanitized)
    {
        self::init();
        $this->set_attributes($attributes); // Cambiar `self::` por `$this->`
        $this->values = $sanitized;
    }
    // Método mágico __get()
    public function __get($key)
    {
        return $this->attributes[$key] ?? null; // Devuelve el valor de los atributos o null si no existe
    }
    /**
     * Sanitiza los valores del modelo para evitar ataques de inyección SQL o XSS.
     *
     * @param array $data Los datos a sanitizar.
     * @return array Los datos sanitizados.
     */
    private static function sanitize(array $data)
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            if ($value === null) {
                $sanitized[$key] = null; // Mantener null si el valor original es null
            } else {
                $sanitized[$key] = htmlspecialchars(strip_tags($value));
            }
        }
        return $sanitized;
    }
    /**
     * Asigna los atributos al modelo.
     *
     * @param array $attributes Los atributos a asignar.
     */
    private function set_attributes(array $attributes)
    {
        $this->attributes = $attributes;
    }
    /**
     * Initializes the model by connecting to the database and setting the model attributes.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    protected static function init()
    {

        DB::connect();
        if (self::$initialized) {
            return;
        }
        if (empty(static::$table)) {
            static::$table = strtolower(static::class) . 's';
        }
        self::$initialized = true;
    }
    /**
     * Verifica si existe al menos un registro en la base de datos
     * que cumpla con las condiciones especificadas. Básicamente una ejecución de un SQL SELECT
     *
     * El proceso: Inicializa DB -> SELECT -> self::sanitize($data); -> return true or false
     *
     * OJO:
     * - Los nombres de columnas deben coincidir exactamente con la estructura
     *   de la tabla.
     *
     * Ejemplo de uso:
     * ```php
     * if (User::existeEnLaDB(['correo' => $email])) {
     *     // Que ocurre si el usuario existe
     * }
     * ```
     *
     * @param array $conditions condiciones para el WHERE.
     *      Ejemplo: ['id' => 10,'estado' => 'Activo']
     *
     * @return bool
     *      return TRUE si existe al menos un registro que cumpla
     *      return FALSE si no se encuentra ningún registro.
     * */
    public static function  existeEnLaDB(array $conditions): bool
    {
        self::init();
        $res = DB::where(static::$table, $conditions);
        return !empty($res);
    }
    /**
     * Almacena una instancia en la base de datos. La tabla es escogida
     * por el hijo de este modelo
     *
     * @param array $data Este arreglo almacena los datos de la instancia.
     *
     * @return void
     */
    public static function insertDB(array $data): bool
    {
        self::init();
        return DB::insertar(static::$table, $data);
    }

    /**
     * Returns all records from the associated table.
     *
     * @return array An array of associative arrays, where each key is the name of a
     *               column, and the value is the value of that column in the
     *               database.
     */
    public static function all(): array
    {
        self::init();

        $model_list = [];
        foreach (DB::select(static::$table, ['*']) as $model) {
            $model_list[] = new static($model, self::sanitize($model));
        }

        return $model_list;
    }
}
