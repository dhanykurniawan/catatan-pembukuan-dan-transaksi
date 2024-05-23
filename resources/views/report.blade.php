<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ url('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" />

    <!-- CSS DATATABLES -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">

    <!-- JS DATATBLES -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('partials.sidebar')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('partials.navbar')
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example" class="display nowrap table-responsive border" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="border border-white">TRANSACTION CODE</th>
                                                <th class="border border-white">PRODUCT NAME</th>
                                                <th class="border border-white">UNIT</th>
                                                <th class="border border-white">QUANTITY</th>
                                                <th class="border border-white">DISCOUNT</th>
                                                <th class="border border-white">TOTAL PRICE</th>
                                                <th class="border border-white">DATE OF TRANSACTION</th>
                                            </tr>
                                        </thead>
                                        @foreach($transactions as $transaction)
                                        <tr>
                                            <td class="text-left border border-white">{{ $transaction->kode_transaksi }}
                                            </td>
                                            <td class="border border-white">
                                                @php
                                                $product = \App\Models\Master::where('kode',
                                                $transaction->kode_product)->first();
                                                @endphp
                                                {{ $product ? $product->nama : 'Product Not Found' }}
                                            </td>
                                            <td class="border border-white">
                                                @php
                                                $product = \App\Models\Master::where('kode',
                                                $transaction->kode_product)->first();
                                                @endphp
                                                {{ $product ? $product->satuan : 'Product Not Found' }}
                                            </td>
                                            <td class="text-center border border-white">{{ $transaction->jumlah_beli }}
                                            </td>
                                            <td class="border border-white">
                                                @if($transaction->jumlah_beli > 10)
                                                <?php $diskon = (5 / 100) * $transaction->total_harga; ?>
                                                Rp {{ number_format($diskon, 0, ',', '.') }}
                                                @else
                                                <span>Rp 0</span>
                                                @endif
                                            </td>
                                            <td class="border border-white">
                                                Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="border border-white">
                                                {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- partial:partials/_footer.html -->
                    @include('partials.footer')
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ url('assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ url('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
        <script src="{{ url('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ url('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ url('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ url('assets/js/off-canvas.js') }}"></script>
        <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ url('assets/js/misc.js') }}"></script>
        <script src="{{ url('assets/js/settings.js') }}"></script>
        <script src="{{ url('assets/js/todolist.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ url('assets/js/dashboard.js') }}"></script>
        <!-- End custom js for this page -->

        <script>
            new DataTable('#example', {
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        </script>

        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.js"></script>
</body>













</html>