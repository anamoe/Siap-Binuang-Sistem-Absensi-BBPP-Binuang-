<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPemeliharaan;
use App\Models\RiwayatTrackingPegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TrackingPegawaiController extends Controller
{
    //

    public function update_pass_all()
    {
        User::query()->update([
            'password' => Hash::make('123')
        ]);
    }
    public function login(Request $request)
    {
        $user = User::with('pegawai')->where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }

        $token = $user->createToken('token-login')->plainTextToken;

        // Cek apakah ada foto_profil dan tambahkan URL lengkap
        $fotoProfilUrl = null;
        if ($user->foto_profil && file_exists(public_path('foto/' . $user->foto_profil))) {
            $fotoProfilUrl = asset('foto/' . $user->foto_profil);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $user->id_user,
                'username' => $user->username,
                'nama' => $user->pegawai->nama ?? null,
                'jabatan' => $user->pegawai->jabatan ?? null,
                'pangkat' => $user->pegawai->pangkat ?? null,
                'role' => $user->role,
                'foto_profil' => $fotoProfilUrl,
            ]
        ]);
    }

    public function show($id)
    {
        $user = User::with('pegawai')->find($id);
        $fotoProfilUrl = null;
        if ($user->foto_profil && file_exists(public_path('foto/' . $user->foto_profil))) {
            $fotoProfilUrl = asset('foto/' . $user->foto_profil);
        }

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success',

            'user' => [
                'id' => $user->id_user,
                'username' => $user->username,
                'nama' => $user->pegawai->nama ?? null,
                'jabatan' => $user->pegawai->jabatan ?? null,
                'pangkat' => $user->pegawai->pangkat ?? null,
                'no_hp' => $user->pegawai->no_hp?? null,
                'role' => $user->role,
                'foto_profil' => $fotoProfilUrl,
            ]
        ]);
    }

    public function jadwal_kerja()
    {

        $hariIni = Carbon::now()->locale('id')->dayName;
        $hariLower = strtolower($hariIni);

        // Default: libur
        $statusKerja = 'Libur';
        $jamMasuk = null;
        $jamIstirahatMulai = null;
        $jamIstirahatSelesai = null;
        $jamPulang = null;

        // Cek hari kerja Senin–Jumat
        if (in_array($hariLower, ['senin', 'selasa', 'rabu', 'kamis', 'jumat'])) {
            $statusKerja = 'Hari kerja';

            if ($hariLower == 'jumat') {
                $jamMasuk = '07:30';
                $jamIstirahatMulai = '12:00';
                $jamIstirahatSelesai = '14:00';
                $jamPulang = '16:30';
            } else {
                $jamMasuk = '07:30';
                $jamIstirahatMulai = '12:30';
                $jamIstirahatSelesai = '14:00';
                $jamPulang = '16:00';
            }
        }

        return response()->json([
            'code' => 200,
            'hari' => ucfirst($hariIni),
            'status_kerja' => $statusKerja,
            'jam_masuk' => $jamMasuk,
            'jam_istirahat_mulai' => $jamIstirahatMulai,
            'jam_istirahat_selesai' => $jamIstirahatSelesai,
            'jam_pulang' => $jamPulang,
            'latitude' => '-3.154397750534802',
            'longitude' => '115.08676788764485'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:user,id_user',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jam_kerja' => 'required|string'
        ]);

        $absensi = RiwayatTrackingPegawai::create($validated);

        return response()->json([
            'message' => 'Data Tracking berhasil disimpan',
            'code' => 201,
            'data' => $absensi
        ]);
    }

    public function tracking($id)
    {
        $today = Carbon::today();

        $track = DB::table('riwayat_tracking_pegawais')
            ->join('user', 'riwayat_tracking_pegawais.id_user', '=', 'user.id_user')
            ->leftJoin('pegawai', 'user.id_pegawai', '=', 'pegawai.id_pegawai')
            ->select(
                'riwayat_tracking_pegawais.id',
                'riwayat_tracking_pegawais.id_user',
                'user.nama',
                'pegawai.no_hp',
                'riwayat_tracking_pegawais.latitude',
                'riwayat_tracking_pegawais.longitude',
                'riwayat_tracking_pegawais.jam_kerja',
                DB::raw("DATE_FORMAT(riwayat_tracking_pegawais.created_at, '%d-%m-%Y %H:%i') as created_at")
            )
            ->where('riwayat_tracking_pegawais.id_user', $id)
            ->whereDate('riwayat_tracking_pegawais.created_at', $today)
            ->orderByDesc('riwayat_tracking_pegawais.created_at')
            ->get();


        if ($track->isEmpty()) {
            return response()->json(['message' => 'Data tracking hari ini tidak ditemukan'], 404);
        }
        $latestTrack = $track->first();

        // Hitung selisih waktu dari created_at terakhir ke sekarang
        $isOnline = Carbon::parse($latestTrack->created_at)->diffInMinutes(now()) <= 15;

        return response()->json([
            'code' => 200,
            'tanggal' => $today->toDateString(),
            'total_data' => $track->count(),
            'data' => $track,
            'status_online' => $isOnline,
        ]);
    }

    public function trackingall()
    {

        $today = Carbon::today();

        $track = RiwayatTrackingPegawai::from('riwayat_tracking_pegawais as rtp')
    ->select(
        'rtp.id',
        'rtp.id_user',
        'user.nama',
        'pegawai.jabatan',
        'pegawai.no_hp',
        'rtp.latitude',
        'rtp.longitude',
        'rtp.jam_kerja',
        DB::raw("DATE_FORMAT(rtp.created_at, '%Y-%m-%d %H:%i') as created")
    )
    ->join(DB::raw('(
        SELECT id_user, MAX(created_at) AS last_created
        FROM riwayat_tracking_pegawais
        WHERE DATE(created_at) = CURDATE()
        GROUP BY id_user
    ) latest'), function ($join) {
        $join->on('rtp.id_user', '=', 'latest.id_user')
             ->on('rtp.created_at', '=', 'latest.last_created');
    })
    ->join('user', 'rtp.id_user', '=', 'user.id_user')
    ->leftJoin('pegawai', 'user.id_pegawai', '=', 'pegawai.id_pegawai')
    ->orderByDesc('rtp.created_at')
    ->get();

        if ($track->isEmpty()) {
            return response()->json(['message' => 'Data tracking hari ini tidak ditemukan'], 404);
        }

        // Tambahkan status_online ke setiap data
        $track = $track->map(function ($item) {
            $item->status_online = Carbon::parse($item->created)->diffInMinutes(now()) <= 15;
            return $item;
        });

        return response()->json([
            'tanggal' => $today->toDateString(),
            'total_user' => $track->count(),
            'data' => $track
        ]);
    }
}
