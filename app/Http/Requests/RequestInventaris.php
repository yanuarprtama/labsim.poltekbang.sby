<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestInventaris extends FormRequest
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
        $inventaris = $this->route();
        if ($this->getMethod() != "PUT") {
            return [
                "a_nama" => "required",
                "a_kode" => "required|unique:inventaris",
                "a_stok" => "required|numeric",
                "laboratorium_id" => "required",
            ];
        }
        return [
            "a_nama" => ["required"],
            "a_kode" => ["required", "unique" => Rule::unique("inventaris", "a_kode")->ignore($inventaris->id)],
            "a_stok" => "required|numeric",
            "laboratorium_id" => "required",
        ];
    }
}
