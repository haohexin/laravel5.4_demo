<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/24
 * Time: 13:59
 */
namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmptyRequest extends Request {
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
		return [];
	}
	public function messages() {
		return [];
	}
}