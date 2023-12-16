<!-- Modal -->
<div class="modal fade" id="keranjangKartuNama" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('keranjang.store') }}" enctype="multipart/form-data">
                <h5 class="text-center">Tempah Kartu Nama</h5>
                @csrf
                <div class="modal-body">

                    <div class="container-fluid">
                        <input type="hidden" name="produk_id" id="produk_idKartuNama" value="">
                        <input type="hidden" id="hargaKartuNama" value="">
                        <input type="hidden" id="totalHargaKartuNama" value="">

                        <label for="myCheckboxKN">Foto Dari Kami</label>
                        <input type="checkbox" id="myCheckboxKN">

                        <div class="mb-3" id="fkartuNama">
                            <div class="d-flex justify-content-between">
                                <label for="fotoKN" class="form-label">Foto Sendiri</label>
                            </div>
                            <input type="file"
                                class="form-control @error('foto')
                                is-invalid
                            @enderror"
                                name="foto" id="fotoKN" required>
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="keteranganKartuNama" class="form-label">Keterangan</label>
                            </div>
                            <textarea name="keterangan"
                                class="form-control @error('keterangan')
                                is-invalid
                            @enderror"
                                id="keteranganKartuNama"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="jumlahKartuNama" class="form-label">Jumlah (Kotak)</label>
                                <label for="jumlahKartuNama" class="form-label" id="num_qtyKartuNama"></label>
                            </div>
                            <input type="number"
                                class="form-control @error('kuantitas')
                                is-invalid
                            @enderror"
                                name="kuantitas" id="jumlahKartuNama" placeholder="Masukan jumlah kuantitas"
                                onkeyup="showTotalKartuNama()" required>
                            @error('kuantitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h3 id="totalKartuNama">Hasil</h3>
                        <p id="hargaAwalKartuNama"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="tutupModal('#keranjangKartuNama')">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>
