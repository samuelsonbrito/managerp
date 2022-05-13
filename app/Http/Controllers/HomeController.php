<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\DataTables\ColaboradorDashboardDataTable;
use PDF;

class HomeController extends Controller
{
    private $dashboardService;
    private $colaboradorDashboardDataTable;

    public function __construct(DashboardService $dashboardService, ColaboradorDashboardDataTable $colaboradorDashboardDataTable)
    {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
        $this->colaboradorDashboardDataTable = $colaboradorDashboardDataTable;
    }

    public function index()
    {
        return view('home');
    }

    public function conselhosPrestesVencer()
    {
        $query = $this->dashboardService->conselhosAVencer();
        return $this->colaboradorDashboardDataTable->with('dados', $query)->render('conselhos-prestes-vencer');

    }

    public function conselhosVencidos()
    {
        $query = $this->dashboardService->conselhosVencidos();
        return $this->colaboradorDashboardDataTable->with('dados', $query)->render('conselhos-vencidos');
    }

    public function alertaFeriasColaboradores()
    {
        $query = $this->dashboardService->alertaFerias();
        return $this->colaboradorDashboardDataTable->with('dados', $query)->render('alerta-ferias-colaboradores');
    }

    public function imprimirConselhosVencidos()
    {
        $query = $this->dashboardService->conselhosVencidos();
        $pdf = PDF::loadView('relatorios.dashboard.impressao-conselhos-vencidos', ['dados' => $query]);
        return $pdf->stream("conselhos-vencidos.pdf", array("Attachment" => false));
    }

    public function imprimirConselhosPrestesVencer()
    {
        $query = $this->dashboardService->conselhosAVencer();
        $pdf = PDF::loadView('relatorios.dashboard.impressao-conselhos-a-vencer', ['dados' => $query]);
        return $pdf->stream("conselhos-a-vencer.pdf", array("Attachment" => false));
    }

    public function imprimirAlertaFerias()
    {
        $query = $this->dashboardService->alertaFerias();
        $pdf = PDF::loadView('relatorios.dashboard.impressao-alerta-ferias-colaboradores', ['dados' => $query]);
        return $pdf->stream("alerta-ferias.pdf", array("Attachment" => false));
    }

    public function getTotalReceitas()
    {
        return $this->dashboardService->getTotalReceitas();
    }
}
