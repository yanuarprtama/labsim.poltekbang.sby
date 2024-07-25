import { url } from "./environment.js"
import * as word from "./word.js"

export function refreshHistoryLaboratorium() {
    let container = $("#list_peminjaman_laboratorium")
    container.empty()
    $.ajax({
        type: "GET",
        url: url + "/riwayat/laboratorium",
        dataType: "json",
        success: function (response) {
            renderRiwayatPeminjamanLaboratorium(response.data)
        }
    });
}

export function refreshHistoryInventaris() {
    const container = $("#list_peminjaman_inventaris")
    let container_riwayat_modal = $("#modal_inventaris_container")

    container.empty();
    container_riwayat_modal.empty();
    $.ajax({
        type: "GET",
        url: url + "/riwayat/inventaris",
        dataType: "json",
        success: function (response) {
            renderRiwayatPeminjamanInventaris(response.data)
        }
    });
}

export function renderRiwayatPeminjamanLaboratorium(data) {
    $.each(data, function (index, row) {
        const list_peminjaman_laboratorium = $("#list_peminjaman_laboratorium")
        let status;
        let cancel_icon = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m5 13.59L15.59 17L12 13.41L8.41 17L7 15.59L10.59 12L7 8.41L8.41 7L12 10.59L15.59 7L17 8.41L13.41 12z"/></svg>`;
        let tinyStatus = word.fuWord(row.pl_status)
        var container_modal = $("#modal_laboratorium_container")
        let button_modal = `<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laboratorium-${row.id}">Lihat Detail</button>`
        let modal
        var kritik_saran = renderKritikSaran(row, "laboratorium")

        modal = `<div class="modal fade" id="laboratorium-${row.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detail Laboratorium</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <td>Jam Mulai</td>
                                    <td>:</td>
                                    <td>${row.pl_jam_mulai}</td>
                                </tr>
                                <tr>
                                    <td>Jam Akhir</td>
                                    <td>:</td>
                                    <td>${row.pl_jam_akhir}</td>
                                </tr>
                                <tr>
                                    <td>Nama Dosen Pengajar</td>
                                    <td>:</td>
                                    <td>${row.pl_dosen_pengajar}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kegiatan</td>
                                    <td>:</td>
                                    <td>${word.fuWord(row.pl_jenis_kegiatan)}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>`

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
                status = `<span class="btn btn-danger rounded p-1 text-white">${tinyStatus}</span>`
                break;
            case "DIKEMBALIKAN":
                status = `<span class="btn btn-secondary rounded p-1">${tinyStatus}</span>`
                break;
        }

        let cancel_html = row.pl_status !== "DITERIMA" ? `<a href="">${cancel_icon} batal</a>` : ""

        list_peminjaman_laboratorium.append(`<tr>
                            <td class="cursor-pointer" width="100" data-id="${row.id}" data-type="laboratorium" id="batal_laboratorium">${cancel_html}</td>
                            <td>${word.fuWord(row.pl_jenis_kegiatan)}</td>
                            <td>${(row.pl_jam_mulai)} - ${row.pl_jam_akhir}</td>
                            <td>${status}</td>
                            <td>${button_modal}</td>
                            <td>${kritik_saran.button_modal_kembali}</td>
                            </tr>
                            `)
        container_modal.append(kritik_saran.modal_kembali)
        container_modal.append(modal)
    });
}

export function renderRiwayatPeminjamanInventaris(data) {
    $.each(data, function (index, row) {
        const list_peminjaman_inventaris = $("#list_peminjaman_inventaris")
        let container_riwayat = $("#modal_inventaris_container")
        let status;
        let cancel_icon = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m5 13.59L15.59 17L12 13.41L8.41 17L7 15.59L10.59 12L7 8.41L8.41 7L12 10.59L15.59 7L17 8.41L13.41 12z"/></svg>`;
        let tinyStatus = word.fuWord(row.pi_status)
        let button_modal = `<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-${row.id}">Lihat Detail</button>`
        let modal
        var kritik_saran = renderKritikSaran(row, "inventaris")

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
                status = `<span class="btn btn-danger rounded p-1 text-white">${tinyStatus}</span>`
                break;
            case "DIKEMBALIKAN":
                status = `<span class="btn btn-secondary rounded p-1">${tinyStatus}</span>`
                break;
        }

        let cancel_html = row.pi_status !== "DITERIMA" ? `<a class="text-primary">${cancel_icon} batal</a>` : ""
        list_peminjaman_inventaris.append(`<tr>
                            <td width="100" class="cursor-pointer" data-id="${row.id}" data-id="${row.id}" data-type="inventaris" id="batal_inventaris">${cancel_html}</td>
                            <td>${laboratorium}</td>
                            <td>${(row.pi_jam_mulai)} - ${row.pi_jam_akhir}</td>
                            <td width="100">${status}</td>
                            <td width="120">${button_modal}</td>
                            <td width="100">${kritik_saran.button_modal_kembali}</td>
                            </tr>
                            `)
        container_riwayat.append(modal)
        container_riwayat.append(kritik_saran.modal_kembali)
    });
}

export function renderKritikSaran(data, type) {
    let button_modal_kembali = `<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kembali-${type}-${data.id}">Kembalikan</button>`

    return {
        modal_kembali: `<div class="modal fade" id="kembali-${type}-${data.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Kritik dan Saran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        ${data.pi_status !== "DIKEMBALIKAN" ? `<form id="kritik_saran_form" data-id="${data.id}" data-type="${type}">
                 <div class="mb-3">
                    <label for="ks_kritik" class="form-label">Kritik</label>
                    <input type="text" class="form-control" id="ks_kritik">
                    <span class="text-danger text-sm" id="ks_kritik"></span>
                </div>
                <div class="mb-3">
                    <label for="ks_saran" class="form-label">Saran</label>
                    <input type="text" class="form-control" id="ks_saran">
                    <span class="text-danger text-sm" id="ks_saran"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="kritik_saran" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>` : `<h5>Peminjaman sudah dikembalikan</h5>`}
            
        </div>
        </div>
    </div>
    </div>`, button_modal_kembali: button_modal_kembali
    }
}