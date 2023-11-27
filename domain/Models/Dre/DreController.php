<?php

namespace MVC\Models\Dre;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class DreController extends MVCController {

    protected DreService $service;
    protected                   $resource;

    public function __construct(DreService $service)
    {
        $this->service  = $service;
        $this->resource = DreResource::class;
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

    public function store(DreRequest $request): JsonResponse
    {
        $this->authorize('create', Dre::class);

        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, DreRequest $request): JsonResponse
    {
        $this->authorize('checkIfDreIsOpen', [Dre::class, $request->all()]);

        $this->service->updateByUuid($uuid, $request->validated());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->authorize('checkIfDreIsOpen', [Dre::class, ['uuid' => $uuid]]);

        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }

    public function checkOpenDre(): JsonResponse
    {
        $data = $this->service->checkOpenDre();

        return $this->responseBuilderRow($data, false);
    }

    public function closeDre(Request $request): JsonResponse
    {
        $this->service->updateByUuid($request->uuid, ['fechamento_dre' => '0']);

        return $this->responseBuilderRow([], false, 204);
    }
}
