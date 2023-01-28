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
    private $isprof;

    public function __construct($collection,$dayReport,$isprof)
    {

        $this->collection = $collection;
        $this->dayReport = $dayReport;
        $this->isprof = $isprof;
    }

    public function view(): View
    {
        return view("report/reportFile", ['collection' => $this->collection,'dayReport' => $this->dayReport,'isprof' =>$this->isprof]);
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

        //$active_sheet->getStyle('A10:Z10')->getFont()->setBold(true);

        $cellRange = 'A10:S11'; // All headers
        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
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

        $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(16);
        $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(18);
        $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(16);
        $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(16);

        $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(4);

        $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(4);

        $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(4);

        $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(4);

        $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(4);

        $event->sheet->getDelegate()->getColumnDimension('P')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('Q')->setWidth(4);

        $event->sheet->getDelegate()->getColumnDimension('R')->setWidth(17);
        $event->sheet->getDelegate()->getColumnDimension('S')->setWidth(4);
        
        $event->sheet->getDelegate()->getStyle("G11")->getFont()->setSize(8);
        $event->sheet->getDelegate()->getStyle("I11")->getFont()->setSize(8);
        $event->sheet->getDelegate()->getStyle("K11")->getFont()->setSize(8);
        $event->sheet->getDelegate()->getStyle("M11")->getFont()->setSize(8);
        $event->sheet->getDelegate()->getStyle("O11")->getFont()->setSize(8);
        $event->sheet->getDelegate()->getStyle("Q11")->getFont()->setSize(8);
        $event->sheet->getDelegate()->getStyle("S11")->getFont()->setSize(8);

        $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('EBF4FA');
        $event->sheet->setAutoFilter($cellRange);


        $active_sheet->getPageMargins()->setTop(0);
        $active_sheet->getPageMargins()->setRight(0);
        $active_sheet->getPageMargins()->setLeft(0);
        $active_sheet->getPageMargins()->setBottom(1);

        $active_sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);

        $active_sheet->getPageSetup()->setScale(64);

        $active_sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $active_sheet->getHeaderFooter()
        ->setOddFooter('&P - AGENTE RESPONSABLE LEG. 145425 FIRMA Y SELLO----------DIRECTOR DEL AREA----------FIRMA Y SELLO');

        $toRow = 11 + $event->getConcernable()->collection->count() + 1;
        //dd($toRow);
        $active_sheet->getPageSetup()->setPrintArea('A1:S'.$toRow);

        $active_sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 11);

        $active_sheet->getStyle('A12:S'.$toRow)->getAlignment()->setWrapText(true);
        $active_sheet->setPrintGridlines(true);
    }
}
