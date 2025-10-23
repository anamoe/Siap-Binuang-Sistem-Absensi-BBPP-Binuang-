<?php

namespace App\Http\Controllers;

use App\Imports\BmnImport;
use App\Models\Bmn;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BmnController extends Controller
{

       public function printIndex(Request $request)
    {
        // default 3 kolom, bisa override via ?cols=4
        $cols = in_array((int)$request->get('cols'), [3,4]) ? (int)$request->get('cols') : 3;

        // ambil data aset + tim
        $asets = Bmn::get();

        return view('bmn.printqr', compact('asets', 'cols'));
    }
  public function getAsset($kb)
    {
        $asset = Bmn::where('kode_barang', $kb)->first();

        if (!$asset) {
            return response()->json(['error' => 'Aset tidak ditemukan'], 404);
        }

        return response()->json([
            'jenis_barang'       => $asset->jenis_barang,
            'kode_barang'       => $asset->kode_barang,
            'nup'     => $asset->nup,
            'created_at' => $asset->created_at->format('d-m-Y H:i'),
        ]);
    }


     public function showImportForm()
    {
        $bmn = Bmn::all();
        return view('bmn.import',compact('bmn'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new BmnImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data BMN berhasil diimport!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kb)
    {
        //
        $asset = Bmn::where('kode_barang', $kb)->firstOrFail();
        $url = ($asset->kode_barang);

        return view('bmn.detail', compact('asset', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
