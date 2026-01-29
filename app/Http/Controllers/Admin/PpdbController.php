<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use App\Exports\PpdbRegistrationExport;
use Maatwebsite\Excel\Facades\Excel;

class PpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query sederhana, tidak ada relasi jadi tidak perlu eager loading
        $query = PpdbRegistration::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(15);

        $stats = [
            'total' => PpdbRegistration::count(),
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
            'proses' => PpdbRegistration::where('status', 'proses')->count(),
            'diterima' => PpdbRegistration::where('status', 'diterima')->count(),
        ];

        return view('admin.ppdb.index', compact('registrations', 'stats'));
    }

    /**
     * Update status
     */
    public function updateStatus(Request $request, PpdbRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,diterima',
        ]);

        $registration->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    /**
     * Export to Excel
     */
    public function export(Request $request)
    {
        return Excel::download(new PpdbRegistrationExport($request), 'ppdb-registrations-' . date('Y-m-d') . '.xlsx');
    }
}

