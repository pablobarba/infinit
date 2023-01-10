<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;

class profExport implements FromView, WithEvents
{
    use RegistersEventListeners;
    private $collection;
    private $dayReport;

    public function __construct($collection,$dayReport)
    {

        $this->collection = $collection;
        $this->dayReport = $dayReport;
    }

    public function view(): View
    {
        return view("report/reportFile", ['collection' => $this->collection,'dayReport' => $this->dayReport]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Arial', 'size' => 10]
        ];

        $strikethrough = [
            'font' => ['strikethrough' => true],
        ];

        // Get Worksheet
        $active_sheet = $event->sheet->getDelegate();

        // Apply Style Arrays
        $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);

        $active_sheet->getStyle('A1:J6')->getFont()->setBold(true);

        $active_sheet->getStyle('A10:Z10')->getFont()->setBold(true);

        $cellRange = 'A10:S11'; // All headers
        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $event->sheet->setAutoFilter($cellRange);

        $event->sheet->getStyle($cellRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ])->getAlignment()->setWrapText(true);

        $style = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $event->sheet->getStyle($cellRange)->applyFromArray($style);
        $style = array(
            'font' => [
                'name' => 'Century Gothic',
                'size' => 11,
                'bold' => true,

            ]
        );
        $event->sheet->getStyle('A1:S9')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('#000000');
        //

        $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(18);

        $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(5);

        $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(5);

        $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(5);

        $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(5);

        $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(5);

        $event->sheet->getDelegate()->getColumnDimension('P')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('Q')->setWidth(5);

        $event->sheet->getDelegate()->getColumnDimension('R')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('S')->setWidth(5);

        $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('EBF4FA');
        $event->sheet->setAutoFilter($cellRange);
    }
}
