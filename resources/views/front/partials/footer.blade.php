 <!-- footer mulai-->
 <footer>
     <div class="container">
         <div class="row">
             <div class="col-md-3">
                 @if ($footer->fot_tentang == null)
                     <h4 class="widget-title-sm">Tentang Kami</h4>
                     <p>Digital Printing Online melayani : digital printing , seperti cetak spanduk, sticker, banner,
                         poster, baliho, dan produk-produk lainnya</p>
                 @else
                     {!! $footer->fot_tentang !!}
                 @endif
                 <ul class="footer-social">
                     <a target="_blank" href="{{ $medsos == null ? '#' : $medsos->yt }}"><i
                             class="fab fa-facebook"></i></a>
                     <a target="_blank" href="{{ $medsos == null ? '#' : $medsos->twitter }}"><i
                             class="fab fa-twitter"></i></i></a>
                     <a target="_blank" href="{{ $medsos == null ? '#' : $medsos->ig }}"><i
                             class="fab fa-instagram"></i></i></a>
                     <a target="_blank" href="{{ $medsos == null ? '#' : $medsos->yt }}"><i
                             class="fab fa-youtube"></i></i></a>
                 </ul>

             </div>
             <div class="col-md-3">
                 @if ($footer->fot_alamat == null)
                     <h4 class="widget-title-sm">Alamat</h4>
                     <p>Toko Sekitaran Kota Binjai</p>
                 @else
                     {!! $footer->fot_alamat !!}
                 @endif
             </div>
             <div class="col-md-3">
                 @if ($footer->fot_kontak == null)
                     <h4 class="widget-title-sm">Kontak</h4>
                     <p>(021) 22730858 - (021) 22704353</p>
                     <p>Whats-app = 0813-7859-0777</p>
                 @else
                     {!! $footer->fot_kontak !!}
                 @endif
             </div>
             <div class="col-md-3">
                 @if ($footer->fot_jambuka == null)
                     <h4 class="widget-title-sm">Jam Buka</h4>
                     <table>
                         <tr>
                             <td style="padding: 3px;">Senin</td>
                             <td style="padding: 3px;"> : </td>
                             <td style="padding: 3px;">08.00 – 18.00</td>
                         </tr>
                         <tr>
                             <td style="padding: 3px;">Selasa</td>
                             <td style="padding: 3px;"> : </td>
                             <td style="padding: 3px;">08.00 – 18.00</td>
                         </tr>
                         <tr>
                             <td style="padding: 3px;">Rabu</td>
                             <td style="padding: 3px;"> : </td>
                             <td style="padding: 3px;">08.00 – 18.00</td>
                         </tr>
                         <tr>
                             <td style="padding: 3px;">Kamis</td>
                             <td style="padding: 3px;"> : </td>
                             <td style="padding: 3px;">08.00 – 18.00</td>
                         </tr>
                         <tr>
                             <td style="padding: 3px;">Jum'at</td>
                             <td style="padding: 3px;"> : </td>
                             <td style="padding: 3px;">08.00 – 18.00</td>
                         </tr>
                         <tr>
                             <td style="padding: 3px;">Sabtu</td>
                             <td style="padding: 3px;"> : </td>
                             <td style="padding: 3px;">08.00 – 18.00</td>
                         </tr>
                     </table>
                 @else
                     {!! $footer->fot_jambuka !!}
                 @endif
             </div>

         </div>
     </div>
 </footer>

 <div class="created">
     <p>Created By <a href="#">Andri Syahputra</a>. | &copy; 2023</p>
 </div>
