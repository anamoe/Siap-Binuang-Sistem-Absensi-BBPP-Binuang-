<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{url('')}}/favicon32.png" rel="icon">

    <title>@yield('title') | BBPP BINUANG</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset ('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand,
        .card-body,
        .card-footer,
        .small {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body class="sb-nav-fixed">

    @include('partials.header')
    <div id="layoutSidenav">
        @include('partials.sidebar')
        <div id="layoutSidenav_content">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border rounded-3"
                role="alert"
                style="background-color: #d1e7dd; color: #000; font-weight: 600;">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ❌ {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Validasi error --}}
            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                ⚠️ <strong>Periksa kembali input:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset ('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset ('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset ('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset ('js/datatables-simple-demo.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>



    <script>
        $(function() {
            // Extract date values from request if present
            var startDate = '{{ request('
            tanggal ') ? explode('
            to ', request('
            tanggal '))[0] : '
            ' }}';
            var endDate = '{{ request('
            tanggal ') ? explode('
            to ', request('
            tanggal '))[1] : '
            ' }}';

            // Initialize datepicker
            $('#tanggal').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' to '
                },
                startDate: startDate ? moment(startDate, 'YYYY-MM-DD') : moment().startOf('month'),
                endDate: endDate ? moment(endDate, 'YYYY-MM-DD') : moment().endOf('month'),
                autoUpdateInput: false
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                // Update the input field with the selected range
                $('input[name="tanggal"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });

            // Set the initial value of the input field if it's already filled
            $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
            });
        });
    </script>
    <script>
        function confirmDelete(uuid) {
            Swal.fire({
                title: 'Yakin Hapus?',
                text: "Data aset yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + uuid).submit();
                }
            });
        }

        $(function() {
            $('#bmnTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
                }
            });
        });
    </script>


</body>

</html>