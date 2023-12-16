<!-- Modal -->
<div class="modal fade" id="keranjangBrosur" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('keranjang.store') }}" enctype="multipart/form-data">
                <h5 class="text-center">Tempah Brosur</h5>
                @csrf
                <div class="modal-body">

                    <div class="container-fluid">
                        <input type="hidden" name="produk_id" id="produk_idBrosur" value="">
                        <input type="hidden" id="hargaBrosur" value="">
                        <input type="hidden" id="totalHargaBrosur" value="">

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="kertas" class="form-label">Kertas Brosur </label>
                            </div>
                            <div class="row">
                                A4 <input type="radio" class="form-check" id="A4Brosur" name="kertas" value="A4"
                                    required>
                                A5 <input type="radio" class="form-check" id="A5Brosur" name="kertas"
                                    value="A5">
                            </div>
                        </div>

                        <label for="myCheckbox">Foto Dari Kami</label>
                        <input type="checkbox" id="myCheckboxBrosur">

                        <div class="mb-3 fotoBrosur">
                            <div class="d-flex justify-content-between">
                                <label for="fotoBrosur" class="form-label">Foto Sendiri</label>
                            </div>
                            <input type="file"
                                class="form-control @error('foto')
                                is-invalid
                            @enderror"
                                name="foto" id="fotoBrosur" required>
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="keteranganBrosur" class="form-label">Keterangan</label>
                            </div>
                            <textarea name="keterangan"
                                class="form-control @error('keterangan')
                                is-invalid
                            @enderror"
                                id="keteranganBrosur"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="jumlahBrosur" class="form-label">Jumlah</label>
                                <label for="jumlahBrosur" class="form-label" id="num_qtyBrosur"></label>
                            </div>
                            <input type="number"
                                class="form-control @error('kuantitas')
                                is-invalid
                            @enderror"
                                name="kuantitas" id="jumlahBrosur" placeholder="Masukan jumlah kuantitas"
                                onkeyup="showTotalBrosur()" required>
                            @error('kuantitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h3 id="totalBrosur">Hasil</h3>
                        <p id="hargaAwalBrosur"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="tutupModal('#keranjangBrosur')">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>
