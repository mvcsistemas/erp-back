<?php

namespace MVC\Models\User;

use MVC\Base\MVCController;

class UserController extends MVCController {

    protected UserService   $service;
    protected               $resource;

    public function __construct(UserService $service)
    {
        $this->service  = $service;
        $this->resource = UserResource::class;
    }

    public function index()
    {
//        $this->authorize('view', auth()->user());

        $rows = $this->service->index();

        return $this->responseBuilder($rows);
    }

    public function show($uuid)
    {
//        $this->authorize('view', auth()->user());

        $row = $this->service->showByUuid($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(UserRequest $request)
    {

//        $this->authorize('create', auth()->user());

        $row = $this->service->create($request->all());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, UserRequest $request)
    {
//        $this->authorize('update', auth()->user());

        $this->service->updateByUuid($uuid, $request->all());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid)
    {
//        $this->authorize('delete', auth()->user());

        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }
}
