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
use Core\UI\Render\LayoutModel;
class RenderResult extends CoreStruct{
	protected $__layout_class;
	protected $__view_class;
	protected $__layout_model;
	protected $__view_model;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Render.RenderResult";}
	public static function getCurrentNamespace(){return "Core.UI.Render";}
	public static function getCurrentClassName(){return "Core.UI.Render.RenderResult";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__layout_class = "";
		$this->__view_class = "";
		$this->__layout_model = null;
		$this->__view_model = null;
	}
	public function assignObject($obj){
		if ($obj instanceof RenderResult){
			$this->__layout_class = $obj->__layout_class;
			$this->__view_class = $obj->__view_class;
			$this->__layout_model = $obj->__layout_model;
			$this->__view_model = $obj->__view_model;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "layout_class")$this->__layout_class = rtl::convert($value,"string","","");
		else if ($variable_name == "view_class")$this->__view_class = rtl::convert($value,"string","","");
		else if ($variable_name == "layout_model")$this->__layout_model = rtl::convert($value,"Core.UI.Render.LayoutModel",null,"");
		else if ($variable_name == "view_model")$this->__view_model = rtl::convert($value,"Runtime.CoreStruct",null,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "layout_class") return $this->__layout_class;
		else if ($variable_name == "view_class") return $this->__view_class;
		else if ($variable_name == "layout_model") return $this->__layout_model;
		else if ($variable_name == "view_model") return $this->__view_model;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("layout_class");
			$names->push("view_class");
			$names->push("layout_model");
			$names->push("view_model");
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