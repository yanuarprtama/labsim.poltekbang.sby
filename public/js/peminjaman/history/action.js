import * as service from "../../helper/service.js"
import { url, csrf_token } from "../../helper/environment.js"
import * as word from "../../helper/word.js"
import * as validation from "../../helper/validation.js"

$(document).ready(function () {
    let inventaris_tag = $("#inventaris_tag")
    let laboratorium_tag = $("#laboratorium_tag")
    let table_inventaris = $("#table_inventaris")
    let table_laboratorium = $("#table_laboratorium")

    $.ajax({
        type: "GET",
        url: url + "/riwayat/laboratorium",
        dataType: "json",
        success: function (response) {
            service.renderRiwayatPeminjamanLaboratorium(response.data)
        }
    });

    $.ajax({
        type: "GET",
        url: url + "/riwayat/inventaris",
        dataType: "json",
        success: function (response) {
            service.renderRiwayatPeminjamanInventaris(response.data)
        }
    });

    inventaris_tag.click(function (e) {
        e.preventDefault();
        if (table_inventaris.hasClass("d-none")) {
            resetTagToggle()
            resetTable()
            table_inventaris.removeClass("d-none")
            inventaris_tag.addClass("text-white")
            inventaris_tag.addClass("bg-primary")
        }
    });

    laboratorium_tag.click(function (e) {
        e.preventDefault();
        if (table_laboratorium.hasClass("d-none")) {
            resetTagToggle()
            resetTable()
            table_laboratorium.removeClass("d-none")
            $(this).addClass("bg-primary")
            $(this).addClass("text-white")
        }
    });

    const resetTable = () => {
        let container = $("#table_history_container")

        $.each(container.children(), function (i, elm) {
            $.each(elm.className.split(" "), function (j, elmInner) {
                let status = true
                if (elmInner == "d-none") {
                    status = false
                }

                if (status) {
                    elm.classList.add("d-none")
                }
            });
        });
    }

    const resetTagToggle = () => {
        let container = $("#tag_container")

        $.each(container.children(), function (i, elm) {
            elm.classList.remove("bg-primary")
            elm.classList.remove("text-white")
        });
    }

});

$(document).on("click", "#batal_inventaris", function (e) {
    e.preventDefault()
    let id = $(this).data("id")
    let type = $(this).data("type")
    pembatalanPeminjaman(id, type)
});

$(document).on("click", "#batal_laboratorium", function (e) {
    e.preventDefault()
    let id = $(this).data("id")
    let type = $(this).data("type")
    pembatalanPeminjaman(id, type)
});

$(document).on("click", "#kritik_saran", function (e) {
    e.preventDefault()
    var id = $(this).parent().parent().data("id")
    var type = $(this).parent().parent().data("type")
    var kritik = $(this).parent().siblings()[0].children[1]
    var kritik_error = $(this).parent().siblings()[0].children[2]
    var saran = $(this).parent().siblings()[1].children[1]
    var saran_error = $(this).parent().siblings()[1].children[2]
    var modal = $(this).parents()[5]

    var error_kritik_message = validation.isValidateInput(kritik.value)
    var error_saran_message = validation.isValidateInput(saran.value)

    kritik_error.innerHTML = error_kritik_message
    saran_error.innerHTML = error_saran_message

    if (error_kritik_message == "" && error_saran_message == "") {
        if (type == "inventaris") {
            $.ajax({
                type: "POST",
                url: url + "/kritik-saran/store",
                data: {
                    _token: csrf_token,
                    ks_kritik: kritik.value,
                    ks_saran: saran.value,
                    peminjaman_inventaris_id: id,
                    type: type,
                },
                dataType: "JSON",
                success: function (response) {
                    alert("Berhasil mengembalikan")
                    bootstrap.Modal.getInstance(modal).hide()
                    service.refreshHistoryInventaris()
                },
                error: function (response) {
                    alert("Gagal mengembalikan")
                },
            });
        } else if (type == "laboratorium") {
            $.ajax({
                type: "POST",
                url: url + "/kritik-saran/store",
                data: {
                    _token: csrf_token,
                    ks_kritik: kritik.value,
                    ks_saran: saran.value,
                    peminjaman_laboratorium_id: id,
                    type: type,
                },
                dataType: "JSON",
                success: function (response) {
                    alert("Berhasil mengembalikan")
                    bootstrap.Modal.getInstance(modal).hide()
                    service.refreshHistoryLaboratorium()
                },
                error: function (response) {
                    alert("Gagal mengembalikan")
                },
            });

        }
    }
});

function pembatalanPeminjaman(id, type) {
    $.ajax({
        type: "POST",
        url: `${url}/peminjaman/batal`,
        data: {
            _token: csrf_token,
            id: id,
            type_peminjaman: type
        },
        dataType: "JSON",
        success: function (response) {
            type == "laboratorium" ? service.refreshHistoryLaboratorium() : service.refreshHistoryInventaris()

            container.before(`<div class="alert alert-success alert-dismissible fade show" id="error_message" role="alert">
                        ${response.message}
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`)
        },
        error: (response) => {
            container.before(`<div class="alert alert-danger alert-dismissible fade show" id="error_message" role="alert">
            ${response.responseJSON.message}
    <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`)
        }
    });
}