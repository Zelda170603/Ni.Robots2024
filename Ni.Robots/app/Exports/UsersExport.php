<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class UsersExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = User::with(['role']);

        if (!empty($this->filters['role_type'])) {
            $query->whereHas('role', function($q) {
                $q->where('role_type', $this->filters['role_type']);
            });
        }

        if (!empty($this->filters['estado'])) {
            $query->where('estado', $this->filters['estado']);
        }

        if (!empty($this->filters['departamento'])) {
            $query->where('departamento', 'like', '%' . $this->filters['departamento'] . '%');
        }

        if (!empty($this->filters['municipio'])) {
            $query->where('municipio', 'like', '%' . $this->filters['municipio'] . '%');
        }

        if (!empty($this->filters['fecha_creacion_min']) && !empty($this->filters['fecha_creacion_max'])) {
            $query->whereBetween('created_at', [$this->filters['fecha_creacion_min'], $this->filters['fecha_creacion_max']]);
        } elseif (!empty($this->filters['fecha_creacion_min'])) {
            $query->where('created_at', '>=', $this->filters['fecha_creacion_min']);
        } elseif (!empty($this->filters['fecha_creacion_max'])) {
            $query->where('created_at', '<=', $this->filters['fecha_creacion_max']);
        }

        $users = $query->get();

        // Si no hay usuarios
        if ($users->isEmpty()) {
            return collect([
                ['No se encontraron usuarios con los filtros aplicados'],
                [''],
                ['Filtros aplicados:', $this->getFiltrosAplicados()]
            ]);
        }

        // Transformar datos para el reporte
        return $users->values()->map(function($user, $index) {
            return [
                'N°' => $index + 1,
                'NOMBRE' => $user->name,
                'EMAIL' => $user->email,
                'ROL' => $user->role ? $user->role->role_type : 'Sin rol',
                'ESTADO' => $user->estado ? 'Activo' : 'Inactivo',
                'DEPARTAMENTO' => $user->departamento ?? 'N/A',
                'MUNICIPIO' => $user->municipio ?? 'N/A',
                'DOMICILIO' => $user->domicilio ?? 'N/A',
                'FECHA REGISTRO' => $user->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            ['REPORTE DE USUARIOS'], // Fila 1 - Título
            ['Filtros: ' . $this->getFiltrosAplicados()], // Fila 2 - Filtros
            [], // Fila 3 - Vacía
            [ // Fila 4 - Encabezados de columnas
                'N°',
                'NOMBRE',
                'EMAIL',
                'ROL',
                'ESTADO',
                'DEPARTAMENTO',
                'MUNICIPIO',
                'DOMICILIO',
                'FECHA REGISTRO',
            ]
        ];
    }

    public function title(): string
    {
        return 'Reporte Usuarios';
    }

    public function styles(Worksheet $sheet)
    {
        $dataCollection = $this->collection();
        $totalDataRows = count($dataCollection);
        $totalRows = $totalDataRows + 4; // 1:Título, 2:Filtros, 3:Vacía, 4:Encabezados

        // Fuente general
        $sheet->getStyle("A1:I{$totalRows}")->getFont()->setName('Calibri')->setSize(11);

        // Título principal (Fila 1)
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2F75B5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            // SIN BORDES
        ]);

        // Filtros aplicados (Fila 2)
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['italic' => true, 'size' => 11, 'color' => ['rgb' => '000000']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
            // SIN BORDES
        ]);

        // Encabezados columnas (Fila 4)
        $sheet->getStyle('A4:I4')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            // SIN BORDES
        ]);

        // Datos de usuarios (Filas 5 en adelante) - SIN BORDES
        if ($totalDataRows > 0) {
            // Solo filas alternadas, sin bordes
            for ($row = 5; $row <= $totalRows; $row++) {
                $color = $row % 2 == 0 ? 'FFFFFF' : 'F2F2F2';
                $sheet->getStyle("A{$row}:I{$row}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->setStartColor(new Color($color));
            }
        }

        // Alineaciones
        $sheet->getStyle('A:A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E:E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I:I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B:D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('F:H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Altura filas
        $sheet->getRowDimension(1)->setRowHeight(30); // Título más alto
        $sheet->getRowDimension(2)->setRowHeight(25); // Filtros
        $sheet->getRowDimension(3)->setRowHeight(5);  // Espacio vacío
        $sheet->getRowDimension(4)->setRowHeight(25); // Encabezados
        
        for ($row = 5; $row <= $totalRows; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(20); // Datos
        }

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // N°
            'B' => 25,  // NOMBRE
            'C' => 30,  // EMAIL
            'D' => 15,  // ROL
            'E' => 12,  // ESTADO
            'F' => 18,  // DEPARTAMENTO
            'G' => 18,  // MUNICIPIO
            'H' => 25,  // DOMICILIO
            'I' => 18,  // FECHA REGISTRO
        ];
    }

    private function getFiltrosAplicados()
    {
        $filtros = [];

        if (!empty($this->filters['role_type'])) {
            $filtros[] = "Rol: {$this->filters['role_type']}";
        }

        if (!empty($this->filters['estado'])) {
            $estado = $this->filters['estado'] == 1 ? 'Activos' : 'Inactivos';
            $filtros[] = "Estado: {$estado}";
        }

        if (!empty($this->filters['departamento'])) {
            $filtros[] = "Depto: {$this->filters['departamento']}";
        }

        if (!empty($this->filters['municipio'])) {
            $filtros[] = "Municipio: {$this->filters['municipio']}";
        }

        return $filtros ? implode(' | ', $filtros) : 'Todos los usuarios';
    }
}