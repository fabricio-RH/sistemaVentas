<?php 
namespace App\Controllers;
use App\Models\VentasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use FPDF;

class Reportes extends BaseController {

    public function index() {
        if (!session()->get('is_logged')) { return redirect()->to(base_url('/')); }
        return view('reportes/index');
    }

    // --- GENERAR EXCEL ---
    public function excel() {
        $ventasModel = new VentasModel();
        // Hacemos una consulta uniendo tablas para obtener nombre del cliente
        $db = \Config\Database::connect();
        $builder = $db->table('ventas');
        $builder->select('ventas.id, ventas.fecha, ventas.total, clientes.nombre as cliente');
        $builder->join('clientes', 'clientes.id = ventas.id_cliente');
        $ventas = $builder->get()->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Encabezados
        $sheet->setCellValue('A1', 'ID Venta');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Cliente');
        $sheet->setCellValue('D1', 'Total');

        // Datos
        $fila = 2;
        foreach ($ventas as $v) {
            $sheet->setCellValue('A'.$fila, $v['id']);
            $sheet->setCellValue('B'.$fila, $v['fecha']);
            $sheet->setCellValue('C'.$fila, $v['cliente']);
            $sheet->setCellValue('D'.$fila, $v['total']);
            $fila++;
        }

        // Descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Reporte_Ventas.xlsx"');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // --- GENERAR PDF ---
    public function pdf() {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas');
        $builder->select('ventas.id, ventas.fecha, ventas.total, clientes.nombre as cliente');
        $builder->join('clientes', 'clientes.id = ventas.id_cliente');
        $ventas = $builder->get()->getResultArray();

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, 'Reporte de Ventas', 0, 1, 'C');
        $pdf->Ln(10);

        // Cabecera Tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, 'ID', 1);
        $pdf->Cell(50, 10, 'Fecha', 1);
        $pdf->Cell(80, 10, 'Cliente', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();

        // Datos
        $pdf->SetFont('Arial', '', 10);
        foreach ($ventas as $v) {
            $pdf->Cell(20, 10, $v['id'], 1);
            $pdf->Cell(50, 10, $v['fecha'], 1);
            $pdf->Cell(80, 10, utf8_decode($v['cliente']), 1);
            $pdf->Cell(30, 10, '$ ' . $v['total'], 1);
            $pdf->Ln();
        }

        $pdf->Output('D', 'Reporte_Ventas.pdf');
        exit;
    }
}