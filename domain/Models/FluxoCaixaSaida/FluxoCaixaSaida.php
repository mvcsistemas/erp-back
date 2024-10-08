<?php

namespace MVC\Models\FluxoCaixaSaida;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MVC\Base\MVCModel;
use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Services\UpdateValuesDre;
use MVC\Services\UpdateValuesFluxoCaixa;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FluxoCaixaSaida extends MVCModel {

    use HasUuid;

    protected $table      = 'fluxo_caixa_saida';
    protected $primaryKey = 'id_fluxo_caixa_saida';
    protected $guarded    = ['id_fluxo_caixa_saida'];
    public    $timestamps = true;

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->updateSaldoFluxoCaixa($model->fk_id_fluxo_caixa);
            $model->updateSaldoDreFluxoCaixaSaida($model);
        });

        self::updated(function ($model) {
            $model->updateSaldoFluxoCaixa($model->fk_id_fluxo_caixa);
            $model->updateSaldoDreFluxoCaixaSaida($model);
        });

        self::deleted(function ($model) {
            $model->updateSaldoFluxoCaixa($model->fk_id_fluxo_caixa);
            $model->updateSaldoDreFluxoCaixaSaida($model);
        });
    }

    public function index(): Builder
    {
        return $this->select('fluxo_caixa_saida.uuid',
            'fluxo_caixa_saida.data_fluxo_caixa_saida',
            'fluxo_caixa_saida.valor_fluxo_caixa_saida',
            'cad_tipo_saida.uuid as fk_uuid_tipo_saida',
            'cad_tipo_saida.dsc_tipo_saida as dsc_tipo_saida',
            'fluxo_caixa.uuid as fk_uuid_fluxo_caixa',
            'cad_grupo_financeiro.uuid as fk_uuid_grupo_financeiro',
            'cad_grupo_financeiro.dsc_grupo_financeiro as dsc_grupo_financeiro')
                    ->join('cad_tipo_saida', 'cad_tipo_saida.id_tipo_saida', 'fluxo_caixa_saida.fk_id_tipo_saida')
                    ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_saida.fk_id_fluxo_caixa')
                    ->join('cad_grupo_financeiro', 'cad_grupo_financeiro.id_grupo_financeiro', 'fluxo_caixa_saida.fk_id_grupo_financeiro');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                      = (string)($params['uuid'] ?? '');
        $fk_uuid_fluxo_caixa       = (string)($params['fk_uuid_fluxo_caixa'] ?? '');
        $data_fluxo_caixa_saida    = (string)($params['data_fluxo_caixa_saida'] ?? '');
        $valor_fluxo_caixa_saida = (float)($params['valor_fluxo_caixa_saida'] ?? 0);
        $dsc_tipo_saida            = (string)($params['dsc_tipo_saida'] ?? '');
        $dsc_grupo_financeiro      = (string)($params['dsc_grupo_financeiro'] ?? '');
        $tipo_ordenacao            = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao           = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('fluxo_caixa_saida.uuid', $uuid);
            })
            ->when($fk_uuid_fluxo_caixa, function ($query) use ($fk_uuid_fluxo_caixa) {
                $query->where('fluxo_caixa.uuid', $fk_uuid_fluxo_caixa);
            })
            ->when($data_fluxo_caixa_saida, function ($query) use ($data_fluxo_caixa_saida) {
                $query->whereDate('fluxo_caixa_saida.data_fluxo_caixa_saida', $data_fluxo_caixa_saida);
            })
            ->when($dsc_tipo_saida, function ($query) use ($dsc_tipo_saida) {
                $query->where('cad_tipo_saida.dsc_tipo_saida', 'like', "%$dsc_tipo_saida%");
            })
            ->when($valor_fluxo_caixa_saida, function ($query) use ($valor_fluxo_caixa_saida) {
                $query->where('fluxo_caixa_saida.valor_fluxo_caixa_saida', $valor_fluxo_caixa_saida);
            })
            ->when($dsc_grupo_financeiro, function ($query) use ($dsc_grupo_financeiro) {
                $query->where('cad_grupo_financeiro.dsc_grupo_financeiro', 'like', "%$dsc_grupo_financeiro%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('fluxo_caixa_saida.data_fluxo_caixa_saida');
            });
    }

    public function fluxoCaixa(): BelongsTo
    {
        return $this->belongsTo(FluxoCaixa::class, 'fk_id_fluxo_caixa', 'id_fluxo_caixa');
    }

    public function updateSaldoFluxoCaixa(int $fk_id_fluxo_caixa)
    {
        $service = app()->make(UpdateValuesFluxoCaixa::class);
        $service->updateSaldoFluxoCaixa($fk_id_fluxo_caixa);
    }

    public function updateSaldoDreFluxoCaixaSaida(FluxoCaixaSaida $model)
    {
        $service = app()->make(UpdateValuesDre::class);
        $service->updateSaldoDreFluxoCaixaSaida($model);
    }
}
