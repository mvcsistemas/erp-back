<?php

namespace MVC\Models\FluxoCaixa;

use Illuminate\Validation\Rule;
use MVC\Base\MVCRequest;

class FluxoCaixaRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'                       => '',
            'competencia_fluxo_caixa'    => ['required', Rule::unique('fluxo_caixa')->where(function ($query) {
                return $query->where('uuid', '<>', request()->uuid);
            })],
            'valor_liquido_fluxo_caixa'  => 'required',
            'fechamento_fluxo_caixa'     => 'required',
            'saldo_anterior_fluxo_caixa' => 'required',
            'saldo_mensal_fluxo_caixa'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'competencia_fluxo_caixa.required'    => 'O campo Competência é obrigatório.',
            'competencia_fluxo_caixa.unique'      => 'Está competência já existe',
            'valor_liquido_fluxo_caixa.required'  => 'O campo Valor líquido é obrigatório.',
            'fechamento_fluxo_caixa.required'     => 'O campo Fechamento é obrigatório.',
            'saldo_anterior_fluxo_caixa.required' => 'O campo Saldo anterior é obrigatório.',
            'saldo_mensal_fluxo_caixa.required'   => 'O campo Saldo Mensal é obrigatório.'
        ];
    }
}
