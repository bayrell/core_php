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
namespace Core\UI\Events\KeyboardEvent;
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
use Core\UI\Events\UserEvent\UserEvent;
class KeyboardEvent extends UserEvent{
	protected $__altKey;
	protected $__charCode;
	protected $__code;
	protected $__ctrlKey;
	protected $__key;
	protected $__keyCode;
	protected $__locale;
	protected $__location;
	protected $__repeat;
	protected $__shiftKey;
	protected $__which;
	protected $__value;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Events.KeyboardEvent.KeyboardEvent";}
	public static function getCurrentNamespace(){return "Core.UI.Events.KeyboardEvent";}
	public static function getCurrentClassName(){return "Core.UI.Events.KeyboardEvent.KeyboardEvent";}
	public static function getParentClassName(){return "Core.UI.Events.UserEvent.UserEvent";}
	protected function _init(){
		parent::_init();
		$this->__altKey = false;
		$this->__charCode = 0;
		$this->__code = "";
		$this->__ctrlKey = false;
		$this->__key = false;
		$this->__keyCode = 0;
		$this->__locale = "";
		$this->__location = 0;
		$this->__repeat = false;
		$this->__shiftKey = false;
		$this->__which = 0;
		$this->__value = "";
	}
	public function assignObject($obj){
		if ($obj instanceof KeyboardEvent){
			$this->__altKey = $obj->__altKey;
			$this->__charCode = $obj->__charCode;
			$this->__code = $obj->__code;
			$this->__ctrlKey = $obj->__ctrlKey;
			$this->__key = $obj->__key;
			$this->__keyCode = $obj->__keyCode;
			$this->__locale = $obj->__locale;
			$this->__location = $obj->__location;
			$this->__repeat = $obj->__repeat;
			$this->__shiftKey = $obj->__shiftKey;
			$this->__which = $obj->__which;
			$this->__value = $obj->__value;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "altKey")$this->__altKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "charCode")$this->__charCode = rtl::convert($value,"int",0,"");
		else if ($variable_name == "code")$this->__code = rtl::convert($value,"string","","");
		else if ($variable_name == "ctrlKey")$this->__ctrlKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "key")$this->__key = rtl::convert($value,"string",false,"");
		else if ($variable_name == "keyCode")$this->__keyCode = rtl::convert($value,"int",0,"");
		else if ($variable_name == "locale")$this->__locale = rtl::convert($value,"string","","");
		else if ($variable_name == "location")$this->__location = rtl::convert($value,"int",0,"");
		else if ($variable_name == "repeat")$this->__repeat = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "shiftKey")$this->__shiftKey = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "which")$this->__which = rtl::convert($value,"int",0,"");
		else if ($variable_name == "value")$this->__value = rtl::convert($value,"string","","");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "altKey") return $this->__altKey;
		else if ($variable_name == "charCode") return $this->__charCode;
		else if ($variable_name == "code") return $this->__code;
		else if ($variable_name == "ctrlKey") return $this->__ctrlKey;
		else if ($variable_name == "key") return $this->__key;
		else if ($variable_name == "keyCode") return $this->__keyCode;
		else if ($variable_name == "locale") return $this->__locale;
		else if ($variable_name == "location") return $this->__location;
		else if ($variable_name == "repeat") return $this->__repeat;
		else if ($variable_name == "shiftKey") return $this->__shiftKey;
		else if ($variable_name == "which") return $this->__which;
		else if ($variable_name == "value") return $this->__value;
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
			$names->push("value");
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