<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
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
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_API_KEY') }}"></script>
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








    <!-- Modal -->
    <div class="modal fade" id="keranjang" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('keranjang.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="produk_id" id="produk_id" value="">
                        <div class="container-fluid">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="kuantitas" class="form-label">Jumlah</label>
                                    <label for="kuantitas" class="form-label" id="num_qty"></label>
                                </div>
                                <input type="number" class="form-control" name="kuantitas" id="kuantitas"
                                    placeholder="Masukan jumlah kuantitas" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tutup">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        function add_card(produk_id, stok) {
            let modal = $('#keranjang')
            // let hide = $('#keranjang')
            modal.find('#produk_id').val(produk_id)
            modal.find('#num_qty').text('Tersedia ' + stok)
            modal.find('input[name="kuantitas"]').attr('max', stok)
            // modal.find('tutup').modal('hide');
            modal.modal('show')
        }
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
