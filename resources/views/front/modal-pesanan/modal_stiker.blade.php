<!-- Modal -->
<div class="modal fade" id="keranjangStiker" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('keranjang.store') }}" enctype="multipart/form-data">
                <h5 class="text-center">Tempah Stiker</h5>
                @csrf
                <div class="modal-body">

                    <div class="container-fluid">
                        <input type="hidden" name="produk_id" id="produk_idStiker" value="">
                        <input type="hidden" id="hargaStiker" value="">
                        <input type="hidden" id="totalHargaStiker" value="">

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="panjangStiker" class="form-label">Panjang</label>
                            </div>
                            <input type="number"
                                class="form-control @error('panjang')
                                is-invalid
                            @enderror"
                                name="panjang" id="panjangStiker" placeholder="Masukan Berapa Meter Panjar"
                                onkeyup="showTotalStiker()" required>
                            @error('panjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="lebarStiker" class="form-label">Lebar</label>
                            </div>
                            <input type="number"
                                class="form-control @error('lebar')
                                is-invalid
                            @enderror"
                                name="lebar" id="lebarStiker" placeholder="Masukan Berapa Meter Lebar"
                                onkeyup="showTotalStiker()" required>
                            @error('lebar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="fotoStiker" class="form-label">Foto Sendiri</label>
                            </div>
                            <input type="file"
                                class="form-control @error('foto')
                                is-invalid
                            @enderror"
                                name="foto" id="fotoStiker" required>
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="keteranganStiker" class="form-label">Keterangan</label>
                            </div>
                            <textarea name="keterangan"
                                class="form-control @error('keterangan')
                                is-invalid
                            @enderror"
                                id="keteranganStiker"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="jumlahStiker" class="form-label">Jumlah</label>
                                <label for="jumlahStiker" class="form-label" id="num_qtyStiker"></label>
                            </div>
                            <input type="number"
                                class="form-control @error('jumlah')
                                is-invalid
                            @enderror"
                                name="kuantitas" id="jumlahStiker" placeholder="Masukan jumlah kuantitas"
                                onkeyup="showTotalStiker()" required>
                            @error('kuantitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h3 id="totalStiker">Hasil</h3>
                        <p id="hargaAwalStiker"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="tutupModal('#keranjangStiker')">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
@endpush
