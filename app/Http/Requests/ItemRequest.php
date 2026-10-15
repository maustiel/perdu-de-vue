<?php

namespace App\Http\Requests;

use App\Enums\Color;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'color' => ['required', Rule::enum(Color::class)],
            'found_on' => ['required', 'date', 'before_or_equal:today'],
            'place_id' => ['required', 'integer', 'exists:places,id'],
            'description' => ['nullable', 'string', 'max:1000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'color' => 'couleur',
            'found_on' => 'date de découverte',
            'place_id' => 'lieu',
            'description' => 'description',
            'tags' => 'étiquettes',
            'tags.*' => 'étiquette',
        ];
    }

    public function messages(): array
    {
        return [
            'found_on.before_or_equal' => 'La date de découverte ne peut pas être dans le futur.',
        ];
    }
}
