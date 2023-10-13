<?php

namespace MVC\Models\FluxoCaixaEntrada;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class FluxoCaixaEntradaController extends MVCController {

    protected FluxoCaixaEntradaService $service;
    protected                   $resource;

    public function __construct(FluxoCaixaEntradaService $service)
    {
        $this->service  = $service;
        $this->resource = FluxoCaixaEntradaResource::class;
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

    public function store(FluxoCaixaEntradaRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validate());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, FluxoCaixaEntradaRequest $request): JsonResponse
    {
        $this->service->updateByUuid($uuid, $request->validate());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }
}
