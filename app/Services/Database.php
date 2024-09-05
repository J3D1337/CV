<?php

namespace App\Services;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $conn;
    private string $table = '';
    private string $columns = '*';
    private array $where = [];
    private array $set = [];

    private function __construct()
    {
        $this->connect();
    }

    private function __clone() {}

    private function connect(): void
    {
        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log error message
            error_log($e->getMessage());
            echo "Database connection error.";
            exit;
        }
    }

    private function reset(): void
    {
        $this->columns = '*';
        $this->where = [];
        $this->set = [];
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }

    public function table(string $table): Database
    {
        $this->table = $table;
        return $this;
    }

    public function select(string|array $columns): Database
    {
        $this->columns = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function where($column, $operator, $value = null): Database
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }
        $this->where[] = [$column, $operator, $value];
        return $this;
    }

    public function set(array $data): Database
    {
        foreach ($data as $key => $value) {
            $this->set[] = "$key = ?";
        }
        return $this;
    }

    public function get(): array
    {
        $sql = "SELECT $this->columns FROM $this->table";

        if (!empty($this->where)) {
            $whereParts = [];
            foreach ($this->where as $condition) {
                $whereParts[] = $condition[0] . " " . $condition[1] . " ?";
            }
            $sql .= " WHERE " . implode(" AND ", $whereParts);
        }

        $stmt = $this->conn->prepare($sql);

        $params = array_map(function ($condition) {
            return $condition[2];
        }, $this->where);

        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo "Database query error.";
            exit;
        }

        $this->reset();
        return $stmt->fetchAll();
    }

    public function find($id, $column = 'id'): ?array
    {
        return $this->where($column, '=', $id)->get()[0] ?? null;
    }

    public function first(): ?array
    {
        return $this->get()[0] ?? null;
    }

    public function insert(array $data): bool|int
    {
        $this->columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO $this->table ($this->columns) VALUES ($placeholders)";

        $stmt = $this->conn->prepare($sql);
        $this->reset();

        try {
            if ($stmt->execute(array_values($data))) {
                return (int) $this->conn->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo "Database insert error.";
            exit;
        }

        return false;
    }

    public function update(array $data): bool
    {
        if (empty($this->set)) {
            throw new \Exception("No fields to update. Use the 'set' method before calling 'update'.");
        }

        $setClause = implode(", ", $this->set);
        $sql = "UPDATE $this->table SET $setClause";

        if (!empty($this->where)) {
            $whereParts = [];
            foreach ($this->where as $condition) {
                $whereParts[] = $condition[0] . " " . $condition[1] . " ?";
            }
            $sql .= " WHERE " . implode(" AND ", $whereParts);
        }

        $stmt = $this->conn->prepare($sql);

        $params = array_merge(
            array_values($data),
            array_map(function ($condition) {
                return $condition[2];
            }, $this->where)
        );

        $this->reset();

        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo "Database update error.";
            exit;
        }
    }

    public function delete(): bool
    {
        if (empty($this->where)) {
            throw new \Exception("No conditions specified for delete. Use the 'where' method before calling 'delete'.");
        }

        $sql = "DELETE FROM $this->table";

        if (!empty($this->where)) {
            $whereParts = [];
            foreach ($this->where as $condition) {
                $whereParts[] = $condition[0] . " " . $condition[1] . " ?";
            }
            $sql .= " WHERE " . implode(" AND ", $whereParts);
        }

        $stmt = $this->conn->prepare($sql);

        $params = array_map(function ($condition) {
            return $condition[2];
        }, $this->where);

        $this->reset();

        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo "Database delete error.";
            exit;
        }
    }
}
