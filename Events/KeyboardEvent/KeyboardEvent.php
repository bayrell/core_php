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
namespace RuntimeUI\Events\KeyboardEvent;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreEvent;
use Runtime\Interfaces\CloneableInterface;
use Runtime\Interfaces\SerializeInterface;
use RuntimeUI\Events\UserEvent\UserEvent;
class KeyboardEvent extends UserEvent implements CloneableInterface, SerializeInterface{
	public $altKey;
	public $charCode;
	public $code;
	public $ctrlKey;
	public $key;
	public $keyCode;
	public $locale;
	public $location;
	public $repeat;
	public $shiftKey;
	public $which;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Events.KeyboardEvent.KeyboardEvent";}
	public static function getCurrentClassName(){return "RuntimeUI.Events.KeyboardEvent.KeyboardEvent";}
	public static function getParentClassName(){return "RuntimeUI.Events.UserEvent.UserEvent";}
	protected function _init(){
		parent::_init();
	}
	public function assignObject($obj){
		if ($obj instanceof KeyboardEvent){
			$this->altKey = rtl::_clone($obj->altKey);
			$this->charCode = rtl::_clone($obj->charCode);
			$this->code = rtl::_clone($obj->code);
			$this->ctrlKey = rtl::_clone($obj->ctrlKey);
			$this->key = rtl::_clone($obj->key);
			$this->keyCode = rtl::_clone($obj->keyCode);
			$this->locale = rtl::_clone($obj->locale);
			$this->location = rtl::_clone($obj->location);
			$this->repeat = rtl::_clone($obj->repeat);
			$this->shiftKey = rtl::_clone($obj->shiftKey);
			$this->which = rtl::_clone($obj->which);
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "altKey")$this->altKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "charCode")$this->charCode = rtl::convert($value,"int",0,"");
		else if ($variable_name == "code")$this->code = rtl::convert($value,"string","","");
		else if ($variable_name == "ctrlKey")$this->ctrlKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "key")$this->key = rtl::convert($value,"string",false,"");
		else if ($variable_name == "keyCode")$this->keyCode = rtl::convert($value,"int",0,"");
		else if ($variable_name == "locale")$this->locale = rtl::convert($value,"string","","");
		else if ($variable_name == "location")$this->location = rtl::convert($value,"int",0,"");
		else if ($variable_name == "repeat")$this->repeat = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "shiftKey")$this->shiftKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "which")$this->which = rtl::convert($value,"int",0,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "altKey") return $this->altKey;
		else if ($variable_name == "charCode") return $this->charCode;
		else if ($variable_name == "code") return $this->code;
		else if ($variable_name == "ctrlKey") return $this->ctrlKey;
		else if ($variable_name == "key") return $this->key;
		else if ($variable_name == "keyCode") return $this->keyCode;
		else if ($variable_name == "locale") return $this->locale;
		else if ($variable_name == "location") return $this->location;
		else if ($variable_name == "repeat") return $this->repeat;
		else if ($variable_name == "shiftKey") return $this->shiftKey;
		else if ($variable_name == "which") return $this->which;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("altKey");
			$names->push("charCode");
			$names->push("code");
			$names->push("ctrlKey");
			$names->push("key");
			$names->push("keyCode");
			$names->push("locale");
			$names->push("location");
			$names->push("repeat");
			$names->push("shiftKey");
			$names->push("which");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
}