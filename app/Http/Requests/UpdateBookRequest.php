<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maxYear = (int) date('Y') + 10;

        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'publication_year' => ['required_without_all:published_year,year_published,year', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
            'published_year' => ['required_without_all:publication_year,year_published,year', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
            'year_published' => ['required_without_all:publication_year,published_year,year', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
            'year' => ['required_without_all:publication_year,published_year,year_published', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
        ];
    }
}
