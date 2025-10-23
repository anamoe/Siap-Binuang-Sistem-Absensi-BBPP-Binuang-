<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\TimKerja;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

       public function printIndex(Request $request)
    {
        // default 3 kolom, bisa override via ?cols=4
        $cols = in_array((int)$request->get('cols'), [3,4]) ? (int)$request->get('cols') : 3;

        // ambil data aset + tim
        $asets = Aset::with('team')->orderBy('nama')->get();

        return view('qrcode.printqr', compact('asets', 'cols'));
    }
  public function getAsset($uuid)
    {
        $asset = Aset::with('team')->where('uuid', $uuid)->first();

        if (!$asset) {
            return response()->json(['error' => 'Aset tidak ditemukan'], 404);
        }

        return response()->json([
            'nama'       => $asset->nama,
            'uuid'       => $asset->uuid,
            'lokasi'     => $asset->lokasi,
            'spesifikasi'=> $asset->spesifikasi,
            'status'     => $asset->status,
            'catatan'    => $asset->catatan,
            'team'       => $asset->team ? $asset->team->nama : '-',
            'created_at' => $asset->created_at->format('d-m-Y H:i'),
        ]);
    }

    public function index()
    {
        //
         $asets = Aset::with('team')->latest()->paginate(10);
        //  return $asets;
        return view('qrcode.index', compact('asets'));
    }

    

    /**
     * Display the specified resource.
     */
    public function showqr($uuid)
    {
        $asset = Aset::with('team')->where('uuid', $uuid)->firstOrFail();
        $url = ($asset->uuid);

        return view('qrcode.detail', compact('asset', 'url'));
    }

    public function create()
    {
        $timkerjas = TimKerja::all();
        return view('qrcode.create', compact('timkerjas'));
    }

    public function store(Request $request)
    {

        // return $request;
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'timker_id' => 'nullable|exists:timkerjas,id',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
         $validated['uuid'] = Str::uuid();

        Aset::create($validated);

        return redirect('dashboard-aset')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function show($id)
    {
        
        $asset= Aset::where('uuid',$id)->first();
        $timkerjas = TimKerja::all();
        return view('qrcode.edit', compact('asset', 'timkerjas'));
    }

    public function update(Request $request, Aset $asset)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'timker_id' => 'nullable|exists:timkerjas,id',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $asset->update($validated);

        return redirect('dashboard-aset')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Aset::where('uuid',$id)->delete();
        return redirect('dashboard-aset')->with('success', 'Aset berhasil dihapus.');
    }
}
