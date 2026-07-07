<?php

namespace App\Http\Requests;

use App\Models\ProjectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstimateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $projectTypeSlugs = ProjectType::query()
            ->where('is_active', true)
            ->pluck('slug')
            ->all();

        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'project_type' => ['required', 'string', Rule::in($projectTypeSlugs)],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'project_type.in' => 'Please select a valid project type.',
        ];
    }
}
