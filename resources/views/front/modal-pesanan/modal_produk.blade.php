 <!-- Modal -->
 <div class="modal fade" id="keranjangProduk" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form method="post" action="{{ route('keranjang.store') }}" enctype="multipart/form-data">
                 <h5 class="text-center judul"></h5>
                 @csrf
                 <div class="modal-body">
                     <input type="hidden" name="produk_id" id="produk_idProduk" value="">
                     <input type="hidden" id="hargaProduk" value="">
                     <input type="hidden" id="totalHargaProduk" value="">
                     <div class="container-fluid">
                         <div class="mb-3">
                             <div class="d-flex justify-content-between">
                                 <label for="kuantitasProduk" class="form-label">Jumlah</label>
                                 <label for="kuantitasProduk" class="form-label" id="num_qtyProduk"></label>
                             </div>
                             <input type="number"
                                 class="form-control @error('kuantitas')
                                is-invalid
                             @enderror"
                                 name="kuantitas" id="jumlahProduk" placeholder="Masukan jumlah kuantitas"
                                 onkeyup="showTotalProduk()" required>
                             @error('kuantitas')
                                 is-invalid
                             @enderror
                         </div>
                         <h3 id="totalProduk">Hasil</h3>
                         <p id="hargaAwalProduk"></p>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary"
                         onclick="tutupModal('#keranjangProduk')">Close</button>
                     <button type="submit" class="btn btn-primary">Save</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
