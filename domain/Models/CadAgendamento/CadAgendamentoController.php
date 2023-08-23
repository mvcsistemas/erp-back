<?php

namespace MVC\Models\CadAgendamento;

use MVC\Base\MVCController;
use Illuminate\Http\Request;

class CadAgendamentoController extends MVCController {

    protected CadAgendamentoService $service;
    protected                       $resource;
    protected                       $resourceCalendar;

    public function __construct(CadAgendamentoService $service)
    {
        $this->service          = $service;
        $this->resource         = CadAgendamentoResource::class;
        $this->resourceCalendar = CadAgendamentoResourceCalendar::class;
    }

    public function index()
    {
        $this->resource = $this->resourceCalendar;

        $rows = $this->service->index();

        return $this->responseBuilderWithoutPagination($rows);
    }

    public function show($uuid)
    {
        $row = $this->service->showByUuid($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(CadAgendamentoRequest $request)
    {
        $request['data_agendamento'] = setData($request['data_agendamento']);

        $row = $this->service->create($request->all());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, CadAgendamentoRequest $request)
    {
        $request['data_agendamento'] = setData($request['data_agendamento']);

        $this->service->updateByUuid($uuid, $request->all());

        return $this->responseBuilderRow([], false, 204);
    }

    public function updateDragDrop($uuid, Request $request)
    {
        $request['data_agendamento'] = setData($request['data_agendamento']);

        $this->service->updateByUuid($uuid, $request->only(['uuid', 'data_agendamento', 'hora_inicio', 'hora_fim']));

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid)
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }

    public function lookup(Request $request)
    {
        return $this->service->lookup($request->all());
    }

    public function confirmaAgendamento(Request $request)
    {
        return $this->service->confirmaAgendamento($request->all());
    }
}
