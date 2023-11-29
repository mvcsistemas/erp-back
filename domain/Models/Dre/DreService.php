<?php

namespace MVC\Models\Dre;

use Illuminate\Support\Facades\DB;
use MVC\Base\MVCService;
use MVC\Models\CadGrupoDre\CadGrupoDre;

class DreService extends MVCService {

    protected Dre $model;

    public function __construct(Dre $model)
    {
        $this->model = $model;
    }

    public function checkOpenDre(): int
    {
        return $this->model->where('fechamento_dre', 1)->count();
    }

    public function summaryDre(string $uuid)
    {
        $receita_bruta           = $this->getReceitaBruta();
        $impostos_deducoes       = $this->getImpostosDeducoes();
        $receita_liquida         = $receita_bruta - $impostos_deducoes;
        $custos                  = $this->getCustos();
        $lucro_bruto             = $receita_liquida - $custos;
        $despesas_operacionais   = $this->getDespesasOperacionais();
        $ebitda                  = $lucro_bruto - $despesas_operacionais;
        $depreciacao_amortizacao = $this->getDepreciacaoAmortizacao();
        $ebit                    = $ebitda - $depreciacao_amortizacao;
        $juros_impostos          = $this->getJurosImpostos();
        $lucro_liquido           = $ebit - $juros_impostos;

        $payload = [
            [
                "grupo" => "Receita Bruta",
                "valor" => $receita_bruta,
                "classes" => "bg-red"
            ],
            [
                "grupo" => "(-) Impostos e Deduções",
                "valor" => $impostos_deducoes
            ],
            [
                "grupo" => "Receita Líquida",
                "valor" => $receita_liquida
            ],
            [
                "grupo" => "(-) Custos",
                "valor" => $custos
            ],
            [
                "grupo" => "Lucro Bruto",
                "valor" => $lucro_bruto
            ],
            [
                "grupo" => "(-) Despesas Operacionais",
                "valor" => $despesas_operacionais
            ],
            [
                "grupo" => "EBITDA",
                "valor" => $ebitda
            ],
            [
                "grupo" => "(-) Depreciação e Amortização",
                "valor" => $depreciacao_amortizacao
            ],
            [
                "grupo" => "EBIT",
                "valor" => $ebit
            ],
            [
                "grupo" => "(-) Juros e Impostos",
                "valor" => $juros_impostos
            ],
            [
                "grupo" => "Lucro Líquido",
                "valor" => $lucro_liquido
            ],
        ];

        return $payload;
    }

    public function getCalculoGrupoDre (int $id_grupo_dre)
    {
        return CadGrupoDre::join('dre_itens as item', 'item.fk_id_grupo_dre', 'cad_grupo_dre.id_grupo_dre')
                            ->where('id_grupo_dre', $id_grupo_dre)
                            ->sum('item.valor_dre_item');
    }

    public function getReceitaBruta ()
    {
        return $this->getCalculoGrupoDre(1);
    }

    public function getImpostosDeducoes ()
    {
        return $this->getCalculoGrupoDre(2);
    }

    public function getCustos ()
    {
        return $this->getCalculoGrupoDre(3);
    }

    public function getDespesasOperacionais ()
    {
        return $this->getCalculoGrupoDre(4);
    }

    public function getDepreciacaoAmortizacao ()
    {
        return $this->getCalculoGrupoDre(5);
    }

    public function getJurosImpostos ()
    {
        return $this->getCalculoGrupoDre(6);
    }
}
