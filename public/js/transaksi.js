function addKondisiMobil() {
    var margin = $("<div class='mb-3' id='outlier-form'></div>");
    var marginKondisi = $("<div class='mb-3'></div>");
    var marginKeterangan = $("<div class='mb-3'></div>");
    var batas = $("<hr class='border border-secondary border-2 opacity-50'>");
    var labelKondisiMobil = $(
        "<label class='form-label' for='kondisi_mobil'>Kondisi Mobil</label>"
    );
    var inputKondisiMobil = $(
        "<input class='form-control form-control' name='kondisi_mobil[]' type='file' accept='image/*' capture='camera' id='formFile' multiple>"
    );

    var labelKeterangan = $(
        '<label for="keterangan[]"class="form-label">Keterangan</label>'
    );
    var inputKeterangan = $(
        "<input type='text' class='form-control' id='keterangan' name='keterangan[]' >"
    );

    var innerBodyKondisi = marginKondisi.append(
        labelKondisiMobil,
        inputKondisiMobil
    );
    var innerBodyKeterangan = marginKeterangan.append(
        labelKeterangan,
        inputKeterangan
    );
    var outlierBody = margin.append(
        batas,
        innerBodyKondisi,
        innerBodyKeterangan
    );

    $("#form-kondisi-mobil").append(outlierBody);
}

// Tampilkan harga
function showPrice() {
    let data = $("#kendaraan").val();
    let price_kendaraan = $("#harga").text();
    let url = "get-kendaraan/" + data;

    $.ajax({
        url: "get-kendaraan/" + data,
        method: "GET",
        dataType: "json",
        success: (result) => {
            $(result).each((i, brand_kendaraan) => {
                $("#result-kendaraan").text("Harga Kendaraan " + brand_kendaraan.harga_sewa);
                $("#result-kendaraan-promo").val(brand_kendaraan.harga_sewa);
            });
        }
    });
}

function unmask_transaksi() {

    // Mask tambah transaksi harga

    $("#promo").unmask();

    // Mask tambah transaksi nomor telepon
    $("#no_telp").unmask();

    var tandaVal = document.querySelector("#tanda_tangan_pad").toDataURL('image/png');
    $("#tanda_tangan").val(tandaVal)

    return $("#form-transaksi").submit();
}

$(document).ready(() => {

    // Form Driver

    $("#driver-iya").on("change", () => {
        var parent = $(
            "<div class='mb-3 card col-md-6 p-2' id='p' style='background-color: #e8f4ea ;color: #2b4c40;'></div>"
        );
        var label = $(
            "<label class='form-label' for='biaya_supir' name='biaya_supir' placeholder='Silahkan Isi Biaya Driver' id='biaya_supir'>Masukkan Biaya Driver</label>"
        );
        var input = $("<input class='form-control' name='biaya_supir'>");

        var form = parent.append(label, input);
        var formFinish = $("#driver").after(form);
    });

    $("#driver-tidak").on("change", () => {
        $("#p").remove();
    });

    $("#remove").on("click", () => {
        $('#outlier-form').remove();
    });

    // Mask tambah transaksi harga

    $("#promo").mask("###.###.###.###", { reverse: true });

    // Mask tambah transaksi nomor telepon
    $("#no_telp").mask("###-####-####-####", { reverse: true });

    // SUM Potongan Harga
    $("#promo").on("input", () => {
        let promo = $("#promo").unmask().val();
        let sum = parseInt($("#result-kendaraan-promo").val()) - parseInt(promo);
        if (sum < 0 || Number.isNaN(sum)) {
            sum = 0;
        }

        $("#result-promo").val(promo);

        $("#result").val(sum);
    });

});
