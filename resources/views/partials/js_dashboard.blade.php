    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{ asset('sbadmin2') }}/vendor/jquery/jquery.min.js"></script>

    <script src="{{ asset('sbadmin2') }}/vendor/bootstrap/js/bootstrap.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('sbadmin2') }}/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sbadmin2') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('sbadmin2') }}/js/demo/chart-pie-demo.js"></script> --}}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('sbadmin2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('sbadmin2') }}/vendor/bootstrap/js/bootstrap.js"></script> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('sbadmin2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('sbadmin2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    {{-- boostrap baru untuk modal --}}
    <script src="{{ asset('sbadmin2') }}/js/bootstrap.js"></script>
    {{-- <script src="{{ asset('/js/bootstrap.js') }}"></script> --}}
    <script src="{{ URL::asset('js/currency.js') }}"></script>

    {{-- swwet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('achart/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('achart/css/apexcharts.min.css') }}"></script>
    <script src="{{ asset('sbadmin2/js/rajaongkir.js') }}"></script>
    @stack('js')

    <script>
        $(document).ready(function() {
            $('#tables').DataTable();
        });

        function logout(form_id) {
            Swal.fire({
                title: 'Yakin Ingin Keluar?',
                text: "Anda akan keluar dari aplikasi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cencelButtonText: 'batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(form_id).submit()
                }
            })
        }

        function hapus_data(form_id) {
            Swal.fire({
                title: 'Ingin mau dihapus data?',
                text: "Data akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cencelButtonText: 'batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(form_id).submit()
                }
            })
        }

        function send_form(form_id) {
            // alert(form_id) //tes

            let form = $(form_id)
            let btn = form.find('#btn_submit')
            let icon_btn = btn.find('i')

            let action = form.attr('action')
            let method = form.attr('method')
            let data = new FormData(form[0])

            // icon_btn.replaceWith('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: action,
                data: data,
                method: method,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    icon_btn.replaceWith(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    );
                    form.find('input, select, textarea').removeClass('is-invalid')
                    form.find('.error_alert').text('')
                },
                success: function(response) {
                    // console.log(response);
                    window.location.href = response.data
                },
                error: function(response) {
                    // console.log(response);
                    let res = response.responseJSON
                    $.each(res.data, function(index, value) {
                        value = value[0]
                        form.find('[name="' + index + '"]').addClass('is-invalid')
                        form.find('#' + index + '_error_alert').text(value)

                        // console.log(value[0]);
                    });
                },
                complete: function() {
                    btn.find('span').replaceWith(icon_btn)
                }
            })
        }
    </script>
