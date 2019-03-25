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
namespace RuntimeUI\Render;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreStruct;
class RenderContainer extends CoreStruct{
	protected $__title;
	protected $__content;
	protected $__assets;
	protected $__components;
	protected $__css_vars;
	protected $__view;
	protected $__model;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Render.RenderContainer";}
	public static function getCurrentClassName(){return "RuntimeUI.Render.RenderContainer";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__title = "";
		$this->__content = "";
		$this->__assets = null;
		$this->__components = null;
		$this->__css_vars = new Dict();
		$this->__view = "";
		$this->__model = null;
	}
	public function assignObject($obj){
		if ($obj instanceof RenderContainer){
			$this->__title = $obj->__title;
			$this->__content = $obj->__content;
			$this->__assets = $obj->__assets;
			$this->__components = $obj->__components;
			$this->__css_vars = $obj->__css_vars;
			$this->__view = $obj->__view;
			$this->__model = $obj->__model;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "title")$this->__title = rtl::convert($value,"string","","");
		else if ($variable_name == "content")$this->__content = rtl::convert($value,"string","","");
		else if ($variable_name == "assets")$this->__assets = rtl::convert($value,"Runtime.Collection",null,"string");
		else if ($variable_name == "components")$this->__components = rtl::convert($value,"Runtime.Collection",null,"string");
		else if ($variable_name == "css_vars")$this->__css_vars = rtl::convert($value,"Runtime.Dict",new Dict(),"string");
		else if ($variable_name == "view")$this->__view = rtl::convert($value,"string","","");
		else if ($variable_name == "model")$this->__model = rtl::convert($value,"Runtime.CoreStruct",null,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "title") return $this->__title;
		else if ($variable_name == "content") return $this->__content;
		else if ($variable_name == "assets") return $this->__assets;
		else if ($variable_name == "components") return $this->__components;
		else if ($variable_name == "css_vars") return $this->__css_vars;
		else if ($variable_name == "view") return $this->__view;
		else if ($variable_name == "model") return $this->__model;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("title");
			$names->push("content");
			$names->push("assets");
			$names->push("components");
			$names->push("css_vars");
			$names->push("view");
			$names->push("model");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}