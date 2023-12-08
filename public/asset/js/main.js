// ketika tombol menu di klik
// buat navbar
const navbarMenu = document.querySelector(".navbar-menu");
// akhir navbar

// buat cart
const cartMenu = document.querySelector(".cart");
const btnCart = document.getElementById("btn-cart");
// akhir cart

// buat login
// ketika tombol user di klik
const userMenu = document.querySelector(".user");
// akhir login

// buat pencarian
// ketika tombol search di klik
const searchForm = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");
// akhir pencarian

// keranjang
// Menggunakan event mouseenter untuk menampilkan cart
btnCart.addEventListener("mouseenter", () => {
    cartMenu.classList.add("active");
    searchForm.classList.remove("active");
});

// Menggunakan event mouseleave untuk menyembunyikan cart
cartMenu.addEventListener("mouseleave", () => {
    cartMenu.classList.remove("active");
});

document.querySelector("#btn-menu").onclick = () => {
    navbarMenu.classList.toggle("active");
};
// akhir keranjang

// user
document.querySelector("#btn-user").onclick = (e) => {
    userMenu.classList.toggle("active");
    e.preventDefault();
};
// akhir user

// const cartMenu = document.querySelector(".cart");
// document.querySelector("#btn-cart").onclick = (e) => {
//     cartMenu.classList.toggle("active");
//     e.preventDefault();
// };

// cari
document.querySelector("#btn-search").onclick = (e) => {
    searchForm.classList.toggle("active");
    cartMenu.classList.remove("active");
    searchBox.focus();
    e.preventDefault();
    // akhir cari
};

// kemudian kita buat menu sidebar ketika di klik di luar menu navbar itu tetutup
const btnMenu = document.querySelector("#btn-menu");
document.addEventListener("click", function (e) {
    if (!btnMenu.contains(e.target) && !navbarMenu.contains(e.target)) {
        navbarMenu.classList.remove("active");
    }
});

// owl crausel produk
$(document).ready(function () {
    $(".hero .owl-carousel").owlCarousel({
        autoplay: true,
        nav: true,
        loop: true,
        dots: true,
        inifinite: true,
        speed: 4000,
        autoplaySpeed: 2500,
        slideToShow: 1,
        items: 1,
        navTex: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
        navContainer: "#owl-nav",
    });
});
// detail produk owl crausel
$(document).ready(function () {
    $(".detail-produk .owl-carousel").owlCarousel({
        nav: true,
        loop: true,
        dots: true,
        inifinite: true,
        speed: 4000,
        slideToShow: 1,
        items: 1,
        navTex: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
        navContainer: "#owl-nav",
    });
});

// // raja ongkir
// $(document).ready(function () {
//   $.ajax({
//     url: "data_provinsi.php",
//     type: "post",
//     success: function (data_provinsi) {
//       $("select[name=provinsi]").html(data_provinsi);
//     },
//   });

//   $("select[name=provinsi]").on("change", function () {
//     var id_provinsi = $("option:selected", this).attr("id_provinsi");

//     $.ajax({
//       type: "post",
//       url: "data_distrik.php",
//       data: "id_provinsi=" + id_provinsi + "",
//       success: function (data_distrik) {
//         $("select[name=distrik]").html(data_distrik);
//       },
//     });
//   });

//   $.ajax({
//     type: "post",
//     url: "data_ekspedisi.php",
//     success: function (data_ekspedisi) {
//       $("select[name=ekspedisi]").html(data_ekspedisi);
//     },
//   });

//   $("select[name=ekspedisi]").on("change", function () {
//     var nama_eksepedisi = $("select[name=ekspedisi]").val();
//     var data_distrik = $("option:selected", "select[name=distrik]").attr(
//       "id_distrik"
//     );
//     var total_berat = $("input[name=total_berat]").val();

