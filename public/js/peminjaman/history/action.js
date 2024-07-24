import * as service from "../../helper/service.js"
import { url, csrf_token } from "../../helper/environment.js"
import * as word from "../../helper/word.js"

$(document).ready(function () {
    const list_peminjaman_inventaris = $("#list_peminjaman_inventaris")
    const list_peminjaman_laboratorium = $("#list_peminjaman_laboratorium")
    let inventaris_tag = $("#inventaris_tag")
    let laboratorium_tag = $("#laboratorium_tag")
    let table_inventaris = $("#table_inventaris")
    let table_laboratorium = $("#table_laboratorium")
    let container_riwayat = $("#modal_inventaris_container")

    $.ajax({
        type: "GET",
        url: url + "/riwayat/laboratorium",
        dataType: "json",
        success: function (response) {
            $.each(response.data, function (index, row) {
                let status;
                let cancel_icon = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m5 13.59L15.59 17L12 13.41L8.41 17L7 15.59L10.59 12L7 8.41L8.41 7L12 10.59L15.59 7L17 8.41L13.41 12z"/></svg>`;
                let tinyStatus = word.fuWord(row.pl_status)

                switch (row.pl_status) {
                    case "DITERIMA":
                        status = `<span class="btn btn-success rounded p-2 text-white">${tinyStatus}</span>`
                        break;
                    case "PROSES":
                        status = `<span class="btn btn-warning rounded p-1 text-white">${tinyStatus}</span>`
                        break;
                    case "DITOLAK":
                        status = `<span class="btn btn-warning rounded p-1 text-white">${tinyStatus}</span>`
                        break;
                    case "DIBATALKAN":
                        status = `<span class="btn btn-warning rounded p-1 text-white">${tinyStatus}</span>`
                        break;
                    case "DIKEMBALIKAN":
                        status = `<span class="bg-secondary rounded p-1">${tinyStatus}</span>`
                        break;
                }

                let cancel_html = row.pl_status !== "PROSES" ? `<a href="">${cancel_icon} batal</a>` : ""

                list_peminjaman_laboratorium.append(`<tr>
                                    <td class="cursor-pointer" width="100" data-id="${row.id}" data-type="laboratorium" id="batal_laboratorium">${cancel_html}</td>
                                    <td>${word.fuWord(row.pl_jenis_kegiatan)}</td>
                                    <td>${(row.pl_jam_mulai)} - ${row.pl_jam_akhir}</td>
                                    <td>${status}</td>
                                    </tr>
                                    `)
            });
        }
    });

    $.ajax({
        type: "GET",
        url: url + "/riwayat/inventaris",
        dataType: "json",
        success: function (response) {
            $.each(response.data, function (index, row) {
                let status;
                let cancel_icon = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m5 13.59L15.59 17L12 13.41L8.41 17L7 15.59L10.59 12L7 8.41L8.41 7L12 10.59L15.59 7L17 8.41L13.41 12z"/></svg>`;
                let tinyStatus = word.fuWord(row.pi_status)
                let button_modal = `<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-${row.id}">Lihat Detail</button>`
                let modal
                let laboratorium
                let list_inventaris = `<ol class="list-group list-group-numbered"></ol>`


                $.each(row.inventaris, function (innerIndex, innerRow) {
                    laboratorium = innerRow.laboratorium.l_nama
                    list_inventaris += `<li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                    <div class="fw-bold">${innerRow.a_nama}</div>
                    </div>
                    <span class="badge bg-primary rounded-pill">${innerRow.inventaris.dpi_qty} pcs</span>
                                    </li>`
                });

                modal = `<div class="modal fade" id="staticBackdrop-${row.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">List Inventaris</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${list_inventaris}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>`

                switch (row.pi_status) {
                    case "DITERIMA":
                        status = `<span class="btn btn-success rounded p-2 text-white">${tinyStatus}</span>`
                        break;
                    case "DIPROSES":
                        status = `<span class="btn btn-warning rounded p-1 text-white">${tinyStatus}</span>`
                        break;
                    case "DITOLAK":
                        status = `<span class="btn btn-warning rounded p-1 text-white">${tinyStatus}</span>`
                        break;
                    case "DIBATALKAN":
                        status = `<span class="btn btn-warning rounded p-1 text-white">${tinyStatus}</span>`
                        break;
                    case "DIKEMBALIKAN":
                        status = `<span class="bg-secondary rounded p-1">${tinyStatus}</span>`
                        break;
                }

                let cancel_html = row.pi_status !== "PROSES" ? `<a class="text-primary">${cancel_icon} batal</a>` : ""
                list_peminjaman_inventaris.append(`<tr>
                                    <td width="100" class="cursor-pointer" data-id="${row.id}" data-id="${row.id}" data-type="inventaris" id="batal_inventaris">${cancel_html}</td>
                                    <td>${laboratorium}</td>
                                    <td>${(row.pi_jam_mulai)} - ${row.pi_jam_akhir}</td>
                                    <td width="100">${status}</td>
                                    <td width="100">${button_modal}</td>
                                    </tr>
                                    `)
                container_riwayat.append(modal)
            });
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