<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2 0002
 * Time: 下午 3:06
 */
namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class DictionaryForm extends Request
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
            'value'         => 'required',
            'name'        => 'required',
            'type'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'value.required'         => '字典值不能为空',
            'name.required'        => '名称不能为空',
            'type.required'   => '类型不能为空',
        ];
    }
}
