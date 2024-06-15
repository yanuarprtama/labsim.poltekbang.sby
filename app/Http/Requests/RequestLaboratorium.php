<?php

namespace App\Http\Requests;

use App\Enums\LaboratoriumState;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RequestLaboratorium extends FormRequest
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
        $laboratorium = $this->route();

        if ($this->getMethod() != "PUT") {
            return [
                "l_nama" => "required",
                "l_jenis" => ["required", Rule::enum(LaboratoriumState::class)],
                "prodi_id" => "required",
            ];
        }
        return [
            "l_nama" => ["required", "unique" => Rule::unique("laboratoriums", "l_nama")->ignore($laboratorium->id)],
            "l_jenis" => ["required", Rule::enum(LaboratoriumState::class)],
            "prodi_id" => "required",
        ];
    }
}
