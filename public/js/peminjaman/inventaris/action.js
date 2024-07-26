import * as validation from "../../helper/validation.js"
import { url, csrf_token } from "../../helper/environment.js"
import * as service from "../../helper/service.js"

$(document).ready(function () {
    var laboratorium = $("#laboratorium")
    var inventaris = $("#Inventaris")
    var item = []

    laboratorium.change(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: url + "/api/inventaris/data/" + laboratorium.val(),
            data: "data",
            dataType: "JSON",
            success: function (response) {
                var inventaris_field = $("#inventaris-field")
                if (!response.error) {
                    item = []
                    resetOption(inventaris)
                    inventaris_field.removeClass("d-none");
                    $.each(response.data, function (index, value) {
                        inventaris.append($(`<option value="${value.id}">
                            ${value.a_nama}</option>`));
                    })

                    $.each($("#inventarisTable tbody").children(), function (index,
                        value) {
                        value.remove()
                    });

                } else {
                    if (!inventaris_field.hasClass("d-none")) {
                        inventaris_field.addClass("d-none")
                    }
                }
            },
            error: (response) => {
                $("#error_message").removeClass("d-none")
                $("#error_message").text(response.message)
            }
        });
    });

    inventaris.on("change", (e) => {
        e.preventDefault()

        item.push(inventaris.val())
    })
});

$(document).on('click', '.removeInventaris', function () {
    const row = $(this).closest('tr');
    const inventarisId = row.data('id');
    const inventarisText = row.find('td').eq(0).text();
    $('#inventaris').append(`<option value="${inventarisId}">${inventarisText}</option>`);
    row.remove();
});

$('#addInventaris').click((e) => {
    e.preventDefault()
    var inventarisText = $('#Inventaris option:selected').text()
    var inventarisId = $('#Inventaris').val()
    var qty = $('#qty').val()
    var qty_error = $('#qty_error')

    $.ajax({
        type: "GET",
        url: `${url}/api/inventaris/qty/${inventarisId}/${qty}`,
        dataType: "JSON",
        success: () => {
            if ((inventarisId && qty > 0 && validation.containsOnlyDigits(inventarisId))) {
                const newRow = `<tr data-id="${inventarisId}">
            <td>${inventarisText}</td>
            <td>${qty}</td>
            <td><button type="button" class="removeInventaris btn btn-primary">Hapus</button></td>
        </tr>`;
                $('#inventarisTable tbody').append(newRow);

                $('#Inventaris option:selected').remove();
                $('#qty').val('');
                qty_error.text("")
            }
        },
        error: function (response) {
            qty_error.text(response.responseJSON.message)
        }
    });

});

$('#submitForm').click(function () {
    const form = $('#peminjamanForm');
    const jam_mulai = $('#pi_jam_mulai').val();
    const jam_mulai_error = $('#jam_mulai_error');
    const jam_akhir = $('#pi_jam_akhir').val();
    const jam_akhir_error = $('#jam_akhir_error');
    const laboratorium_id = $('#laboratorium').val();
    const laboratorium_error = $('#laboratorium_error');
    const inventarisData = [];

    var error_jam_akhir_message = validation.isValidateInputTime(jam_akhir)
    var error_jam_mulai_message = validation.isValidateInputTime(jam_mulai)
    var error_laboratorium_message = validation.isValidateInput(laboratorium_id)

    jam_akhir_error.text(error_jam_akhir_message)
    jam_mulai_error.text(error_jam_mulai_message)
    laboratorium_error.text(error_laboratorium_message)

    if (error_jam_akhir_message == "" && error_jam_mulai_message == "") {
        jam_mulai_error.text(validation.startLessThanEnd(jam_mulai, jam_akhir))
    }


    $('#inventarisTable tbody tr').each(function () {
        const inventarisId = $(this).data('id');
        const qty = $(this).find('td').eq(1).text();
        inventarisData.push({
            id: inventarisId,
            qty: qty
        });
    });
    if (error_jam_akhir_message == "" && error_jam_mulai_message == "" && error_laboratorium_message == "") {
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: {
                _token: csrf_token,
                pi_jam_mulai: jam_mulai,
                pi_jam_akhir: jam_akhir,
                laboratorium_id: laboratorium_id,
                inventaris: inventarisData
            },
            success: function (response) {
                service.refreshHistoryInventaris()
                form.before(`<div class="alert alert-success alert-dismissible fade show" id="error_message" role="alert">
                ${response.message}
        <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`);
                location.reload();
            },
            error: function (response) {
                form.before(`<div class="alert alert-danger alert-dismissible fade show" id="error_message" role="alert">
                ${response.responseJSON.message}
        <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
            }
        });
    }
});

function resetOption(elm) {
    elm.empty()
    elm.append("<option hidden>--Pilih Inventaris--</option>")
}