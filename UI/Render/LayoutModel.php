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
namespace Core\UI\Render;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreStruct;
class LayoutModel extends CoreStruct{
	protected $__title;
	protected $__meta_description;
	protected $__meta_keywords;
	protected $__content;
	protected $__view;
	protected $__model;
	protected $__assets;
	protected $__components;
	protected $__modules;
	protected $__modules_path;
	protected $__css_vars;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Render.LayoutModel";}
	public static function getCurrentNamespace(){return "Core.UI.Render";}
	public static function getCurrentClassName(){return "Core.UI.Render.LayoutModel";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__title = "";
		$this->__meta_description = "";
		$this->__meta_keywords = "";
		$this->__content = "";
		$this->__view = "";
		$this->__model = null;
		$this->__assets = null;
		$this->__components = null;
		$this->__modules = null;
		$this->__modules_path = null;
		$this->__css_vars = new Dict();
	}
	public function assignObject($obj){
		if ($obj instanceof LayoutModel){
			$this->__title = $obj->__title;
			$this->__meta_description = $obj->__meta_description;
			$this->__meta_keywords = $obj->__meta_keywords;
			$this->__content = $obj->__content;
			$this->__view = $obj->__view;
			$this->__model = $obj->__model;
			$this->__assets = $obj->__assets;
			$this->__components = $obj->__components;
			$this->__modules = $obj->__modules;
			$this->__modules_path = $obj->__modules_path;
			$this->__css_vars = $obj->__css_vars;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "title")$this->__title = rtl::convert($value,"string","","");
		else if ($variable_name == "meta_description")$this->__meta_description = rtl::convert($value,"string","","");
		else if ($variable_name == "meta_keywords")$this->__meta_keywords = rtl::convert($value,"string","","");
		else if ($variable_name == "content")$this->__content = rtl::convert($value,"string","","");
		else if ($variable_name == "view")$this->__view = rtl::convert($value,"string","","");
		else if ($variable_name == "model")$this->__model = rtl::convert($value,"Runtime.CoreStruct",null,"");
		else if ($variable_name == "assets")$this->__assets = rtl::convert($value,"Runtime.Collection",null,"string");
		else if ($variable_name == "components")$this->__components = rtl::convert($value,"Runtime.Collection",null,"string");
		else if ($variable_name == "modules")$this->__modules = rtl::convert($value,"Runtime.Collection",null,"string");
		else if ($variable_name == "modules_path")$this->__modules_path = rtl::convert($value,"Runtime.Collection",null,"string");
		else if ($variable_name == "css_vars")$this->__css_vars = rtl::convert($value,"Runtime.Dict",new Dict(),"string");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "title") return $this->__title;
		else if ($variable_name == "meta_description") return $this->__meta_description;
		else if ($variable_name == "meta_keywords") return $this->__meta_keywords;
		else if ($variable_name == "content") return $this->__content;
		else if ($variable_name == "view") return $this->__view;
		else if ($variable_name == "model") return $this->__model;
		else if ($variable_name == "assets") return $this->__assets;
		else if ($variable_name == "components") return $this->__components;
		else if ($variable_name == "modules") return $this->__modules;
		else if ($variable_name == "modules_path") return $this->__modules_path;
		else if ($variable_name == "css_vars") return $this->__css_vars;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("title");
			$names->push("meta_description");
			$names->push("meta_keywords");
			$names->push("content");
			$names->push("view");
			$names->push("model");
			$names->push("assets");
			$names->push("components");
			$names->push("modules");
			$names->push("modules_path");
			$names->push("css_vars");
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