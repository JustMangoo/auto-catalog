<?php

namespace App\Http\Requests\Auto;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $autoId = $this->auto;

        return [
            'autonr' => [
                'required',
                'string',
                'max:20',
                Rule::unique('auto', 'autonr')->ignore($autoId),
            ],

            'autogads' => 'required|integer|min:1900|max:' . date('Y'),
            'marka_id' => 'required|exists:marka,marka_id',
            'motors_id' => 'required|exists:motors,motors_id',
            'motoratilpums' => 'required|numeric|between:1,9.99',
            'pilnamasa' => 'required|integer|between:1,9999',
            'pasmasa' => 'required|integer|between:1,9999|lte:pilnamasa',
            'piedzina_id' => 'required|exists:piedzina,piedzina_id',
        ];
    }
}
