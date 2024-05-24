<?php

namespace App\Core;

use PDO;
use PDOException;
use App\Core\Exceptions\DatabaseException;

class Database
{
    private PDO $connection;
    private static ?Database $instance = null;

    private function __construct()
    {
        $dbConfig = Config::get('db');
        $host = $dbConfig['host'];
        $dbname = $dbConfig['name'];
        $username = $dbConfig['user'];
        $password = $dbConfig['password'];

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new DatabaseException("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(): ?Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = []): false|\PDOStatement
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new DatabaseException("Query failed: " . $e->getMessage());
        }
    }

    public function fetchAll(string $sql, array $params = [], string $class = 'stdClass'): false|array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function fetch(string $sql, array $params = [], string $class = 'stdClass')
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchObject($class);
    }

    public function insert(string $table, array $data): false|string
    {
        $keys = array_keys($data);
        $fields = implode(',', $keys);
        $placeholders = implode(',', array_map(function ($key) {
            return ":$key";
        }, $keys));
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";

        $this->query($sql, $data);
        return $this->connection->lastInsertId();
    }

    public function update(string $table, array $data, array $where): false|\PDOStatement
    {
        $fields = implode(',', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($data)));
        $whereClause = implode(' AND ', array_map(function ($key) {
            return "$key = :where_$key";
        }, array_keys($where)));
        $params = array_merge($data, array_combine(array_map(function ($key) {
            return "where_$key";
        }, array_keys($where)), $where));
        $sql = "UPDATE $table SET $fields WHERE $whereClause";

        return $this->query($sql, $params);
    }

    public function delete(string $table, array $where): false|\PDOStatement
    {
        $whereClause = implode(' AND ', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($where)));
        $sql = "DELETE FROM $table WHERE $whereClause";

        return $this->query($sql, $where);
    }
}
