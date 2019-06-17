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
namespace Core\UI\Events\UserEvent;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreEvent;
use Runtime\UIStruct;
use Core\UI\Interfaces\ElementInterface;
class UserEvent extends CoreEvent{
	protected $__name;
	protected $__bubbles;
	protected $__cancel_bubble;
	protected $__cancelable;
	protected $__composed;
	protected $__default_prevented;
	protected $__event_phase;
	protected $__is_trusted;
	protected $__ui;
	protected $__es6_event;
	protected $__currentElement;
	protected $__target;
	/**
	 * Prevent default mouse event
	 */
	function preventDefault(){
	}
	/**
	 * Cancel event
	 */
	function isCancel(){
		return $this->cancelBubble;
	}
	/**
	 * Cancel event
	 */
	function cancel(){
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Events.UserEvent.UserEvent";}
	public static function getCurrentNamespace(){return "Core.UI.Events.UserEvent";}
	public static function getCurrentClassName(){return "Core.UI.Events.UserEvent.UserEvent";}
	public static function getParentClassName(){return "Runtime.CoreEvent";}
	protected function _init(){
		parent::_init();
		$this->__name = "";
		$this->__bubbles = false;
		$this->__cancel_bubble = false;
		$this->__cancelable = true;
		$this->__composed = true;
		$this->__default_prevented = false;
		$this->__event_phase = 0;
		$this->__is_trusted = true;
		$this->__ui = null;
		$this->__es6_event = null;
		$this->__currentElement = null;
		$this->__target = null;
	}
	public function assignObject($obj){
		if ($obj instanceof UserEvent){
			$this->__name = $obj->__name;
			$this->__bubbles = $obj->__bubbles;
			$this->__cancel_bubble = $obj->__cancel_bubble;
			$this->__cancelable = $obj->__cancelable;
			$this->__composed = $obj->__composed;
			$this->__default_prevented = $obj->__default_prevented;
			$this->__event_phase = $obj->__event_phase;
			$this->__is_trusted = $obj->__is_trusted;
			$this->__ui = $obj->__ui;
			$this->__es6_event = $obj->__es6_event;
			$this->__currentElement = $obj->__currentElement;
			$this->__target = $obj->__target;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "name")$this->__name = rtl::convert($value,"string","","");
		else if ($variable_name == "bubbles")$this->__bubbles = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "cancel_bubble")$this->__cancel_bubble = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "cancelable")$this->__cancelable = rtl::convert($value,"bool",true,"");
		else if ($variable_name == "composed")$this->__composed = rtl::convert($value,"bool",true,"");
		else if ($variable_name == "default_prevented")$this->__default_prevented = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "event_phase")$this->__event_phase = rtl::convert($value,"int",0,"");
		else if ($variable_name == "is_trusted")$this->__is_trusted = rtl::convert($value,"bool",true,"");
		else if ($variable_name == "ui")$this->__ui = rtl::convert($value,"Runtime.UIStruct",null,"");
		else if ($variable_name == "es6_event")$this->__es6_event = rtl::convert($value,"mixed",null,"");
		else if ($variable_name == "currentElement")$this->__currentElement = rtl::convert($value,"mixed",null,"");
		else if ($variable_name == "target")$this->__target = rtl::convert($value,"mixed",null,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "name") return $this->__name;
		else if ($variable_name == "bubbles") return $this->__bubbles;
		else if ($variable_name == "cancel_bubble") return $this->__cancel_bubble;
		else if ($variable_name == "cancelable") return $this->__cancelable;
		else if ($variable_name == "composed") return $this->__composed;
		else if ($variable_name == "default_prevented") return $this->__default_prevented;
		else if ($variable_name == "event_phase") return $this->__event_phase;
		else if ($variable_name == "is_trusted") return $this->__is_trusted;
		else if ($variable_name == "ui") return $this->__ui;
		else if ($variable_name == "es6_event") return $this->__es6_event;
		else if ($variable_name == "currentElement") return $this->__currentElement;
		else if ($variable_name == "target") return $this->__target;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("name");
			$names->push("bubbles");
			$names->push("cancel_bubble");
			$names->push("cancelable");
			$names->push("composed");
			$names->push("default_prevented");
			$names->push("event_phase");
			$names->push("is_trusted");
			$names->push("ui");
			$names->push("es6_event");
			$names->push("currentElement");
			$names->push("target");
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