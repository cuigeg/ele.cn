<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FoodRequest extends Request
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
           'name' => 'required|unique:shop',
        ];
    }
    //messages方法内定 指明提示具体信息
    public function messages()
    {
        return [
         //错误提示信息
            //错误提示信息
            'name.required'=>'分类名不能为空',
            'name.unique'=>'分类名不能重复'
            ];
    }
}
