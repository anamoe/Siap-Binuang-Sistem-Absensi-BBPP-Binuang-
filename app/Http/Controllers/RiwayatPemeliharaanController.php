<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\RiwayatPemeliharaan;
use Illuminate\Http\Request;

class RiwayatPemeliharaanController extends Controller
{
    public function showReportForm($uuid)
    {
        $aset = Aset::where('uuid', $uuid)->firstOrFail();
        $riwayat = RiwayatPemeliharaan::where('aset_id', $aset->id)->orderBy('maintenance_date', 'desc')->get();

        return view('maintenance.report_form', compact('aset', 'riwayat'));
    }

    public function storeReport(Request $request)
    {

        $aset = Aset::findOrFail($request->aset_id);

        RiwayatPemeliharaan::create([
            'aset_id' => $aset->id,
            'tanggal_perawatan' => now(),
            'catatan' => $request->catatan,
        ]);

        // 2. Perbarui tanggal pemeliharaan di tabel aset
        $aset->last_maintenance_date = now();
        $aset->next_maintenance_date = now()->addMonths($aset->maintenance_interval);
        $aset->save();

        // ... redirect atau response sukses ...
    }
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
    public function show(string $id)
    {
        //
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
