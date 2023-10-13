<?php

namespace MVC\Models\CadTipoEntrada;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class CadTipoEntradaController extends MVCController {

    protected CadTipoEntradaService $service;
    protected                       $resource;

    public function __construct(CadTipoEntradaService $service)
    {
        $this->service  = $service;
        $this->resource = CadTipoEntradaResource::class;
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

    public function store(CadTipoEntradaRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validate());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, CadTipoEntradaRequest $request): JsonResponse
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
