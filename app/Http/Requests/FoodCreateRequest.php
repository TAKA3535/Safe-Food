<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FoodCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'info' => ['required', 'string', 'max:255'],
            'image' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'info.required' => '食品情報を入力してください',
            'info.max' => '食品情報は255文字以内で入力してください',
            'image.required' => '画像を選択してください'
        ];
    }
}
