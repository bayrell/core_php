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
namespace Core\UI\Annotations;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\re;
use Runtime\CoreStruct;
class RouteInfo extends CoreStruct{
	protected $__uri;
	protected $__name;
	protected $__class_name;
	protected $__method_name;
	protected $__uri_match;
	protected $__layout_class;
	protected $__view_class;
	protected $__render;
	protected $__params;
	/**
	 * Init struct data
	 */
	function initData(){
		$uri_match = $this->uri;
		$uri_match = re::replace("\\/", "\\/", $uri_match);
		$matches = re::matchAll("{(.*?)}", $this->uri);
		if ($matches){
			$params = $matches->get(0, null);
			$params->each(function ($name) use (&$uri_match){
				$uri_match = re::replace("{" . rtl::toString($name) . "}", "([^\\/]*?)", $uri_match);
			});
			$this->assignValue("params", $params->toCollection());
		}
		else {
			$this->assignValue("params", null);
		}
		$this->assignValue("uri_match", "^" . rtl::toString($uri_match) . "\$");
	}
	/**
	 * Get params
	 * @return Map<string>
	 */
	static function getParams($matches, $info){
		$__memorize_value = rtl::_memorizeValue("Core.UI.Annotations.RouteInfo::getParams", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		if ($info->params == null){
			$__memorize_value = null;
			rtl::_memorizeSave("Core.UI.Annotations.RouteInfo::getParams", func_get_args(), $__memorize_value);
			return $__memorize_value;
		}
		$res = new Map();
		$info->params->each(function ($name, $pos) use (&$matches, &$res){
			$match = $matches->get($pos, null);
			if ($match){
				$res->set($name, $match);
			}
		});
		$__memorize_value = $res->toDict();
		rtl::_memorizeSave("Core.UI.Annotations.RouteInfo::getParams", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Annotations.RouteInfo";}
	public static function getCurrentNamespace(){return "Core.UI.Annotations";}
	public static function getCurrentClassName(){return "Core.UI.Annotations.RouteInfo";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__uri = "";
		$this->__name = "";
		$this->__class_name = "";
		$this->__method_name = "";
		$this->__uri_match = "";
		$this->__layout_class = "";
		$this->__view_class = "";
		$this->__render = false;
		$this->__params = null;
	}
	public function assignObject($obj){
		if ($obj instanceof RouteInfo){
			$this->__uri = $obj->__uri;
			$this->__name = $obj->__name;
			$this->__class_name = $obj->__class_name;
			$this->__method_name = $obj->__method_name;
			$this->__uri_match = $obj->__uri_match;
			$this->__layout_class = $obj->__layout_class;
			$this->__view_class = $obj->__view_class;
			$this->__render = $obj->__render;
			$this->__params = $obj->__params;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "uri")$this->__uri = rtl::convert($value,"string","","");
		else if ($variable_name == "name")$this->__name = rtl::convert($value,"string","","");
		else if ($variable_name == "class_name")$this->__class_name = rtl::convert($value,"string","","");
		else if ($variable_name == "method_name")$this->__method_name = rtl::convert($value,"string","","");
		else if ($variable_name == "uri_match")$this->__uri_match = rtl::convert($value,"string","","");
		else if ($variable_name == "layout_class")$this->__layout_class = rtl::convert($value,"string","","");
		else if ($variable_name == "view_class")$this->__view_class = rtl::convert($value,"string","","");
		else if ($variable_name == "render")$this->__render = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "params")$this->__params = rtl::convert($value,"Runtime.Collection",null,"string");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "uri") return $this->__uri;
		else if ($variable_name == "name") return $this->__name;
		else if ($variable_name == "class_name") return $this->__class_name;
		else if ($variable_name == "method_name") return $this->__method_name;
		else if ($variable_name == "uri_match") return $this->__uri_match;
		else if ($variable_name == "layout_class") return $this->__layout_class;
		else if ($variable_name == "view_class") return $this->__view_class;
		else if ($variable_name == "render") return $this->__render;
		else if ($variable_name == "params") return $this->__params;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("uri");
			$names->push("name");
			$names->push("class_name");
			$names->push("method_name");
			$names->push("uri_match");
			$names->push("layout_class");
			$names->push("view_class");
			$names->push("render");
			$names->push("params");
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