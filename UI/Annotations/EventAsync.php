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
use Core\UI\Annotations\AnnotationEvent;
use Core\UI\Events\UserEvent\ChangeEvent;
class EventAsync extends AnnotationEvent{
	protected $__event;
	protected $__method_name;
	protected $__cancel;
	protected $__preventDefault;
	/**
	 * OnEvent
	 */
	function events(){
		return (new Vector())->push($this->event);
	}
	/**
	 * OnEvent
	 */
	static function onEvent($manager, $e){
		if ($e->annotation->cancel){
			$e->event->cancel();
		}
		else if ($e->annotation->preventDefault){
			$e->event->preventDefault();
		}
		$f = rtl::methodAwait($manager, $e->annotation->method_name);
		$f($e);
	}
	/**
	 * Add Emitter
	 */
	static function addEmitter($manager, $emitter, $ui, $annotation){
		$emitter->addMethod(static::onEventFactory($manager, $ui, $annotation), (new Vector())->push($annotation->event));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Annotations.EventAsync";}
	public static function getCurrentNamespace(){return "Core.UI.Annotations";}
	public static function getCurrentClassName(){return "Core.UI.Annotations.EventAsync";}
	public static function getParentClassName(){return "Core.UI.Annotations.AnnotationEvent";}
	protected function _init(){
		parent::_init();
		$this->__event = "";
		$this->__method_name = "";
		$this->__cancel = false;
		$this->__preventDefault = false;
	}
	public function assignObject($obj){
		if ($obj instanceof EventAsync){
			$this->__event = $obj->__event;
			$this->__method_name = $obj->__method_name;
			$this->__cancel = $obj->__cancel;
			$this->__preventDefault = $obj->__preventDefault;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "event")$this->__event = rtl::convert($value,"string","","");
		else if ($variable_name == "method_name")$this->__method_name = rtl::convert($value,"string","","");
		else if ($variable_name == "cancel")$this->__cancel = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "preventDefault")$this->__preventDefault = rtl::convert($value,"bool",false,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "event") return $this->__event;
		else if ($variable_name == "method_name") return $this->__method_name;
		else if ($variable_name == "cancel") return $this->__cancel;
		else if ($variable_name == "preventDefault") return $this->__preventDefault;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("event");
			$names->push("method_name");
			$names->push("cancel");
			$names->push("preventDefault");
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