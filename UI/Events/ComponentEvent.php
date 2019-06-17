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
namespace Core\UI\Events;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Core\UI\Component;
use Core\UI\Events\CommandEvent;
class ComponentEvent extends CommandEvent{
	const START_EVENT = "start";
	const STOP_EVENT = "stop";
	const MOUNT_EVENT = "mount";
	const UNMOUNT_EVENT = "unmount";
	const UPDATE_EVENT = "update";
	const REPAINT_EVENT = "repaint";
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Events.ComponentEvent";}
	public static function getCurrentNamespace(){return "Core.UI.Events";}
	public static function getCurrentClassName(){return "Core.UI.Events.ComponentEvent";}
	public static function getParentClassName(){return "Core.UI.Events.CommandEvent";}
	public function assignObject($obj){
		if ($obj instanceof ComponentEvent){
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