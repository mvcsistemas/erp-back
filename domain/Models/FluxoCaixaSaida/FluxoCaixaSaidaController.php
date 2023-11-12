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

        return $this->responseBuilder($rows);
    }

    public function show($uuid): JsonResponse
    {
        $row = $this->service->showByUuid($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(FluxoCaixaSaidaRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());
        $row  = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, FluxoCaixaSaidaRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());
        $this->service->updateByUuid($uuid, $data);

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }

    public function transformData(array $request)
    {
        return transformUuidToId($request, [
            ['tabela' => 'fluxo_caixa', 'chave_atribuir' => 'fk_id_fluxo_caixa', 'campo_pesquisar' => 'id_fluxo_caixa', 'uuid' => $request['fk_uuid_fluxo_caixa']],
            ['tabela' => 'cad_tipo_saida', 'chave_atribuir' => 'fk_id_tipo_saida', 'campo_pesquisar' => 'id_tipo_saida', 'uuid' => $request['fk_uuid_tipo_saida']],
            ['tabela' => 'cad_grupo_financeiro', 'chave_atribuir' => 'fk_id_grupo_financeiro', 'campo_pesquisar' => 'id_grupo_financeiro', 'uuid' => $request['fk_uuid_grupo_financeiro']],
        ]);
    }
}
