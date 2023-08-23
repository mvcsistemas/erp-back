<?php

namespace MVC\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MVCModel extends Model {

    public $timestamps = false;

    public function index(): Builder
    {
        return $this->query();
    }

    public function showById(int $id): Builder
    {
        $query = $this->index();

        if (Is_Array($id)) {
            $params = $id;
        } else {
            if (Is_Array($this->primaryKey)) {
                $chave = $this->primaryKey[0];
            } else {
                $chave = $this->primaryKey;
            }

            $params[$chave] = $id;
        }

        return $this->filter($query, $params)->firstOrFail();
    }

    public function showByUuid(string $uuid): MVCModel
    {
        $query  = $this->index();
        $params = ['uuid' => $uuid];

        return $this->filter($query, $params)->firstOrFail();
    }

    public function updateRecordByUuid(string $uuid, array $data): bool
    {
        return $this->findByUuid($uuid)->update($data);
    }

    public function updateRecordById(int $id, array $data): bool
    {
        return $this->findOrFail($id)->update($data);
    }

    public function deleteRecordByUuid(string $uuid): bool
    {
        return $this->findByUuid($uuid)->delete();
    }

    public function deleteRecordById(int $id): bool
    {
        return $this->findOrFail($id)->delete();
    }
}
