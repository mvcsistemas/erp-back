<?php

namespace MVC\Models\CadTipoSaida;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadTipoSaida extends MVCModel {

    use HasUuid, HasFactory;

    protected $table      = 'cad_tipo_saida';
    protected $primaryKey = 'id_tipo_saida';
    protected $guarded    = ['id_tipo_saida'];
    public    $timestamps = true;

    public function lookup(array $data): Collection
    {
        $rows = $this->select('uuid as value', 'dsc_tipo_saida as label');
        $rows = $this->filter($rows, $data);

        return $rows->get();
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $dsc_tipo_saida  = (string)($params['dsc_tipo_saida'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('cad_tipo_saida.uuid', $uuid);
            })
            ->when($dsc_tipo_saida, function ($query) use ($dsc_tipo_saida) {
                $query->where('cad_tipo_saida.dsc_tipo_saida', 'like', "%$dsc_tipo_saida%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('cad_tipo_saida.dsc_tipo_saida');
            });
    }
}
