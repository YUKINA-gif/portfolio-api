<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string"],
            "skill" => ["required", "integer"],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "スキル名は必須項目です",
            "skill.required" => "スキル数は必須項目です",
        ];
    }
}
