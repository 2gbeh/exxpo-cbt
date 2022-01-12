<?PHP
# CRUD CLASS USING PDO
class MyPDO
{
    private $conn;

    public function __construct($database = 'mysql', $username = 'root', $password = '')
    {
        try {
            $host = 'mysql:host=localhost;dbname=' . $database;
            $this->conn = new PDO($host, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function insert($table, $post)
    {
        $conn = $this->conn;
        $fields = $values = '';
        $binds = array();

        foreach ($post as $key => $value) {
            $p = ':' . $key;
            $fields .= $key . ', ';
            $values .= $p . ', ';
            $binds[$p] = $value;
        }
        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');
        $sql = 'INSERT INTO `' . $table . '` (' . $fields . ') VALUES (' . $values . ')';

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($binds);
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function select($table, $where = null)
    {
        $conn = $this->conn;
        $binds = array();

        if (is_array($where) && count($where) == 2) {
            $p = ':' . $where[0];
            $field = $where[0];
            $value = $where[1];
            $binds = array($p => $value);
            $sql = 'SELECT * FROM `' . $table . '` WHERE ' . $field . '=' . $p;
        } else {
            $sql = 'SELECT * FROM `' . $table . '` ORDER BY id';
        }

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($binds);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return count($rows) > 0 ? $rows : null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($table, $post, $where = null)
    {
        $conn = $this->conn;
        $binds = $post;
        $values = '';

        foreach ($post as $key => $value) {
            $values .= $key . '=:' . $key . ', ';
        }
        $values = rtrim($values, ', ');

        if (is_array($where) && count($where) == 2) {
            $p = ':' . $where[0];
            $field = $where[0];
            $value = $where[1];
            $binds[$field] = $value;
            $sql = 'UPDATE `' . $table . '` SET ' . $values . ' WHERE ' . $field . '=' . $p;
        } else {
            $sql = 'UPDATE `' . $table . '` SET ' . $values . ' WHERE 1';
        }

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($binds);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($table, $where = null)
    {
        $conn = $this->conn;
        $binds = array();

        if (is_array($where) && count($where) == 2) {
            $p = ':' . $where[0];
            $field = $where[0];
            $value = $where[1];
            $binds = array($p => $value);
            $sql = 'DELETE FROM `' . $table . '` WHERE ' . $field . '=' . $p;
        } else {
            $sql = 'DELETE FROM `' . $table . '` WHERE 1';
        }

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($binds);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function query($table, $sql, $binds = array())
    {
        $conn = $this->conn;
        $type = substr($sql, 0, 6);

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($binds);
            switch ($type) {
                case 'INSERT':
                    return $conn->lastInsertId();
                    break;
                case 'SELECT':
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return count($rows) > 0 ? $rows : null;
                    break;
                default:
                    return $stmt->rowCount();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
