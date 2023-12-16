<!-- Modal -->
<div class="modal fade" id="keranjangSpanduk" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('keranjang.store') }}" enctype="multipart/form-data">
                <h5 class="text-center">Tempah Spanduk</h5>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="produk_id" id="produk_idSpanduk" value="">
                        <input type="hidden" id="hargaSpanduk" value="">
                        <input type="hidden" id="totalHargaSpanduk" value="">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="panjangSpanduk" class="form-label">Panjang</label>
                            </div>
                            <input type="number"
                                class="form-control @error('panjang')
                                is-invalid
                            @enderror"
                                name="panjang" id="panjangSpanduk" placeholder="Masukan Berapa Meter Panjar"
                                onkeyup="showTotalSpanduk()" required>
                            @error('panjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="lebarSpanduk" class="form-label">Lebar</label>
                            </div>
                            <input type="number"
                                class="form-control @error('lebar')
                                is-invalid
                            @enderror"
                                name="lebar" id="lebarSpanduk" placeholder="Masukan Berapa Meter Lebar"
                                onkeyup="showTotalSpanduk()" required>
                            @error('lebar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <label for="myChekSpanduk">Foto Dari Kami</label>
                        <input type="checkbox" id="myChekSpanduk">

                        <div class="mb-3" id="InputFotoSpanduk">
                            <div class="d-flex justify-content-between">
                                <label for="fotoSpanduk" class="form-label">Foto Sendiri</label>
                            </div>
                            <input type="file"
                                class="form-control @error('foto')
                                is-invalid
                            @enderror"
                                name="foto" id="fotoSpanduk" required>
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="keteranganSpanduk" class="form-label">Keterangan</label>
                            </div>
                            <textarea name="keterangan"
                                class="form-control @error('keterangan')
                                is-invalid
                            @enderror"
                                id="keteranganSpanduk"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="jumlahSpanduk" class="form-label">Jumlah</label>
                                <label for="jumlahSpanduk" class="form-label" id="num_qtySpanduk"></label>
                            </div>
                            <input type="number"
                                class="form-control @error('kuantitas')
                                is-invalid
                            @enderror"
                                name="kuantitas" id="jumlahSpanduk" placeholder="Masukan jumlah kuantitas"
                                onkeyup="showTotalSpanduk()" required>
                            @error('kuantitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h3 id="totalSpanduk">Hasil</h3>
                        <p id="hargaAwalSpanduk"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="tutupModal('#keranjangSpanduk')">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>
