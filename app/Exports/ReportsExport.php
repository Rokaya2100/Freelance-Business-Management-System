<?php

namespace App\Exports;

use App\Models\Report;
use App\Models\Section;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportsExport implements FromCollection, WithStyles
{

        public function collection()
        {
                $reports = Report::all();
                $data = $reports->map(function ($report) {
                $section = Section::findOrFail($report->project->section_id);
                $client = User::findOrFail($report->project->client_id);
                $freelancer = User::findOrFail($report->project->freelancer_id);

            return [
                'id'                  => $report->id,
                'project name'        => $report->project->name,
                'project description' => $report->project->description,
                'section name'        => $section->name,
                'client name'         => $client->name,
                'freelancer name'     => $freelancer->name,
                'exp_delivery_date'   => $report->project->exp_delivery_date,
                'delivery_date'       => $report->project->delivery_date,
                'price'               => $report->project->contract->price,
                'is paid'             => ($report->project->contract->is_paid=='1')?'Yse':'No',
                'contract status'     => $report->project->contract->status,
            ];
        });

        $data->prepend([
            'id'                  => 'ID',
            'project name'        => 'Project Name',
            'project description' => 'Project Description',
            'section name'        => 'The section',
            'client name'         => 'Client',
            'freelancer name'     => 'Freelancer',
            'exp_delivery_date'   => 'Exp delivery date',
            'delivery_date'       => 'Delivery date',
            'price'               => 'Price',
            'is paid'             => 'is paid',
            'contract status'     => 'Contract status',
        ]);

        return $data;
        }



    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '4682B4'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ]
        ]);

        $sheet->getStyle('A1:N' . (count($this->collection()) + 1))->applyFromArray([
            'border' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        foreach (range('A', 'N') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
