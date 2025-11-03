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
                'no_hp' => $user->pegawai->no_hp ?? null,
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
        $jamPulang = null;

        // Cek hari kerja Senin–Jumat
        if (in_array($hariLower, ['senin', 'selasa', 'rabu', 'kamis', 'jumat'])) {
            $statusKerja = 'Hari kerja';

            if ($hariLower == 'jumat') {
                $jamMasuk = '07:30';
                $jamIstirahatMulai = '12:00';
                $jamIstirahatSelesai = '13:30';
                $jamPulang = '16:30';
            } else {
                $jamMasuk = '07:30';
                $jamIstirahatMulai = '12:30';
                $jamIstirahatSelesai = '13:30';
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
            'latitude_initial' => -3.154397750534802,
            'longitude_initial' => 115.08676788764485,
            'radius_meter' => '260',
            'periode_tracking' => '15',
            'titik_gedung' => [
                ['nama' => 'Kantor Satpam', 'latitude' => -3.1555570332755827, 'longitude' => 115.08563653037746],
                ['nama' => 'Perpustakaan Binuang', 'latitude' => -3.154783495360809, 'longitude' => 115.0863471628111],
                ['nama' => 'Kantor Utama', 'latitude' => -3.1546936337485367, 'longitude' => 115.08672517032083],
                ['nama' => 'Aula Bangkinang', 'latitude' => -3.154495403221914, 'longitude' => 115.08708911694636],
                ['nama' => 'Kelas Tangkuhis', 'latitude' => -3.154930998658024, 'longitude' => 115.08716752869245],
                ['nama' => 'Ruang AOR', 'latitude' => -3.154851461844634, 'longitude' => 115.08740270810367],
                ['nama' => 'Kelas Sangkuang', 'latitude' => -3.1546848132635112, 'longitude' => 115.08739132845474],
                ['nama' => 'Kelas Gitaan', 'latitude' => -3.1545143771846584, 'longitude' => 115.0875184012022],
                ['nama' => 'Bengkel', 'latitude' => -3.154273872887312, 'longitude' => 115.08763219769406],
                ['nama' => 'Kasturi', 'latitude' => -3.1542119410808818, 'longitude' => 115.08650108641977],
                ['nama' => 'Musholla', 'latitude' => -3.155137671698393, 'longitude' => 115.08671644546078],


            ],
            'batasan_area' => [
                ['nama' => 'Batas Depan Kiri', 'latitude' => -3.153422954410393,  'longitude' => 115.08464420662081],
                ['nama' => 'Batas Depan Kanan', 'latitude' => -3.156035929443358,  'longitude' => 115.08570517155849],
                ['nama' => 'Batas Tengah Kiri', 'latitude' => -3.1529699679727514, 'longitude' => 115.08524671741775],
                ['nama' => 'Batas Tengah Kanan', 'latitude' => -3.155215392828469,  'longitude' => 115.08687122032067],
                ['nama' => 'Batas Belakang Tengah', 'latitude' => -3.15313432085182,  'longitude' => 115.086440215045028],
                ['nama' => 'Batas Belakang Kanan', 'latitude' => -3.154722455763412, 'longitude' => 115.08945834075793],

            ],
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
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Data tracking hari ini tidak ditemukan',
            ], 200);
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
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Data tracking hari ini tidak ditemukan',
            ], 200);
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
