<?php

namespace App\Repos;

use App\Enums\AttendanceStatus;
use App\Models\Attendance;

class ChartRepository
{
    private $months = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    private $status = [
        'absent' => 'Absen',
        'present' => 'Hadir',
        'late' => 'Terlambat',
        'excused' => 'Izin',
    ];

    public function getData(int $months)
    {
        $month = now()->subMonth($months - 1);

        $attendances = Attendance::selectRaw('MONTH(`date`) AS month, COUNT(*) AS total, status')
            ->where('date', '>=', $month->startOfMonth())
            ->groupByRaw('MONTH(date), status')
            ->get();

        $monthNumbers = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $monthNumbers[] = now()->subMonthsNoOverflow($i)->format('n');
        }

        return [
            'months' => array_map(fn($month) => $this->months[$month], $monthNumbers),
            'series' => array_map(function ($status) use ($monthNumbers, $attendances) {
                $status = AttendanceStatus::tryFrom($status);

                return [
                    'name' => $this->status[$status->value],
                    'data' => $this->seriesData($monthNumbers, $status, $attendances),
                ];
            }, AttendanceStatus::values()),
        ];
    }


    private function seriesData(array $months, AttendanceStatus $status, $attendances)
    {
        $filtered = $attendances->filter(fn($att) => $att->status == $status);

        return array_map(function ($month) use ($filtered) {
            return $filtered->where('month', $month)->first()->total ?? 0;
        }, $months);
    }
}
