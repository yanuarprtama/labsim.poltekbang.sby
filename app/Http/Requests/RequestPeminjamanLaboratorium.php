<?php

namespace App\Http\Requests;

use App\Enums\JenisKegiatanState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPeminjamanLaboratorium extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pl_mata_kuliah' => "required",
            'pl_jenis_kegiatan' => ["required", Rule::enum(JenisKegiatanState::class)],
            'pl_jam_mulai' => ["required"],
            'pl_jam_akhir' => ["required"],
            'pl_dosen_pengajar' => ["required"],
            'laboratorium_id' => ["required"],
        ];
    }

    public function messages()
    {
        //
    }
}
