<?php

namespace App\Http\Requests\Project;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'icon' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required|exists:users,id',
            'status' => 'nullable|in:done,in progress,late,hold',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'start_date' => $this->convertToStandardDateFormat($this->start_date),
            'end_date' => $this->convertToStandardDateFormat($this->end_date),
        ]);
    }

    private function convertToStandardDateFormat($date)
    {
        try {
            Carbon::setLocale('id_ID');
            setlocale(LC_TIME, 'id_ID.utf8');

            $fmt = new \IntlDateFormatter(
                'id_ID',
                \IntlDateFormatter::FULL,
                \IntlDateFormatter::SHORT,
                'Asia/Jakarta',
                \IntlDateFormatter::GREGORIAN,
                'd MMMM yyyy, HH:mm'
            );

            $timestamp = $fmt->parse($date);
            if ($timestamp === false) return $date;

            return Carbon::createFromTimestamp($timestamp, 'Asia/Jakarta')->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return $date;
        }
    }
}
