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
use RuntimeUI\Events\ModelChange;
class BindModel extends ControllerAnnotation{
	protected $__model;
	protected $__component;
	/**
	 * Init controller
	 */
	static function initController($manager, $annotation, $controller){
		$controller->addSignalOut(static::onChangeModel($manager, $annotation, $controller), (new Vector())->push("RuntimeUI.Events.ModelChange"));
	}
	/**
	 * On change
	 */
	static function onChangeModel($manager, $annotation, $controller){
		return function ($event){
			$map = new Map();
			$map->set($annotation->model, $event->model->takeValue($annotation->component, null));
			/* Set new value */
			$manager->updateModel($map);
		}
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Annotations.BindModel";}
	public static function getCurrentClassName(){return "RuntimeUI.Annotations.BindModel";}
	public static function getParentClassName(){return "RuntimeUI.Annotations.ControllerAnnotation";}
	protected function _init(){
		parent::_init();
		$this->__model = "";
		$this->__component = "";
	}
	public function assignObject($obj){
		if ($obj instanceof BindModel){
			$this->__model = $obj->__model;
			$this->__component = $obj->__component;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "model")$this->__model = rtl::convert($value,"string","","");
		else if ($variable_name == "component")$this->__component = rtl::convert($value,"string","","");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "model") return $this->__model;
		else if ($variable_name == "component") return $this->__component;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("model");
			$names->push("component");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}