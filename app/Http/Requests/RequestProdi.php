<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestProdi extends FormRequest
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
        $prodi = $this->route();
        if ($this->getMethod() != "PUT") {
            return [
                "p_nama" => "required",
                "p_kode" => "required|unique:prodis",
            ];
        } else {
            return [
                "p_nama" => ["required", "unique" => Rule::unique("prodis", "p_nama")->ignore($prodi->id)],
                "p_kode" => ["required", "unique" => Rule::unique("prodis", "p_kode")->ignore($prodi->id)],
            ];
        }
    }

    public function messages()
    {
        return [
            "p_nama.required" => "Nama belum diisi !",
            "p_kode.required" => "Kode belum diisi !",
            "p_kode.unique" => "Kode sudah ada !",
        ];
    }
}
