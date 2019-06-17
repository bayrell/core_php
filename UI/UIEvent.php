<?php
/*!
 *  Bayrell Core Library
 *
 *  (c) Copyright 2016-2018 "Ildar Bikmamatov" <support@bayrell.org>
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
namespace Core\UI;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreEvent;
use Runtime\CoreStruct;
use Runtime\Emitter;
use Runtime\Reference;
use Runtime\UIStruct;
use Core\UI\Annotations\AnnotationEvent;
use Core\UI\Render\CoreManager;
class UIEvent extends CoreStruct{
	public $ref;
	public $annotation;
	public $event;
	public $ui;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.UIEvent";}
	public static function getCurrentNamespace(){return "Core.UI";}
	public static function getCurrentClassName(){return "Core.UI.UIEvent";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
	}
	public function assignObject($obj){
		if ($obj instanceof UIEvent){
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "ref")$this->ref = rtl::convert($value,"Runtime.Reference",null,"");
		else if ($variable_name == "annotation")$this->annotation = rtl::convert($value,"Core.UI.Annotations.AnnotationEvent",null,"");
		else if ($variable_name == "event")$this->event = rtl::convert($value,"Runtime.CoreEvent",null,"");
		else if ($variable_name == "ui")$this->ui = rtl::convert($value,"Runtime.UIStruct",null,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "ref") return $this->ref;
		else if ($variable_name == "annotation") return $this->annotation;
		else if ($variable_name == "event") return $this->event;
		else if ($variable_name == "ui") return $this->ui;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 2)==2){
			$names->push("ref");
			$names->push("annotation");
			$names->push("event");
			$names->push("ui");
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
}