<?php

namespace MVC\Models\CadConsulta\CadConsultaImagem;

use MVC\Base\MVCService;
use MVC\Models\CadArquivoDigital\CadArquivoDigitalService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use MVC\Models\CadConsulta\CadConsulta;
use Illuminate\Support\Facades\Storage;

class CadConsultaImagemService extends MVCService {

    protected CadConsultaImagem $model;

    public function __construct(CadConsultaImagem $model)
    {
        $this->model = $model;
    }

    public function createUpload(string $uuid, array $request)
    {
        $consulta = CadConsulta::findByUuid($uuid);

        $path = $request['arq_conteudo']->store('consultaImagens');

        $payload = array_merge($request,['id_consulta' => $consulta->id_consulta,
                                          'path'        => $path]);

        return $this->model->create($payload);
    }

    public function updateUpload(string $uuid, int $id_arquivo, array $request)
    {
        if(isset($request['arq_conteudo'])){
            if(Storage::exists($request['path'])){
                Storage::delete($request['path']);
            }

            $request['path'] = $request['arq_conteudo']->store('consultaImagens');
        }


        return $this->updateById($id_arquivo, $request);
    }

    public function deleteUpload(int $id_arquivo)
    {
        $imagem = $this->model->findOrFail($id_arquivo);

        if(Storage::exists($imagem->path)){
            Storage::delete($imagem->path);
        }


        $imagem->delete();
    }


    public function download(int $id_arquivo)
    {
        $imagem = $this->model->findOrFail($id_arquivo);

        return Storage::download($imagem->path);
    }
}
