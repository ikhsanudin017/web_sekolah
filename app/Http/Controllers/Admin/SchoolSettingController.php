<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolSettingController extends Controller
{
    public function edit()
    {
        $setting = SchoolSetting::firstOrCreate([]);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'visi_misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'nullable|string',
            'email_kontak' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'map_url' => 'nullable|url',
            'description' => 'nullable|string',
            'primary_color' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $setting = SchoolSetting::firstOrCreate([]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $validated['logo'] = $request->file('logo')->store('images/settings', 'public');
        }

        if (array_key_exists('primary_color', $validated) && $validated['primary_color'] === '') {
            $validated['primary_color'] = null;
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Pengaturan sekolah berhasil diperbarui.');
    }
}
