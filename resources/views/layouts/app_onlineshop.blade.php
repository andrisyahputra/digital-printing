<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('asset') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('asset') }}/vendor/datatables/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('asset') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/css/style.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('asset/alertifyjs') }}/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="{{ asset('asset/alertifyjs') }}/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="{{ asset('asset/alertifyjs') }}/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="{{ asset('asset/alertifyjs') }}/css/themes/bootstrap.min.css" />

    <link rel="stylesheet" href="{{ asset('asset') }}/css/loader.css" />

    {{-- midtrans --}}
    <script type="text/javascript" src="{{config('midtrans.snap_url')}}"
        data-client-key="{{ config('midtrans.server_key') }}"></script>
    {{-- midtrans --}}
    @stack('css')

</head>

<body>


    <!-- navbar start -->
    @include('front.partials.navbar')
    <!-- navbar akhir -->





    <!-- about tentangkami mulai-->
    <div class="container">
        @yield('content')
    </div>
    <!-- footer mulai-->
    @include('front.partials.footer')
    <!-- footer akhir-->








    @include('front.modal-pesanan.modal_brosur')
    @include('front.modal-pesanan.modal_kartu_nama')
    @include('front.modal-pesanan.modal_produk')
    @include('front.modal-pesanan.modal_spanduk')
    @include('front.modal-pesanan.modal_stiker')

    {{-- laoding --}}
    <div class="loader"></div>
    {{-- akhir laoding --}}





    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('asset') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('asset') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('asset') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('asset') }}/js/owl.carousel.min.js"></script>
    <!-- buat js ketika tombol btn menu -->
    <script src="{{ asset('asset') }}/js/main.js"></script>


    <!-- JavaScript -->
    <script src="{{ asset('asset/alertifyjs') }}/alertify.min.js"></script>
    <script src="{{ asset('asset') }}/js/loader.js"></script>


    <script src="{{ asset('js/rajaongkir.js') }}" defer></script>

    {{--  --}}
    <!-- Tambahkan baris ini di bagian head file HTML Anda -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{--  --}}


    @stack('js')
    <script>
        // akhir midtrans


        $('.tutup').on('click', function() {
            // Find the closest modal and hide it
            $(this).closest('#keranjang').modal('hide');
        });


        $(document).ready(function() {
            // Mengaktifkan tab dengan menggunakan jQuery
            $("#myTabs a").on("click", function(e) {
                e.preventDefault();
                $(this).tab("show");
            });

            // no telp
            $('input[type="tel"]').on('input', function() {
                // Remove non-numeric characters from the input
                var numericInput = $(this).val().replace(/[^0-9]/g, '');

                // Update the input field with the numeric value
                $(this).val(numericInput);
            });
            // akhir no telp

        });
    </script>

    @if (session('success'))
        <script>
            alertify.success("{{ session('success') }}");
        </script>
    @endif
    @if (session('error'))
        <script>
            alertify.error("{{ session('error') }}");
        </script>
    @endif
</body>

</html>
