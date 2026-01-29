<?php

namespace App\Exports;

use App\Models\PpdbRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PpdbRegistrationExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = PpdbRegistration::query();

        if ($this->request && $this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        if ($this->request && $this->request->filled('search')) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }

        return $query->latest()->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NISN',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat Rumah',
            'Email',
            'No. HP',
            'Asal Sekolah',
            'Alamat Sekolah Asal',
            'Tahun Lulus',
            'Status',
            'Tanggal Daftar',
        ];
    }

    /**
     * @param mixed $registration
     * @return array
     */
    public function map($registration): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        // Parse notes JSON data
        $notes = is_array($registration->notes) ? $registration->notes : [];

        return [
            $rowNumber,
            $registration->nama_lengkap,
            $registration->nisn ?? '-',
            $notes['tempat_lahir'] ?? '-',
            $notes['tanggal_lahir'] ?? '-',
            $notes['jenis_kelamin'] ?? '-',
            $notes['alamat'] ?? '-',
            $registration->email,
            $registration->no_hp,
            $registration->asal_sekolah ?? '-',
            $notes['alamat_sekolah'] ?? '-',
            $notes['tahun_lulus'] ?? '-',
            ucfirst($registration->status),
            $registration->created_at->format('d/m/Y H:i'),
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style header row
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true],
            ],
        ];
    }
}

