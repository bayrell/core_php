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
use Runtime\CoreObject;
use Runtime\Emitter;
use Runtime\Reference;
use Core\UI\Render\CoreManager;
class UIController extends CoreObject{
	public $ref;
	public $signal_in;
	public $signal_out;
	public $events;
	public $manager;
	/**
	 * Add supported events to controller
	 * @param Collection<string> events
	 */
	function addEvents($events){
		if ($this->events == null){
			$this->events = new Vector();
		}
		for ($i = 0; $i < $events->count(); $i++){
			$event = $events->item($i);
			if ($this->events->indexOf($event) == -1){
				$this->events->push($event);
			}
		}
	}
	/**
	 * Add output signals
	 * @param fun f
	 * @param Collection<string> events
	 */
	function addSignalOut($f, $events){
		if ($this->signal_out == null){
			$this->signal_out = new Emitter();
		}
		$this->signal_out->addMethod($f, $events);
		$this->addEvents($events);
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.UIController";}
	public static function getCurrentNamespace(){return "Core.UI";}
	public static function getCurrentClassName(){return "Core.UI.UIController";}
	public static function getParentClassName(){return "Runtime.CoreObject";}
	protected function _init(){
		parent::_init();
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
}