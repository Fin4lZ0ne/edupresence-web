<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Attendance::with('employee', 'subject')
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($att) {
                return [
                    'Nama Guru' => $att->employee->fullname,
                    'Pelajaran' => $att->subject->name,
                    'Tanggal' => $att->date->format('d/m/Y'),
                    'Status' => $att->status,
                    'Jam Masuk' => $att->time_start ?? '-',
                    'Jam Keluar' => $att->time_end ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Guru',
            'Pelajaran',
            'Tanggal',
            'Status',
            'Jam Masuk',
            'Jam Keluar',
        ];
    }
}
