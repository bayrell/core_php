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
namespace RuntimeUI\Events\MouseEvent;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use RuntimeUI\Events\UserEvent\UserEvent;
class MouseEvent extends UserEvent{
	protected $__altKey;
	protected $__button;
	protected $__buttons;
	protected $__clientX;
	protected $__clientY;
	protected $__ctrlKey;
	protected $__detail;
	protected $__layerX;
	protected $__layerY;
	protected $__metaKey;
	protected $__movementX;
	protected $__movementY;
	protected $__offsetX;
	protected $__offsetY;
	protected $__pageX;
	protected $__pageY;
	protected $__screenX;
	protected $__screenY;
	protected $__shiftKey;
	protected $__x;
	protected $__y;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Events.MouseEvent.MouseEvent";}
	public static function getCurrentClassName(){return "RuntimeUI.Events.MouseEvent.MouseEvent";}
	public static function getParentClassName(){return "RuntimeUI.Events.UserEvent.UserEvent";}
	protected function _init(){
		parent::_init();
		$this->__altKey = false;
		$this->__button = 0;
		$this->__buttons = 0;
		$this->__clientX = 0;
		$this->__clientY = 0;
		$this->__ctrlKey = false;
		$this->__detail = 0;
		$this->__layerX = 0;
		$this->__layerY = 0;
		$this->__metaKey = false;
		$this->__movementX = 0;
		$this->__movementY = 0;
		$this->__offsetX = 0;
		$this->__offsetY = 0;
		$this->__pageX = 0;
		$this->__pageY = 0;
		$this->__screenX = 0;
		$this->__screenY = 0;
		$this->__shiftKey = false;
		$this->__x = 0;
		$this->__y = 0;
	}
	public function assignObject($obj){
		if ($obj instanceof MouseEvent){
			$this->__altKey = $obj->__altKey;
			$this->__button = $obj->__button;
			$this->__buttons = $obj->__buttons;
			$this->__clientX = $obj->__clientX;
			$this->__clientY = $obj->__clientY;
			$this->__ctrlKey = $obj->__ctrlKey;
			$this->__detail = $obj->__detail;
			$this->__layerX = $obj->__layerX;
			$this->__layerY = $obj->__layerY;
			$this->__metaKey = $obj->__metaKey;
			$this->__movementX = $obj->__movementX;
			$this->__movementY = $obj->__movementY;
			$this->__offsetX = $obj->__offsetX;
			$this->__offsetY = $obj->__offsetY;
			$this->__pageX = $obj->__pageX;
			$this->__pageY = $obj->__pageY;
			$this->__screenX = $obj->__screenX;
			$this->__screenY = $obj->__screenY;
			$this->__shiftKey = $obj->__shiftKey;
			$this->__x = $obj->__x;
			$this->__y = $obj->__y;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "altKey")$this->__altKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "button")$this->__button = rtl::convert($value,"int",0,"");
		else if ($variable_name == "buttons")$this->__buttons = rtl::convert($value,"int",0,"");
		else if ($variable_name == "clientX")$this->__clientX = rtl::convert($value,"int",0,"");
		else if ($variable_name == "clientY")$this->__clientY = rtl::convert($value,"int",0,"");
		else if ($variable_name == "ctrlKey")$this->__ctrlKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "detail")$this->__detail = rtl::convert($value,"int",0,"");
		else if ($variable_name == "layerX")$this->__layerX = rtl::convert($value,"int",0,"");
		else if ($variable_name == "layerY")$this->__layerY = rtl::convert($value,"int",0,"");
		else if ($variable_name == "metaKey")$this->__metaKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "movementX")$this->__movementX = rtl::convert($value,"int",0,"");
		else if ($variable_name == "movementY")$this->__movementY = rtl::convert($value,"int",0,"");
		else if ($variable_name == "offsetX")$this->__offsetX = rtl::convert($value,"int",0,"");
		else if ($variable_name == "offsetY")$this->__offsetY = rtl::convert($value,"int",0,"");
		else if ($variable_name == "pageX")$this->__pageX = rtl::convert($value,"int",0,"");
		else if ($variable_name == "pageY")$this->__pageY = rtl::convert($value,"int",0,"");
		else if ($variable_name == "screenX")$this->__screenX = rtl::convert($value,"int",0,"");
		else if ($variable_name == "screenY")$this->__screenY = rtl::convert($value,"int",0,"");
		else if ($variable_name == "shiftKey")$this->__shiftKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "x")$this->__x = rtl::convert($value,"int",0,"");
		else if ($variable_name == "y")$this->__y = rtl::convert($value,"int",0,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "altKey") return $this->__altKey;
		else if ($variable_name == "button") return $this->__button;
		else if ($variable_name == "buttons") return $this->__buttons;
		else if ($variable_name == "clientX") return $this->__clientX;
		else if ($variable_name == "clientY") return $this->__clientY;
		else if ($variable_name == "ctrlKey") return $this->__ctrlKey;
		else if ($variable_name == "detail") return $this->__detail;
		else if ($variable_name == "layerX") return $this->__layerX;
		else if ($variable_name == "layerY") return $this->__layerY;
		else if ($variable_name == "metaKey") return $this->__metaKey;
		else if ($variable_name == "movementX") return $this->__movementX;
		else if ($variable_name == "movementY") return $this->__movementY;
		else if ($variable_name == "offsetX") return $this->__offsetX;
		else if ($variable_name == "offsetY") return $this->__offsetY;
		else if ($variable_name == "pageX") return $this->__pageX;
		else if ($variable_name == "pageY") return $this->__pageY;
		else if ($variable_name == "screenX") return $this->__screenX;
		else if ($variable_name == "screenY") return $this->__screenY;
		else if ($variable_name == "shiftKey") return $this->__shiftKey;
		else if ($variable_name == "x") return $this->__x;
		else if ($variable_name == "y") return $this->__y;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("altKey");
			$names->push("button");
			$names->push("buttons");
			$names->push("clientX");
			$names->push("clientY");
			$names->push("ctrlKey");
			$names->push("detail");
			$names->push("layerX");
			$names->push("layerY");
			$names->push("metaKey");
			$names->push("movementX");
			$names->push("movementY");
			$names->push("offsetX");
			$names->push("offsetY");
			$names->push("pageX");
			$names->push("pageY");
			$names->push("screenX");
			$names->push("screenY");
			$names->push("shiftKey");
			$names->push("x");
			$names->push("y");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}