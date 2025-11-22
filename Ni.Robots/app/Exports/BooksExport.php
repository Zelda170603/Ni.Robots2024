<?php

namespace App\Exports;

use App\Models\Book;
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
use Carbon\Carbon;

class BooksExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Book::query();

        if (!empty($this->filters['autor_id'])) {
            $query->where('autor_id', $this->filters['autor_id']);
        }

        if (!empty($this->filters['editorial_id'])) {
            $query->where('editorial_id', $this->filters['editorial_id']);
        }

        if (!empty($this->filters['categoria'])) {
            $query->where('categoria', $this->filters['categoria']);
        }

        if (!empty($this->filters['grupo_usuarios'])) {
            $query->where('grupo_usuarios', $this->filters['grupo_usuarios']);
        }

        if (!empty($this->filters['fecha_publicacion_min']) && !empty($this->filters['fecha_publicacion_max'])) {
            $query->whereBetween('fecha_publicacion', [$this->filters['fecha_publicacion_min'], $this->filters['fecha_publicacion_max']]);
        } elseif (!empty($this->filters['fecha_publicacion_min'])) {
            $query->where('fecha_publicacion', '>=', $this->filters['fecha_publicacion_min']);
        } elseif (!empty($this->filters['fecha_publicacion_max'])) {
            $query->where('fecha_publicacion', '<=', $this->filters['fecha_publicacion_max']);
        }

        if (!empty($this->filters['paginas_min']) && !empty($this->filters['paginas_max'])) {
            $query->whereBetween('paginas', [$this->filters['paginas_min'], $this->filters['paginas_max']]);
        } elseif (!empty($this->filters['paginas_min'])) {
            $query->where('paginas', '>=', $this->filters['paginas_min']);
        } elseif (!empty($this->filters['paginas_max'])) {
            $query->where('paginas', '<=', $this->filters['paginas_max']);
        }

        $books = $query->with(['autor', 'editorial'])->get();

        // Si no hay libros
        if ($books->isEmpty()) {
            return collect([
                ['No se encontraron libros con los filtros aplicados'],
                [''],
                ['Filtros aplicados:', $this->getFiltrosAplicados()]
            ]);
        }

        // Transformar datos para el reporte
        return $books->values()->map(function($book, $index) {
            return [
                'N°' => $index + 1,
                'TÍTULO' => $book->titulo,
                'AUTOR' => $book->autor->nombre ?? 'N/A',
                'EDITORIAL' => $book->editorial->nombre ?? 'N/A',
                'CATEGORÍA' => $book->categoria,
                'GRUPO USUARIOS' => $book->grupo_usuarios,
                'FECHA PUBLICACIÓN' => $book->fecha_publicacion ? Carbon::parse($book->fecha_publicacion)->format('d/m/Y') : 'N/A',
                'ISBN' => $book->isbn ?? 'N/A',
                'PÁGINAS' => $book->paginas ?: 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            ['REPORTE DE LIBROS'], // Fila 1 - Título
            ['Filtros: ' . $this->getFiltrosAplicados()], // Fila 2 - Filtros
            [], // Fila 3 - Vacía
            [ // Fila 4 - Encabezados de columnas
                'N°',
                'TÍTULO',
                'AUTOR',
                'EDITORIAL',
                'CATEGORÍA',
                'GRUPO USUARIOS',
                'FECHA PUBLICACIÓN',
                'ISBN',
                'PÁGINAS',
            ]
        ];
    }

    public function title(): string
    {
        return 'Reporte Libros';
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
        ]);

        // Filtros aplicados (Fila 2)
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['italic' => true, 'size' => 11, 'color' => ['rgb' => '000000']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Encabezados columnas (Fila 4)
        $sheet->getStyle('A4:I4')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Datos de libros (Filas 5 en adelante)
        if ($totalDataRows > 0) {
            // Filas alternadas
            for ($row = 5; $row <= $totalRows; $row++) {
                $color = $row % 2 == 0 ? 'FFFFFF' : 'F2F2F2';
                $sheet->getStyle("A{$row}:I{$row}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->setStartColor(new Color($color));
            }
        }

        // Alineaciones
        $sheet->getStyle('A:A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G:G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I:I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B:F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('H:H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

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
            'B' => 35,  // TÍTULO
            'C' => 25,  // AUTOR
            'D' => 20,  // EDITORIAL
            'E' => 15,  // CATEGORÍA
            'F' => 18,  // GRUPO USUARIOS
            'G' => 15,  // FECHA PUBLICACIÓN
            'H' => 18,  // ISBN
            'I' => 10,  // PÁGINAS
        ];
    }

    private function getFiltrosAplicados()
    {
        $filtros = [];

        if (!empty($this->filters['categoria'])) {
            $filtros[] = "Categoría: {$this->filters['categoria']}";
        }

        if (!empty($this->filters['grupo_usuarios'])) {
            $filtros[] = "Grupo: {$this->filters['grupo_usuarios']}";
        }

        if (!empty($this->filters['autor_id'])) {
            $filtros[] = "Autor ID: {$this->filters['autor_id']}";
        }

        if (!empty($this->filters['editorial_id'])) {
            $filtros[] = "Editorial ID: {$this->filters['editorial_id']}";
        }

        if (!empty($this->filters['fecha_publicacion_min']) || !empty($this->filters['fecha_publicacion_max'])) {
            $rango = [];
            if (!empty($this->filters['fecha_publicacion_min'])) {
                $rango[] = Carbon::parse($this->filters['fecha_publicacion_min'])->format('d/m/Y');
            }
            $rango[] = ' - ';
            if (!empty($this->filters['fecha_publicacion_max'])) {
                $rango[] = Carbon::parse($this->filters['fecha_publicacion_max'])->format('d/m/Y');
            }
            $filtros[] = "Fecha: " . implode('', $rango);
        }

        if (!empty($this->filters['paginas_min']) || !empty($this->filters['paginas_max'])) {
            $rango = [];
            if (!empty($this->filters['paginas_min'])) {
                $rango[] = $this->filters['paginas_min'];
            }
            $rango[] = ' - ';
            if (!empty($this->filters['paginas_max'])) {
                $rango[] = $this->filters['paginas_max'];
            }
            $filtros[] = "Páginas: " . implode('', $rango);
        }

        return $filtros ? implode(' | ', $filtros) : 'Todos los libros';
    }
}