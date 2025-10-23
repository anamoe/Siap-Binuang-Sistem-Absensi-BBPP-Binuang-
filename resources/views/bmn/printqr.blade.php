@php
    $cols = $cols ?? 3; // default 3 kolom
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cetak Aset BBPP Binuang</title>

<style>
  :root{
    --gap: 8mm;
    --card-padding: 6mm;
    --radius: 6px;
    --border: #ddd;
    --text: #222;
    --muted: #666;
  }

  /* toolbar hanya tampil di layar */
  .toolbar{
    display:flex; gap:8px; align-items:center; justify-content:space-between;
    padding:12px; background:#f7f7f7; border-bottom:1px solid #e5e5e5;
    position:sticky; top:0;
  }
  .btn{
    padding:6px 12px; border:1px solid #ddd; background:#fff; border-radius:6px; cursor:pointer;
  }
  .btn.active{ background:#111; color:#fff; border-color:#111; }

  /* A4 setup */
  @page{ size: A4 portrait; margin: 10mm; }
  @media print{
    .toolbar{ display:none !important; }
    .no-print{ display:none !important; } /* sembunyikan teks saat print */
    body{ -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  }

  body{ font-family: system-ui, Arial, sans-serif; margin:0; }

  .sheet{ padding: 10mm 0; }
  .grid{ display:grid; gap: var(--gap); grid-auto-rows: 1fr; }
  .cols-3{ grid-template-columns: repeat(3, 1fr); }
  .cols-4{ grid-template-columns: repeat(4, 1fr); }

  .card{
    border:6px solid #000;
    border-radius: var(--radius);
    padding: var(--card-padding);
    display:flex; flex-direction:column; gap:4mm;
    page-break-inside: avoid;
    align-items: center;
    text-align: center;
    
  }
  .qr svg{ width: 100%; max-width: 40mm; height: auto; }

  /* Keterangan hanya untuk layar */
  .meta{ font-size:11px; line-height:1.3; margin-top:4px; }
  .meta .name{ font-weight:700; font-size:12px; }
  .row{ display:flex; gap:4px; justify-content:center; font-size:10px; }
  .label{ color:var(--muted); }
  .value{ color:var(--text); }
</style>
</head>
<body>

<div class="toolbar">
  <div><strong>Cetak Label Aset – A4</strong></div>
  <div>
    <button class="btn colsBtn {{ $cols===3?'active':'' }}" data-cols="3">3 kolom</button>
    <button class="btn colsBtn {{ $cols===4?'active':'' }}" data-cols="4">4 kolom</button>
    <button class="btn" onclick="window.print()">🖨️ Cetak</button>
  </div>
</div>

<div class="sheet">
  <div id="grid" class="grid {{ $cols===4 ? 'cols-4' : 'cols-3' }}">
    @foreach($asets as $asset)
      @php
        // isi QR hanya UUID
        $svg = QrCode::format('svg')->size(380)->margin(0)->generate($asset->uuid);
      @endphp

      <div class="card">
        <div class="qr">{!! $svg !!}</div>
        <div class="meta no-print">
          <div class="name">{{ $asset->jenis_barang }}</div>
          <div class="row"><div class="label">Lokasi:</div><div class="value">{{ $asset->kode_bmn }}</div></div>
      
        </div>
      </div>
    @endforeach
  </div>
</div>

<script>
  const grid = document.getElementById('grid');
  document.querySelectorAll('.colsBtn').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      document.querySelectorAll('.colsBtn').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      const cols = btn.dataset.cols;
      grid.classList.toggle('cols-3', cols==='3');
      grid.classList.toggle('cols-4', cols==='4');
    });
  });
</script>

</body>
</html>
