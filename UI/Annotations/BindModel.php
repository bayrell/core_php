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
use Core\UI\Events\ModelChange;
use Core\UI\Events\UserEvent\ChangeEvent;
class BindModel extends AnnotationEvent{
	protected $__model;
	/**
	 * OnEvent
	 */
	function events(){
		return (new Vector())->push("Core.UI.Events.ModelChange")->push("Core.UI.Events.UserEvent.ChangeEvent");
	}
	/**
	 * OnEvent
	 */
	static function onEvent($manager, $e){
		if ($e->event instanceof ChangeEvent){
			$map = new Map();
			$map->set($e->annotation->model, $e->event->value);
			$manager->updateModel($map);
		}
		if ($e->event instanceof ModelChange){
			$map = new Map();
			$map->set($e->annotation->model, $e->event->model);
			$manager->updateModel($map);
		}
	}
	/**
	 * Add Emitter
	 */
	static function addEmitter($manager, $emitter, $ui, $annotation){
		$emitter->addMethod(static::onEventFactory($manager, $ui, $annotation), (new Vector())->push("Core.UI.Events.ModelChange")->push("Core.UI.Events.UserEvent.ChangeEvent"));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Annotations.BindModel";}
	public static function getCurrentNamespace(){return "Core.UI.Annotations";}
	public static function getCurrentClassName(){return "Core.UI.Annotations.BindModel";}
	public static function getParentClassName(){return "Core.UI.Annotations.AnnotationEvent";}
	protected function _init(){
		parent::_init();
		$this->__model = "";
	}
	public function assignObject($obj){
		if ($obj instanceof BindModel){
			$this->__model = $obj->__model;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "model")$this->__model = rtl::convert($value,"string","","");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "model") return $this->__model;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("model");
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