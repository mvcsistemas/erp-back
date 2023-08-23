<?php

namespace MVC\Models\CadConsulta;

use MVC\Base\MVCService;
use MVC\Models\CadPaciente\CadPaciente;
use MVC\Models\CadPodologo\CadPodologo;
use Barryvdh\DomPDF\Facade\Pdf;

class CadConsultaService extends MVCService {

    protected CadConsulta $model;

    public function __construct(CadConsulta $model)
    {
        $this->model = $model;
    }

    public function create($data){
        $consulta = $this->model->create($data);
        $paciente = CadPaciente::find($consulta['id_paciente']);
        $podologo = CadPodologo::find($consulta['id_podologo']);

        $paciente->sendObrigadoPelaConsultaNotification($consulta, $paciente, $podologo);

        return $consulta;
    }

    public function termoAceitacao($uuid)
    {
        $paciente      = CadPaciente::findByUuid($uuid);
        $paciente->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $paciente->cpf);
        $pdf           = Pdf::loadview('consulta.termo_aceitacao', compact('paciente'));

        return $pdf->download('termo_aceitacao.pdf');
    }

    public function recibo($uuid)
    {
        $consulta = CadConsulta::where('cad_consulta.uuid', $uuid)
                                ->join('cad_paciente', 'cad_paciente.id_paciente', 'cad_consulta.id_paciente')
                                ->first();

        $consulta->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $consulta->cpf);

        $pdf   = Pdf::loadview('consulta.recibo', compact('consulta'));

        return $pdf->download('recibo_' . $consulta->id_consulta . '.pdf');
    }

    public function historicoConsultaPdf($data, $id_paciente){
        $paciente      = CadPaciente::find($id_paciente);
        $paciente->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $paciente->cpf);

        $consultas = $data;

        $tempo = [
            'data_inicio' => request()->data_inicio,
            'data_fim' => request()->data_fim,
        ];

        $pdf = Pdf::loadview('consulta.historico_paciente', compact('consultas', 'paciente', 'tempo'));

        return $pdf->download('historico_paciente.pdf');
    }
}
