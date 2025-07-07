<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalKaryawan = User::where('role', 'karyawan')->count();
        $absenHariIni = Absensi::whereDate('tanggal', Carbon::today())->count();
        $totalAbsensi = Absensi::count();

        return view('admin.dashboard', compact('totalKaryawan', 'absenHariIni', 'totalAbsensi'));
    }

    public function absensi(Request $request)
    {
        $query = Absensi::with('user');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('karyawan')) {
            $query->where('user_id', $request->karyawan);
        }

        $absensi = $query->orderBy('tanggal', 'desc')->paginate(20);
        $karyawan = User::where('role', 'karyawan')->get();

        return view('admin.absensi', compact('absensi', 'karyawan'));
    }

    public function karyawan()
    {
        $karyawan = User::where('role', 'karyawan')
                        ->orderBy('name', 'asc')
                        ->paginate(10); // Ganti 10 sesuai jumlah per halaman yang diinginkan

        return view('admin.karyawan', compact('karyawan'));
    }

    public function karyawanDetail($id)
    {
        $karyawan = User::findOrFail($id);
        $absensi = Absensi::where('user_id', $id)->orderBy('tanggal', 'desc')->paginate(10); // ✅ ini versi benar

        return view('admin.karyawan.detail', compact('karyawan', 'absensi'));
    }
}
