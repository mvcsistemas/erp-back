<?php

namespace MVC\Models\FluxoCaixaSaida;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class FluxoCaixaSaidaController extends MVCController {

    protected FluxoCaixaSaidaService $service;
    protected                        $resource;

    public function __construct(FluxoCaixaSaidaService $service)
    {
        $this->service  = $service;
        $this->resource = FluxoCaixaSaidaResource::class;
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

    public function store(FluxoCaixaSaidaRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, FluxoCaixaSaidaRequest $request): JsonResponse
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
