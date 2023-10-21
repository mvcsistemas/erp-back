<?php

namespace MVC\Models\DreGrupo;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class DreGrupoController extends MVCController {

    protected DreGrupoService $service;
    protected                   $resource;

    public function __construct(DreGrupoService $service)
    {
        $this->service  = $service;
        $this->resource = DreGrupoResource::class;
    }

    public function index(): JsonResponse
    {
        $rows = $this->service->index();

        return $this->responseBuilderWithoutPagination($rows);
    }

    public function show($uuid): JsonResponse
    {
        $row = $this->service->showByUuid($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(DreGrupoRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, DreGrupoRequest $request): JsonResponse
    {
        $this->service->updateByUuid($uuid, $request->validated());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }
}
