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
use Runtime\Interfaces\ContextInterface;
use Runtime\CoreStruct;
use Core\UI\Render\CoreManager;
use Core\UI\UIController;
use Core\UI\UIEvent;
class AnnotationEvent extends CoreStruct{
	/**
	 * OnEvent
	 */
	function events(){
		return (new Vector());
	}
	/**
	 * OnEvent
	 */
	static function onEvent($manager, $e){
	}
	/**
	 * Factory onEvent
	 */
	static function onEventFactory($manager, $ui, $annotation){
		return function ($event){
			$ui_event = new UIEvent((new Map())->set("annotation", $annotation)->set("event", $event)->set("ui", $ui));
			static::onEvent($manager, $ui_event);
		};
	}
	/**
	 * Add Emitter
	 */
	static function addEmitter($manager, $emitter, $ui, $annotation){
	}
	/**
	 * Dispatch Event
	 */
	static function dispatch($manager, $ui, $annotation, $event, $ref = null){
		$ui_event = new UIEvent((new Map())->set("annotation", $annotation)->set("event", $event)->set("ref", $ref)->set("ui", $ui));
		static::onEvent($manager, $ui_event);
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Annotations.AnnotationEvent";}
	public static function getCurrentNamespace(){return "Core.UI.Annotations";}
	public static function getCurrentClassName(){return "Core.UI.Annotations.AnnotationEvent";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	public function assignObject($obj){
		if ($obj instanceof AnnotationEvent){
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
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