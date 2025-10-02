<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
            'name' => 'max:255',
            'code' => 'unique:inventories,code|max:100',
            'version' => '',
            'url' => '',
            'category' => '',
            'status' => '',
            'manufacturer' => '',
            'tahun_anggaran' => 'date_format:Y',
            'opd_id' => '',
            'sub_unit' => '',
            'ip_address' => ''
        ];
    }
}
