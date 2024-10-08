<?php

namespace MVC\Models\FluxoCaixa;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class FluxoCaixaController extends MVCController {

    protected FluxoCaixaService $service;
    protected                   $resource;

    public function __construct(FluxoCaixaService $service)
    {
        $this->service  = $service;
        $this->resource = FluxoCaixaResource::class;
    }

    public function index(): JsonResponse
    {
        $rows = $this->service->index();

        return $this->responseBuilder($rows);
    }

    public function show($uuid): JsonResponse
    {
        $row                        = $this->service->showByUuid($uuid);
        $row->saldo_dia_fluxo_caixa = $this->service->balanceDay($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(FluxoCaixaRequest $request): JsonResponse
    {
        $this->authorize('create', FluxoCaixa::class);

        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, FluxoCaixaRequest $request): JsonResponse
    {
        $this->authorize('checkIfFluxoCaixaIsOpen', [FluxoCaixa::class, $request->all()]);

        $this->service->updateByUuid($uuid, $request->validated());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->authorize('checkIfFluxoCaixaIsOpen', [FluxoCaixa::class, ['uuid' => $uuid]]);

        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }

    public function closeFluxoCaixa(Request $request): JsonResponse
    {
        $this->service->updateByUuid($request->uuid, ['fechamento_fluxo_caixa' => '0']);

        return $this->responseBuilderRow([], false, 204);
    }

    public function checkOpenFluxoCaixa(): JsonResponse
    {
        $data = $this->service->checkOpenFluxoCaixa();

        return $this->responseBuilderRow($data, false);
    }

    public function getSaldoAnteriorFluxoCaixa(): JsonResponse
    {
        $data = $this->service->getSaldoAnteriorFluxoCaixa();

        return $this->responseBuilderRow($data, false);
    }
}
