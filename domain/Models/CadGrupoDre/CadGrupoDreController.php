<?php

namespace MVC\Models\CadGrupoDre;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class CadGrupoDreController extends MVCController {

    protected CadGrupoDreService $service;
    protected                    $resource;

    public function __construct(CadGrupoDreService $service)
    {
        $this->service  = $service;
        $this->resource = CadGrupoDreResource::class;
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

    public function store(CadGrupoDreRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, CadGrupoDreRequest $request): JsonResponse
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
