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
namespace RuntimeUI\Animations;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use RuntimeUI\Annotations\ControllerAnnotation;
use RuntimeUI\Events\ModelChange;
class FadeIn extends ControllerAnnotation{
	protected $__speed;
	/**
	 * Init controller
	 */
	static function initController($manager, $annotation, $controller){
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Animations.FadeIn";}
	public static function getCurrentClassName(){return "RuntimeUI.Animations.FadeIn";}
	public static function getParentClassName(){return "RuntimeUI.Annotations.ControllerAnnotation";}
	protected function _init(){
		parent::_init();
		$this->__speed = 0;
	}
	public function assignObject($obj){
		if ($obj instanceof FadeIn){
			$this->__speed = $obj->__speed;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "speed")$this->__speed = rtl::convert($value,"int",0,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "speed") return $this->__speed;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("speed");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}