<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(['vehicle', 'tour'])],
            'vehicle_id' => ['nullable', 'required_if:type,vehicle', 'exists:vehicles,id'],
            'tour_id' => ['nullable', 'required_if:type,tour', 'exists:tours,id'],
            'start_on' => ['required', 'date', 'after_or_equal:today'],
            'end_on' => ['required', 'date', 'after_or_equal:start_on'],
            'pickup_location_id' => ['nullable', 'exists:locations,id'],
            'dropoff_location_id' => ['nullable', 'exists:locations,id'],
            'pax' => ['required', 'integer', 'min:1', 'max:20'],
            'with_driver' => ['sometimes', 'boolean'],
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:40'],
            'locale' => ['nullable', Rule::in(['fr', 'en'])],
            'message' => ['nullable', 'string', 'max:2000'],
            'source' => ['nullable', Rule::in(['web', 'whatsapp', 'manual'])],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'with_driver' => $this->boolean('with_driver'),
            'locale' => $this->input('locale', 'fr'),
            'source' => $this->input('source', 'web'),
        ]);
    }
}
