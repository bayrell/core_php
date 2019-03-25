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
namespace RuntimeUI\Annotations;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use RuntimeUI\Annotations\ControllerAnnotation;
use RuntimeUI\Events\UserEvent\ChangeEvent;
class Event extends ControllerAnnotation{
	protected $__event;
	protected $__method_name;
	/**
	 * Init controller
	 */
	static function initController($manager, $annotation, $controller){
		$controller->addSignalOut(rtl::method($manager, $annotation->method_name), (new Vector())->push($annotation->event));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Annotations.Event";}
	public static function getCurrentClassName(){return "RuntimeUI.Annotations.Event";}
	public static function getParentClassName(){return "RuntimeUI.Annotations.ControllerAnnotation";}
	protected function _init(){
		parent::_init();
		$this->__event = "";
		$this->__method_name = "";
	}
	public function assignObject($obj){
		if ($obj instanceof Event){
			$this->__event = $obj->__event;
			$this->__method_name = $obj->__method_name;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "event")$this->__event = rtl::convert($value,"string","","");
		else if ($variable_name == "method_name")$this->__method_name = rtl::convert($value,"string","","");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "event") return $this->__event;
		else if ($variable_name == "method_name") return $this->__method_name;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("event");
			$names->push("method_name");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}