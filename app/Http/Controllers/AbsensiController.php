<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('user_id', Auth::id())
                          ->orderBy('tanggal', 'desc')
                          ->paginate(10);

        return view('absensi.index', compact('absensi'));
    }

    public function create()
    {
        // Cek apakah sudah absen hari ini
        $today = date('Y-m-d');
        $existingAbsensi = Absensi::where('user_id', Auth::id())
                                 ->where('tanggal', $today)
                                 ->first();

        if ($existingAbsensi) {
            return redirect()->route('absensi.index')
                           ->with('error', 'Anda sudah absen hari ini');
        }

        return view('absensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek apakah sudah absen hari ini
        $today = date('Y-m-d');
        $existingAbsensi = Absensi::where('user_id', Auth::id())
                                 ->where('tanggal', $today)
                                 ->first();

        if ($existingAbsensi) {
            return redirect()->route('absensi.index')
                           ->with('error', 'Anda sudah absen hari ini');
        }

        // Upload foto
        $foto = $request->file('foto');
        $filename = time().'_'.Auth::id().'.'.$foto->getClientOriginalExtension();

        // Pastikan folder exists
        $uploadPath = public_path('uploads/absensi');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        try {
            // Gunakan ImageManager untuk Intervention Image v3
            $manager = new ImageManager(new Driver());
            $image = $manager->read($foto->getRealPath());
            $image->save($uploadPath.'/'.$filename); // Simpan tanpa resize
        } catch (\Exception $e) {
            // Jika gagal resize, gunakan move biasa
            $foto->move($uploadPath, $filename);
        }

        // Simpan absensi
        Absensi::create([
            'user_id' => Auth::id(),
            'tanggal' => $today,
            'jam_masuk' => date('H:i:s'),
            'foto' => $filename,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.index')
                       ->with('success', 'Absensi berhasil disimpan');
    }
}
