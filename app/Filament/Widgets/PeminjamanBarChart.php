<?php

namespace App\Filament\Widgets;

use App\Models\PeminjamanBarang;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PeminjamanBarChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Peminjaman Bulanan';
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Ambil 6 bulan terakhir
        $months = collect(range(5, 0))->map(function ($i) {
            return Carbon::now()->subMonths($i);
        });

        $labels = $months->map(fn($m) => $m->translatedFormat('M Y'))->toArray();

        $ruanganCounts = $this->getMonthlyCounts(PeminjamanRuangan::class, $months);
        $barangCounts = $this->getMonthlyCounts(PeminjamanBarang::class, $months);
        $kendaraanCounts = $this->getMonthlyCounts(PeminjamanKendaraan::class, $months);

        return [
            'datasets' => [
                [
                    'label' => 'Ruangan',
                    'data' => $ruanganCounts,
                    'backgroundColor' => '#10b981',
                ],
                [
                    'label' => 'Barang',
                    'data' => $barangCounts,
                    'backgroundColor' => '#3b82f6',
                ],
                [
                    'label' => 'Kendaraan',
                    'data' => $kendaraanCounts,
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getMonthlyCounts($model, $months): array
    {
        $counts = [];
        foreach ($months as $month) {
            $counts[] = $model::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return $counts;
    }
}