//     $.ajax({
//       type: "post",
//       url: "data_paket.php",
//       data:
//         "ekspedisi=" +
//         nama_eksepedisi +
//         "&distrik=" +
//         data_distrik +
//         "&berat=" +
//         total_berat +
//         "",
//       success: function (data_paket) {
//         $("select[name=paket]").html(data_paket);
//         $("input[name=nama_ekspedisi]").val(nama_eksepedisi);
//       },
//     });
//   });

//   $("select[name=distrik]").on("change", function () {
//     var prof = $("option:selected", this).attr("nama_provinsi");
//     var dist = $("option:selected", this).attr("nama_distrik");
//     var type = $("option:selected", this).attr("type_distrik");
//     var pos = $("option:selected", this).attr("kode_pos");
//     $("input[name=nama_provinsi]").val(prof);
//     $("input[name=nama_distrik]").val(dist);
//     $("input[name=type_distrik]").val(type);
//     $("input[name=kode_pos]").val(pos);
//   });
//   $("select[name=paket]").on("change", function () {
//     var paket = $("option:selected", this).attr("paket");
//     var ongkir = $("option:selected", this).attr("ongkir");
//     var etd = $("option:selected", this).attr("etd");
//     $("input[name=paket]").val(paket);
//     $("input[name=ongkir]").val(ongkir);
//     $("input[name=etd]").val(etd);
//   });
// });

// pagination mulai
function getPageList(totalPage, page, maxLength) {
    function rage(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start);
    }
    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    if (totalPage <= maxLength) {
        return rage(1, totalPage);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        return rage(1, maxLength - sideWidth - 1).concat(
            0,
            rage(totalPage - sideWidth + 1, totalPage)
        );
    }

    if (page >= totalPage - sideWidth - 1 - rightWidth) {
        return rage(1, sideWidth).concat(
            0,
            rage(totalPage - sideWidth - 1 - rightWidth - leftWidth, totalPage)
        );
    }

    return rage(1, sideWidth).concat(
        0,
        rage(page - leftWidth, page + rightWidth),
        0,
        rage(totalPage - sideWidth + 1, totalPage)
    );
}

$(function () {
    var numberOfItems = $(".card-produk .card").length;
    var limitPerPage = 6; //jumlah produk didalam perhalaman produk
    var totalPage = Math.ceil(numberOfItems / limitPerPage);
    var paginationSize = 5; //jumlah angka didalm pagenation
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPage) return false;
        currentPage = whichPage;

        $(".card-produk .card")
            .hide()
            .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
            .show();

        $(".pagination li").slice(1, -1).remove();

        getPageList(totalPage, currentPage, paginationSize).forEach((item) => {
            $("<li>")
                .addClass("page-item")
                .addClass(item ? "halaman" : "dots")
                .toggleClass("active", item === currentPage)
                .append(
                    $("<a>")
                        .addClass("page-link")
                        .attr({ href: "javascript:void(0)" })
                        .text(item || "...")
                )
                .insertBefore(".next");
        });

        $(".prev").toggleClass("disabled", currentPage === 1);
        $(".next").toggleClass("disabled", currentPage === totalPage);
        return true;
    }

    $(".pagination").append(
        $("<li>")
            .addClass("page-item")
            .addClass("prev")
            .append(
                $("<a>")
                    .addClass("page-link")
                    .attr({
                        href: "javascript:void(0)",
                    })
                    .text("prev")
            ),

        $("<li>")
            .addClass("page-item")
            .addClass("next")
            .append(
                $("<a>")
                    .addClass("page-link")
                    .attr({
                        href: "javascript:void(0)",
                    })
                    .text("next")
            )
    );

    $(".card-produk").show();
    showPage(1);

    $(document).on("click", ".pagination li.halaman:not(.active)", function () {
        return showPage(+$(this).text());
    });

    $(".next").on("click", function () {
        return showPage(currentPage + 1);
    });

    $(".prev").on("click", function () {
        return showPage(currentPage - 1);
    });
});

// pagination akhir
