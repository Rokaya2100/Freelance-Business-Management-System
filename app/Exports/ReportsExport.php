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
                $section_id = $report->project->section_id;
                $user_id = $report->project->user_id;
                $section = Section::findOrFail($section_id);
                $user = User::findOrFail($user_id);

                return [
                    'id'                => $report->id,
                    'Project name'      => $report->project->name,
                    'description'       => $report->description,
                    'exp_delivery_date' => $report->project->exp_delivery_date,
                    'delivery_date'     => $report->project->delivery_date,
                    'user name'         => $section->name,
                    'section name'      => $user->name,
                    'created_at'        => $report->created_at,
                ];
            });

            $data->prepend([
                'id' => 'ID',
                'Project name' =>  'Project Name',
                'description' => 'Description',
                'exp_delivery_date' => 'Exp Delivery Ddate  ',
                'delivery_date' => ' Delivery Date',
                'user_name' => 'User Name',
                'section_name' => 'Section Name ',
                'created_at' => 'Created At',
            ]);

            return $data;
        }



    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
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

        $sheet->getStyle('A1:H' . (count($this->collection()) + 1))->applyFromArray([
            'border' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
