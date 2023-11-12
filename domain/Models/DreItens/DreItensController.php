<?php

namespace MVC\Models\DreItens;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class DreItensController extends MVCController {

    protected DreItensService $service;
    protected                 $resource;

    public function __construct(DreItensService $service)
    {
        $this->service  = $service;
        $this->resource = DreItensResource::class;
    }

    public function index(): JsonResponse
    {
        $rows = $this->service->index();

        return $this->responseBuilder($rows);
    }

    public function show($uuid): JsonResponse
    {
        $row = $this->service->showByUuid($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(DreItensRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, DreItensRequest $request): JsonResponse
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
