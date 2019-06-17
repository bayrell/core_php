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
use Runtime\CoreStruct;
use Runtime\DateTime;
class Cookie extends CoreStruct{
	protected $__name;
	protected $__value;
	protected $__expire;
	protected $__domain;
	protected $__path;
	protected $__secure;
	protected $__httponly;
	/**
	 * Return expire
	 * @param Cookie c
	 * @return int
	 */
	static function getExpireTimestamp($c){
		if ($c->expire == null){
			return 0;
		}
		return $c->expire->getTimestamp();
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.Http.Cookie";}
	public static function getCurrentNamespace(){return "Core.Http";}
	public static function getCurrentClassName(){return "Core.Http.Cookie";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__name = "";
		$this->__value = "";
		$this->__expire = null;
		$this->__domain = "";
		$this->__path = "";
		$this->__secure = false;
		$this->__httponly = false;
	}
	public function assignObject($obj){
		if ($obj instanceof Cookie){
			$this->__name = $obj->__name;
			$this->__value = $obj->__value;
			$this->__expire = $obj->__expire;
			$this->__domain = $obj->__domain;
			$this->__path = $obj->__path;
			$this->__secure = $obj->__secure;
			$this->__httponly = $obj->__httponly;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "name")$this->__name = rtl::convert($value,"string","","");
		else if ($variable_name == "value")$this->__value = rtl::convert($value,"string","","");
		else if ($variable_name == "expire")$this->__expire = rtl::convert($value,"Runtime.DateTime",null,"");
		else if ($variable_name == "domain")$this->__domain = rtl::convert($value,"string","","");
		else if ($variable_name == "path")$this->__path = rtl::convert($value,"string","","");
		else if ($variable_name == "secure")$this->__secure = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "httponly")$this->__httponly = rtl::convert($value,"bool",false,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "name") return $this->__name;
		else if ($variable_name == "value") return $this->__value;
		else if ($variable_name == "expire") return $this->__expire;
		else if ($variable_name == "domain") return $this->__domain;
		else if ($variable_name == "path") return $this->__path;
		else if ($variable_name == "secure") return $this->__secure;
		else if ($variable_name == "httponly") return $this->__httponly;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("name");
			$names->push("value");
			$names->push("expire");
			$names->push("domain");
			$names->push("path");
			$names->push("secure");
			$names->push("httponly");
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