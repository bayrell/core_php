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
use Runtime\RuntimeUtils;
class Request extends CoreStruct{
	const METHOD_GET = "GET";
	const METHOD_HEAD = "HEAD";
	const METHOD_POST = "POST";
	const METHOD_PUT = "PUT";
	const METHOD_DELETE = "DELETE";
	const METHOD_CONNECT = "CONNECT";
	const METHOD_OPTIONS = "OPTIONS";
	const METHOD_TRACE = "TRACE";
	const METHOD_PATCH = "PATCH";
	protected $__uri;
	protected $__host;
	protected $__method;
	protected $__query;
	protected $__payload;
	protected $__cookies;
	protected $__headers;
	protected $__params;
	protected $__start_time;
	/**
	 * Send response
	 * @return Response res
	 */
	static function createPHPRequest(){
		$r = null;
		
		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";
		$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
		$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : "";
		$start_time = isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : "";
		$query = new Map();
		$payload = new Map();
		$cookies = new Map();
		foreach ($_GET as $key => $val) $query->set($key, $val);
		foreach ($_POST as $key => $val){
			$payload->set($key, RuntimeUtils::NativeToObject($val));
		}
		foreach ($_COOKIE as $key => $val) $cookies->set($key, $val);
		
		$arr = parse_url($uri);
		$uri = isset($arr['path']) ? $arr['path'] : "";
		
		$r = new Request(
			new Map([
				"host" => $host,
				"uri" => $uri,
				"method" => $method,
				"query" => $query->toDict(),
				"payload" => $payload->toDict(),
				"cookies" => $cookies->toDict(),
				"start_time" => $start_time,
			])
		);
		return $r;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.Http.Request";}
	public static function getCurrentNamespace(){return "Core.Http";}
	public static function getCurrentClassName(){return "Core.Http.Request";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__uri = "";
		$this->__host = "";
		$this->__method = "GET";
		$this->__query = null;
		$this->__payload = null;
		$this->__cookies = null;
		$this->__headers = null;
		$this->__params = null;
		$this->__start_time = 0;
	}
	public function assignObject($obj){
		if ($obj instanceof Request){
			$this->__uri = $obj->__uri;
			$this->__host = $obj->__host;
			$this->__method = $obj->__method;
			$this->__query = $obj->__query;
			$this->__payload = $obj->__payload;
			$this->__cookies = $obj->__cookies;
			$this->__headers = $obj->__headers;
			$this->__params = $obj->__params;
			$this->__start_time = $obj->__start_time;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "uri")$this->__uri = rtl::convert($value,"string","","");
		else if ($variable_name == "host")$this->__host = rtl::convert($value,"string","","");
		else if ($variable_name == "method")$this->__method = rtl::convert($value,"string","GET","");
		else if ($variable_name == "query")$this->__query = rtl::convert($value,"Runtime.Dict",null,"string");
		else if ($variable_name == "payload")$this->__payload = rtl::convert($value,"Runtime.Dict",null,"mixed");
		else if ($variable_name == "cookies")$this->__cookies = rtl::convert($value,"Runtime.Dict",null,"string");
		else if ($variable_name == "headers")$this->__headers = rtl::convert($value,"Runtime.Dict",null,"string");
		else if ($variable_name == "params")$this->__params = rtl::convert($value,"Runtime.Dict",null,"string");
		else if ($variable_name == "start_time")$this->__start_time = rtl::convert($value,"int",0,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "uri") return $this->__uri;
		else if ($variable_name == "host") return $this->__host;
		else if ($variable_name == "method") return $this->__method;
		else if ($variable_name == "query") return $this->__query;
		else if ($variable_name == "payload") return $this->__payload;
		else if ($variable_name == "cookies") return $this->__cookies;
		else if ($variable_name == "headers") return $this->__headers;
		else if ($variable_name == "params") return $this->__params;
		else if ($variable_name == "start_time") return $this->__start_time;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("uri");
			$names->push("host");
			$names->push("method");
			$names->push("query");
			$names->push("payload");
			$names->push("cookies");
			$names->push("headers");
			$names->push("params");
			$names->push("start_time");
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