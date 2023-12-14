@extends('layouts.app_bsadmin2')

@section('content')
    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_category"> <i class="bi bi-plus-lg"></i>
        Tambah Kategori
    </button>

    {{-- <a href="index.php?halaman=tambah_kategori" class="btn btn-sm btn-success">Tambah Kategori</a> --}}

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-nowrap">Nama</th>
                        <th class="text-nowrap">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $item)
                        <tr>
                            <td width="1%">{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $item->nama }}</td>
                            <td class="text-nowrap text-center" width="150">
                                <div class="row d-flex justify-content-center ">

                                    @if ($item->id >= 5)
                                        <button class="btn btn-sm btn-warning m-1"
                                            onclick="edit_category('{{ route('kategori.update', $item->id) }}','{{ json_encode($item) }}')">Edit</button>
                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="post"
                                            id="dalete_form{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger m-1"
                                                onclick="hapus_data('#dalete_form{{ $item->id }}')">Hapus</button>
                                        </form>
                                    @else
                                        Tidak Bisa Di Hapus Dan Diubah
                                    @endif
                                </div>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@push('modal')
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="add_category" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <form class="form_kategori" action="{{ route('kategori.store') }}" method="POST" id="form"
                    onkeydown="return event.key != 'Enter';">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Kategori">
                        <div class="text-danger error_alert" id="nama_error_alert"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="send_form('#form')" id="btn_submit"> <i
                                class="bi bi-files"></i> Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_category" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <form class="form_kategori" method="POST" id="edit_form" onkeydown="return event.key != 'Enter';">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Ubah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Kategori">
                        <div class="text-danger error_alert" id="nama_error_alert"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="send_form('#edit_form')" id="btn_submit"> <i
                                class="bi bi-files"></i> Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script>
        function edit_category(route, data) {
            let modal = $('#edit_category')
            let form = modal.find('form')
            form.attr('action', route)
            data = JSON.parse(data)
            // console.log(data.nama);
            $.each(data, function(index, value) {
                form.find('input[name="' + index + '"]').val(value)
                form.find('textarea[name="' + index + '"]').text(value)
            });
            modal.modal('show')
        }
    </script>
@endpush
