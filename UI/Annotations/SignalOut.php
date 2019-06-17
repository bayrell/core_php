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
use Core\UI\Annotations\ControllerAnnotation;
use Core\UI\Events\UserEvent\ChangeEvent;
class SignalOut extends ControllerAnnotation{
	protected $__event;
	/**
	 * Init controller
	 */
	static function initController($controller, $manager, $annotation, $controller_name){
		$controller->addSignalOut(static::onEvent($manager, $annotation), (new Vector())->push($annotation->event));
	}
	/**
	 * On event
	 */
	static function onEvent($manager, $annotation){
		return function ($event){
			$manager->signalOut($event);
		};
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Annotations.SignalOut";}
	public static function getCurrentNamespace(){return "Core.UI.Annotations";}
	public static function getCurrentClassName(){return "Core.UI.Annotations.SignalOut";}
	public static function getParentClassName(){return "Core.UI.Annotations.ControllerAnnotation";}
	protected function _init(){
		parent::_init();
		$this->__event = "";
	}
	public function assignObject($obj){
		if ($obj instanceof SignalOut){
			$this->__event = $obj->__event;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "event")$this->__event = rtl::convert($value,"string","","");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "event") return $this->__event;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("event");
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