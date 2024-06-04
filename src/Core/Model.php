<?php

namespace App\Core;

class Model
{
    protected static string $table;
    protected static ?string $parentKey = null;

    public static function all(): false|array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM " . static::$table;
        return $db->fetchAll($sql, [], static::class);
    }

    public static function find(int $id)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM " . static::$table . " WHERE id = :id";
        return $db->fetch($sql, ['id' => $id], static::class);
    }

    public static function where($field, $value): false|array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM " . static::$table . " WHERE $field = :value";
        return $db->fetchAll($sql, ['value' => $value], static::class);
    }

    public static function create($data): false|string
    {
        $db = Database::getInstance();
        return $db->insert(static::$table, $data);
    }

    public static function update($id, $data): false|\PDOStatement
    {
        $db = Database::getInstance();
        return $db->update(static::$table, $data, ['id' => $id]);
    }

    public static function delete($id): false|\PDOStatement
    {
        $db = Database::getInstance();
        return $db->delete(static::$table, ['id' => $id]);
    }

    public function deleteWithChildren(): bool|\PDOStatement
    {
        // Check if the model has a static property called 'parentKey'
        if (property_exists(static::class, 'parentKey')) {
            // Retrieve children associated with this model instance
            $children = static::where(static::$parentKey, $this->id);
            // Delete each child
            foreach ($children as $child) {
                $child->delete();
            }
        }
        // Finally, delete the model itself
        return static::delete($this->id);
    }
}
