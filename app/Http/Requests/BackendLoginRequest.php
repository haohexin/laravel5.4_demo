<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/24
 * Time: 13:59
 */
namespace App\Http\Requests;

use App\Http\Requests\Request;

class BackendLoginRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [ 
				'account' => 'required',
				'password' => 'required|min:6',
		];
	}
	public function messages() {
		return [ 
				'account.required' => '用户名不可为空',
				'password.required' => '密码不可为空',
				'password.min' => '密码格式不正确',
		];
	}
}