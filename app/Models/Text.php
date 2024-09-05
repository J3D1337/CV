<?php 

namespace App\Models;

class Text extends Model
{
    protected string $table = 'texts';

    public function create(array $data): bool|int
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }

    public function find(int $id): ?array
    {
        return $this->db->table($this->table)->where('id', $id)->first();
    }

    public function getAll(): array
    {
        return $this->db->table($this->table)->get();
    }
}
