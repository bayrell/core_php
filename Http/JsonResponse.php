<?php
/*!
 *  Bayrell Core Library
 *
 *  (c) Copyright 2018-2019 "Ildar Bikmamatov" <support@bayrell.org>
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      https://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
namespace Core\Http;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreObject;
use Runtime\RuntimeUtils;
use Core\Http\Request;
use Core\Http\Response;
class JsonResponse extends Response{
	protected $__data;
	/**
	 * Init struct data
	 */
	function initData(){
		$headers = $this->headers;
		if ($headers == null){
			$headers = new Dict();
		}
		$headers = $headers->setIm("Content-Type", "application/json");
		$this->assignValue("headers", $headers);
	}
	/**
	 * Returns content
	 */
	function getContent(){
		return rtl::json_encode($this->data);
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.Http.JsonResponse";}
	public static function getCurrentNamespace(){return "Core.Http";}
	public static function getCurrentClassName(){return "Core.Http.JsonResponse";}
	public static function getParentClassName(){return "Core.Http.Response";}
	protected function _init(){
		parent::_init();
		$this->__data = new Dict();
	}
	public function assignObject($obj){
		if ($obj instanceof JsonResponse){
			$this->__data = $obj->__data;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "data")$this->__data = rtl::convert($value,"Runtime.Dict",new Dict(),"primitive");
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
	public static function getMethodsList($names){
	}
	public static function getMethodInfoByName($method_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}