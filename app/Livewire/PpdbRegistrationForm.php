<?php

namespace App\Livewire;

use App\Models\PpdbRegistration;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PpdbRegistrationForm extends Component
{
    use WithFileUploads;

    // Step management
    public $currentStep = 1;
    public $totalSteps = 3;

    // Step 1: Data Diri
    public $nama_lengkap = '';
    public $nisn = '';
    public $email = '';
    public $no_hp = '';
    public $tempat_lahir = '';
    public $tanggal_lahir = '';
    public $jenis_kelamin = '';
    public $alamat = '';

    // Step 2: Data Sekolah Asal
    public $asal_sekolah = '';
    public $alamat_sekolah = '';
    public $tahun_lulus = '';

    // Step 3: Upload Berkas
    public $foto_dokumen = null;
    public $ijazah = null;
    public $ktp_ortu = null;

    // Validation rules
    protected function rules()
    {
        $rules = [];

        if ($this->currentStep == 1) {
            $rules = [
                'nama_lengkap' => 'required|string|max:255',
                'nisn' => 'required|numeric|digits:10|unique:ppdb_registrations,nisn',
                'email' => 'required|email|max:255|unique:ppdb_registrations,email',
                'no_hp' => 'required|string|max:20',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required|string',
            ];
        } elseif ($this->currentStep == 2) {
            $rules = [
                'asal_sekolah' => 'required|string|max:255',
                'alamat_sekolah' => 'required|string',
                'tahun_lulus' => 'required|numeric|min:2020|max:' . (date('Y') + 1),
            ];
        } elseif ($this->currentStep == 3) {
            $rules = [
                'foto_dokumen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'ijazah' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
                'ktp_ortu' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            ];
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.digits' => 'NISN harus terdiri dari 10 digit.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'foto_dokumen.required' => 'Foto dokumen wajib diupload.',
            'foto_dokumen.image' => 'Foto dokumen harus berupa gambar.',
            'foto_dokumen.max' => 'Ukuran foto dokumen maksimal 2MB.',
            'ijazah.max' => 'Ukuran file ijazah maksimal 2MB.',
            'ktp_ortu.max' => 'Ukuran file KTP orang tua maksimal 2MB.',
        ];
    }

    public function nextStep()
    {
        $this->validate();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            // Upload files
            $fotoDokumenPath = null;
            $ijazahPath = null;
            $ktpOrtuPath = null;

            if ($this->foto_dokumen) {
                $fotoDokumenPath = $this->foto_dokumen->store('ppdb/documents', 'public');
            }

            if ($this->ijazah) {
                $ijazahPath = $this->ijazah->store('ppdb/documents', 'public');
            }

            if ($this->ktp_ortu) {
                $ktpOrtuPath = $this->ktp_ortu->store('ppdb/documents', 'public');
            }

            // Save registration
            $registration = PpdbRegistration::create([
                'nama_lengkap' => $this->nama_lengkap,
                'nisn' => $this->nisn,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'asal_sekolah' => $this->asal_sekolah,
                'status' => 'pending',
                'notes' => json_encode([
                    'tempat_lahir' => $this->tempat_lahir,
                    'tanggal_lahir' => $this->tanggal_lahir,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'alamat' => $this->alamat,
                    'alamat_sekolah' => $this->alamat_sekolah,
                    'tahun_lulus' => $this->tahun_lulus,
                    'foto_dokumen' => $fotoDokumenPath,
                    'ijazah' => $ijazahPath,
                    'ktp_ortu' => $ktpOrtuPath,
                ]),
            ]);

            // Reset form
            $this->reset();
            $this->currentStep = 1;

            session()->flash('success', 'Pendaftaran PPDB berhasil! Kami akan menghubungi Anda melalui email yang terdaftar.');

            return redirect()->route('ppdb.registration')->with('registration_id', $registration->id);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function updated($propertyName)
    {
        // Real-time validation untuk NISN hanya angka
        if ($propertyName === 'nisn') {
            $this->nisn = preg_replace('/[^0-9]/', '', $this->nisn);
        }
        
        // Real-time validation
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.ppdb-registration-form');
    }
}

