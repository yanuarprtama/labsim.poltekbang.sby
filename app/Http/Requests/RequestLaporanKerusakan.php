<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLaporanKerusakan extends FormRequest
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
            "lk_lampiran" => "required|image",
            "lk_keterangan" => "required|max:1000",
        ];
    }

    public function messages()
    {
        return [
            "lk_lampiran.required" => "Lampiran mohon diisi!",
            "lk_lampiran.image" => "Lampiran mohon diisi menggunakan gambar !",

            "lk_keterangan.max" => "Keterangan mohon diisi dengan karakter tidak lebih 1000 !",
            "lk_keterangan.required" => "Keterangan mohon diisi berisi !",
        ];
    }
}
