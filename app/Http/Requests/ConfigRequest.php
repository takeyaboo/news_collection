<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
          'mail' => 'required',
          'address' => 'required',
          'batch' => 'required',
        ];
    }

    public function messages()
    {
      return [
          'mail.required' => 'メール通知のON/OFFを選択してください。',
          'address.required'  => 'メールアドレスを入力してください。',
          'batch.required' => '自動保存のON/OFFを選択してください。',

      ];
    }
}
