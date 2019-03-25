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
namespace RuntimeUI\Render;
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
use Runtime\RuntimeUtils;
use RuntimeUI\Annotations\ControllerAnnotation;
use RuntimeUI\Events\ModelChange;
class CoreManager extends CoreObject{
	public $signal_in;
	public $signal_out;
	public $parent_controller_name;
	public $parent_manager;
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		/* Analyze controllers annotaions */
		$introspection = RuntimeUtils::getIntrospection($this->getClassName());
		$introspection->each(function ($info){
			$annotations = (new \Runtime\Callback($info->getClassName(), "filterAnnotations"))("RuntimeUI.Annotations.ControllerAnnotation", $info);
			$annotations->each(function ($annotation) use (&$info){
				$this->initAnnotation($info, $annotation);
			});
		});
	}
	/**
	 * Set parent manager
	 */
	function setParentManager($parent_manager, $parent_controller_name){
		if ($this->parent_controller_name != "" && $this->parent_manager != null){
			$controller = $this->parent_manager->takeValue($this->parent_controller_name, null);
			if ($controller != null){
				$controller->signal_in->removeEmitter($this->signal_in);
				$this->signal_out->removeEmitter($controller->signal_out);
			}
		}
		$this->parent_controller_name = $parent_controller_name;
		$this->parent_manager = $parent_manager;
		if ($parent_manager != null && $parent_controller_name != ""){
			$parent_controller = $parent_manager->takeValue($parent_controller_name, null);
			if ($parent_controller != null){
				$parent_controller->signal_in->addEmitter($this->signal_in);
				$this->signal_out->addEmitter($parent_controller->signal_out);
			}
		}
	}
	/**
	 * Init Annotation
	 */
	function initAnnotation($info, $annotation){
		if ($info->kind != IntrospectionInfo::ITEM_FIELD){
			return ;
		}
		$field_name = $info->name;
		$controller = $this->takeValue($field_name);
		$controller->manager = $this;
		(new \Runtime\Callback($annotation->getClassName(), "initController"))($this, $annotation, $controller);
	}
	/**
	 * Update current model
	 * @param Dict map
	 */
	function updateModel($map){
		$this->model = $this->model->copy($map);
		$this->signal_out->dispatch(new ModelChange((new Map())->set("model", $this->model)));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Render.CoreManager";}
	public static function getCurrentClassName(){return "RuntimeUI.Render.CoreManager";}
	public static function getParentClassName(){return "Runtime.CoreObject";}
	protected function _init(){
		parent::_init();
	}
}