<?php

namespace MVC\Models\FluxoCaixa;

use MVC\Base\MVCRequest;

class FluxoCaixaRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'                       => '',
            'competencia_fluxo_caixa'    => 'required',
            'valor_liquido_fluxo_caixa'  => 'required',
            'fechamento_fluxo_caixa'     => 'required',
            'saldo_anterior_fluxo_caixa' => 'required',
            'saldo_dia_fluxo_caixa'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'competencia_fluxo_caixa.required'    => 'O campo Competência é obrigatório.',
            'valor_liquido_fluxo_caixa.required'  => 'O campo Valor líquido é obrigatório.',
            'fechamento_fluxo_caixa.required'     => 'O campo Fechamento é obrigatório.',
            'saldo_anterior_fluxo_caixa.required' => 'O campo Saldo anterior é obrigatório.',
            'saldo_dia_fluxo_caixa.required'      => 'O campo Saldo do dia é obrigatório.'
        ];
    }
}
