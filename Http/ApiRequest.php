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
use RuntimeUI\Http\Request;
class ApiRequest extends CoreStruct{
	protected $__data;
	/**
	 * Assing request
	 * @param Request request
	 * @param ApiRequest req
	 * @return ApiRequest
	 */
	static function assignData($request, $req){
		if ($request == null){
			return ;
		}
		$data = new Map();
		/* Get data */
		$request->payload->each(function ($key, $value) use (&$data){
			$data->set($key, $value);
		});
		return $req->copy((new Map())->set("data", $data));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Http.ApiRequest";}
	public static function getCurrentClassName(){return "RuntimeUI.Http.ApiRequest";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__data = null;
	}
	public function assignObject($obj){
		if ($obj instanceof ApiRequest){
			$this->__data = $obj->__data;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "data")$this->__data = rtl::convert($value,"Runtime.Dict",null,"mixed");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "data") return $this->__data;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("data");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}