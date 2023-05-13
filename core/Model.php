<?php

class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->table = strtolower(str_replace('Model', '', get_class($this))) . 's';
    }

    public function selectAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $fieldsWithPlaceholders = '';
        foreach ($data as $key => $value) {
            $fieldsWithPlaceholders .= "{$key} = :{$key}, ";
        }
        $fieldsWithPlaceholders = rtrim($fieldsWithPlaceholders, ', ');

        $data['id'] = $id;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$fieldsWithPlaceholders} WHERE id = :id");
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}