<?php

namespace MVC\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MVCService {

    public function index(): Builder
    {
        return $this->model->index();
    }

    public function lists(array $params): MVCModel
    {
        if (method_exists($this->model, 'lists')) {
            return $this->model->lists(array_merge(request()->all(), $params));
        }

        return [];
    }

    public function showById(int $id): MVCModel
    {
        return $this->model->showById($id);
    }

    public function showByUuid(string $uuid): MVCModel
    {
        return $this->model->showByUuid($uuid);
    }

    public function create(array $data): MVCModel
    {
        return $this->model->create($data);
    }

    public function updateByUuid(string $uuid, array $data): bool
    {
        return $this->model->updateRecordByUuid($uuid, $data);
    }

    public function updateById(int $id, array $data): bool
    {
        return $this->model->updateRecordById($id, $data);
    }

    public function deleteByUuid(string $uuid): bool
    {
        return $this->model->deleteRecordByUuid($uuid);
    }

    public function deleteById(int $id): bool
    {
        return $this->model->deleteRecordById($id);
    }

    public function lookup(array $params): Collection
    {
        if (method_exists($this->model, 'lookup')) {
            return $this->model->lookup($params);
        }

        return [];
    }

    public function filter(Builder $query, array $params): Builder
    {
        if (method_exists($this->model, 'filter')) {
            $query = $this->model->filter($query, $params);
        }

        return $query;
    }
}
