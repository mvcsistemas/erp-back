<?php

namespace MVC\Models\CadTipoEntrada;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadTipoEntrada extends MVCModel {

    use HasUuid, HasFactory;

    protected $table      = 'cad_tipo_entrada';
    protected $primaryKey = 'id_tipo_entrada';
    protected $guarded    = ['id_tipo_entrada'];
    public    $timestamps = true;

    public function lookup(array $data): Collection
    {
        $rows = $this->select('uuid as value', 'dsc_tipo_entrada as label');
        $rows = $this->filter($rows, $data);

        return $rows->get();
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid             = (string)($params['uuid'] ?? '');
        $dsc_tipo_entrada = (string)($params['dsc_tipo_entrada'] ?? '');
        $tipo_ordenacao   = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao  = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('cad_tipo_entrada.uuid', $uuid);
            })
            ->when($dsc_tipo_entrada, function ($query) use ($dsc_tipo_entrada) {
                $query->where('cad_tipo_entrada.dsc_tipo_entrada', 'like', "%$dsc_tipo_entrada%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('cad_tipo_entrada.dsc_tipo_entrada');
            });
    }
}
