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
        $data = $this->transformData($request->validated());

        $row = $this->service->create($data);

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

    public function transformData(array $request)
    {
        $tipo_item_model = $request['tipo_item_model'] == 'CadTipoEntrada' ? 'cad_tipo_entrada' : 'cad_tipo_saida';
        $campo_pesquisar = $request['tipo_item_model'] == 'CadTipoEntrada' ? 'id_tipo_entrada' : 'id_tipo_saida';

        return transformUuidToId($request, [
            ['tabela' => 'dre', 'chave_atribuir' => 'fk_id_dre', 'campo_pesquisar' => 'id_dre', 'uuid' => $request['fk_uuid_dre']],
            ['tabela' => 'cad_grupo_dre', 'chave_atribuir' => 'fk_id_grupo_dre', 'campo_pesquisar' => 'id_grupo_dre', 'uuid' => $request['fk_uuid_grupo_dre']],
            ['tabela' => $tipo_item_model, 'chave_atribuir' => 'tipo_item_id', 'campo_pesquisar' => $campo_pesquisar, 'uuid' => $request['tipo_item_uuid']],
        ]);
    }
}
