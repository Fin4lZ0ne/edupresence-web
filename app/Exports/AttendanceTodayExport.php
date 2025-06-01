<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceTodayExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Attendance::with('employee', 'subject')
            ->whereDate('date', now()->toDateString())
            ->get()
            ->map(function ($att) {
                return [
                    'Nama Guru'   => $att->employee->fullname ?? '-',
                    'Pelajaran'   => $att->subject->name ?? '-',
                    'Tanggal'     => \Carbon\Carbon::parse($att->date)->format('d/m/Y'),
                    'Status'      => ucfirst($att->status->value ?? 'Belum Diisi'),
                    'Jam Masuk'   => $att->time_start ?? '-',
                    'Jam Keluar'  => $att->time_end ?? '-',
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
