<?php

namespace MVC\Models\CadConsulta\CadConsultaImagem;

use MVC\Base\MVCController;
use Illuminate\Http\Request;
use MVC\Models\CadConsulta\CadConsulta;

class CadConsultaImagemController extends MVCController {

    protected CadConsultaImagemService $service;
    protected                          $resource;

    public function __construct(CadConsultaImagemService $service)
    {
        $this->service  = $service;
        $this->resource = CadConsultaImagemResource::class;
    }

    public function lists($uuid)
    {
        $rows = $this->service->lists(['uuid' => $uuid]);

        return $this->responseBuilder($rows);
    }

    public function show(string $uuid, int $id)
    {
        $row = $this->service->showById($id);

        return $this->responseBuilderRow($row);
    }

    public function store(string $uuid, CadConsultaImagemRequest $request)
    {
        $row = $this->service->createUpload($uuid, $request->all());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update(string $uuid, int $id_arquivo, Request $request)
    {
        $this->service->updateUpload($uuid, $id_arquivo, $request->all());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy(string $uuid, int $id_arquivo)
    {
        $this->service->deleteUpload($id_arquivo);

        return $this->responseBuilderRow([], false, 204);
    }

    public function download(string $uuid, int $id_arquivo)
    {
        return $this->service->download($id_arquivo);
    }
}
