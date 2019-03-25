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
class Response extends CoreStruct{
	protected $__http_code;
	protected $__content;
	protected $__cookies;
	protected $__headers;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Http.Response";}
	public static function getCurrentClassName(){return "RuntimeUI.Http.Response";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__http_code = 200;
		$this->__content = "";
		$this->__cookies = null;
		$this->__headers = null;
	}
	public function assignObject($obj){
		if ($obj instanceof Response){
			$this->__http_code = $obj->__http_code;
			$this->__content = $obj->__content;
			$this->__cookies = $obj->__cookies;
			$this->__headers = $obj->__headers;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "http_code")$this->__http_code = rtl::convert($value,"int",200,"");
		else if ($variable_name == "content")$this->__content = rtl::convert($value,"string","","");
		else if ($variable_name == "cookies")$this->__cookies = rtl::convert($value,"Runtime.Dict",null,"Cookie");
		else if ($variable_name == "headers")$this->__headers = rtl::convert($value,"Runtime.Dict",null,"string");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "http_code") return $this->__http_code;
		else if ($variable_name == "content") return $this->__content;
		else if ($variable_name == "cookies") return $this->__cookies;
		else if ($variable_name == "headers") return $this->__headers;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("http_code");
			$names->push("content");
			$names->push("cookies");
			$names->push("headers");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}