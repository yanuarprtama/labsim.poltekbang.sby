import * as validation from "../../helper/validation.js"
import { url, csrf_token } from "../../helper/environment.js"


$(document).ready(function () {
    const jam_mulai = $("input#pl_jam_mulai")
    const jam_mulai_error = $("div#pl_jam_mulai_error")

    const jam_akhir = $("input#pl_jam_akhir")
    const jam_akhir_error = $("div#pl_jam_akhir_error")

    const mata_kuliah = $("input#pl_mata_kuliah")
    const mata_kuliah_error = $("div#pl_mata_kuliah_error")

    const jenis_kegiatan = $("select#pl_jenis_kegiatan")
    const jenis_kegiatan_error = $("div#jenis_kegiatan_error")

    const dosen_pengajar = $("input#pl_dosen_pengajar")
    const dosen_pengajar_error = $("div#pl_dosen_pengajar_error")

    const laboratorium = $("#pl_laboratorium")
    const laboratorium_error = $("div#pl_laboratorium_error")

    const form = $("form#peminjamanFormLaboratorium")

    $("button#buttonSubmitLaboratorium").click((e) => {
        e.preventDefault()
        console.log(jenis_kegiatan.val());
        var error_jam_mulai = validation.isValidateInputTime(jam_mulai.val())
        var error_jam_akhir = validation.isValidateInputTime(jam_akhir.val())
        var error_mata_kuliah = validation.isValidateInput(mata_kuliah.val())
        var error_jenis_kegiatan = validation.isValidateInputEnum(["penelitian", "praktikum"], jenis_kegiatan.val())
        var error_dosen_pengajar = validation.isValidateInput(dosen_pengajar.val())
        var error_laboratorium = validation.isValidateInput(laboratorium.val())
        console.log(laboratorium.val());

        jam_mulai_error.text(error_jam_mulai)
        jam_akhir_error.text(error_jam_akhir)
        mata_kuliah_error.text(error_mata_kuliah)
        jenis_kegiatan_error.text(error_jenis_kegiatan)
        dosen_pengajar_error.text(error_dosen_pengajar)
        laboratorium_error.text(error_laboratorium)

        if (error_jam_mulai == "" && error_jam_akhir == "") {
            jam_mulai_error.text(validation.startLessThanEnd(jam_mulai.val(), jam_akhir.val()))
        }

        if (error_jam_mulai == "" && error_jam_akhir == "" && error_mata_kuliah == "" && error_jenis_kegiatan == "" && error_dosen_pengajar == "" && error_laboratorium == "") {
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                data: {
                    _token: csrf_token,
                    pl_mata_kuliah: mata_kuliah.val(),
                    pl_jenis_kegiatan: jenis_kegiatan.val(),
                    pl_jam_mulai: jam_mulai.val(),
                    pl_jam_akhir: jam_akhir.val(),
                    pl_dosen_pengajar: dosen_pengajar.val(),
                    laboratorium_id: laboratorium.val()
                },
                dataType: "json",
                success: function (response) {
                    $("input").val("")
                    dosen_pengajar.val("")
                    jenis_kegiatan.children()[0].selected = true
                    laboratorium.children()[0].selected = true
                    form.before(`<div class="alert alert-success alert-dismissible fade show" id="error_message" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
                },
                error: function (response) {
                    form.before(`<div class="alert alert-danger alert-dismissible fade show" id="error_message" role="alert">
                    ${response.responseJSON.message}
            <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`);
                }
            });
        }
    })
}); 