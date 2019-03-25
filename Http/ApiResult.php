<?php
/*!
 *  Bayrell Runtime Library
 *
 *  (c) Copyright 2018 "Ildar Bikmamatov" <support@bayrell.org>
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      https://www.bayrell.org/licenses/APACHE-LICENSE-2.0.html
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
namespace RuntimeUI\Http;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreStruct;
use Runtime\RuntimeConstant;
class ApiResult extends CoreStruct{
	protected $__success;
	protected $__code;
	protected $__error;
	protected $__class_name;
	protected $__method_name;
	protected $__text;
	protected $__result;
	/**
	 * Returns true if success
	 * @param ApiResult res
	 * @return bool
	 */
	static function isSuccess($res){
		return $res->success && $res->code >= RuntimeConstant::ERROR_OK;
	}
	/**
	 * Set error data
	 * @param int code
	 * @param string error
	 * @param ApiResult res
	 * @return ApiResult
	 */
	static function setError($code, $error = "", $res){
		$succes = false;
		if ($code >= RuntimeConstant::ERROR_OK){
			$succes = true;
		}
		return $res->copy((new Map())->set("code", $code)->set("error", $error)->set("success", $success));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Http.ApiResult";}
	public static function getCurrentClassName(){return "RuntimeUI.Http.ApiResult";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__success = false;
		$this->__code = -1;
		$this->__error = "";
		$this->__class_name = "";
		$this->__method_name = "";
		$this->__text = "";
		$this->__result = null;
	}
	public function assignObject($obj){
		if ($obj instanceof ApiResult){
			$this->__success = $obj->__success;
			$this->__code = $obj->__code;
			$this->__error = $obj->__error;
			$this->__class_name = $obj->__class_name;
			$this->__method_name = $obj->__method_name;
			$this->__text = $obj->__text;
			$this->__result = $obj->__result;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "success")$this->__success = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "code")$this->__code = rtl::convert($value,"int",-1,"");
		else if ($variable_name == "error")$this->__error = rtl::convert($value,"string","","");
		else if ($variable_name == "class_name")$this->__class_name = rtl::convert($value,"string","","");
		else if ($variable_name == "method_name")$this->__method_name = rtl::convert($value,"string","","");
		else if ($variable_name == "text")$this->__text = rtl::convert($value,"string","","");
		else if ($variable_name == "result")$this->__result = rtl::convert($value,"primitive",null,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "success") return $this->__success;
		else if ($variable_name == "code") return $this->__code;
		else if ($variable_name == "error") return $this->__error;
		else if ($variable_name == "class_name") return $this->__class_name;
		else if ($variable_name == "method_name") return $this->__method_name;
		else if ($variable_name == "text") return $this->__text;
		else if ($variable_name == "result") return $this->__result;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("success");
			$names->push("code");
			$names->push("error");
			$names->push("class_name");
			$names->push("method_name");
			$names->push("text");
			$names->push("result");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}