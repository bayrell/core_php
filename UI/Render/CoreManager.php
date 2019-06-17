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
namespace Core\UI\Render;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\ContextObject;
use Runtime\Emitter;
use Runtime\Reference;
use Runtime\RuntimeUtils;
use Runtime\Interfaces\ContextInterface;
use Core\UI\Annotations\AnnotationEvent;
use Core\UI\Annotations\BindModel;
use Core\UI\Events\ModelChange;
class CoreManager extends ContextObject{
	public $_key;
	public $model;
	public $_model_updated_by_self;
	public $_model_updated_by_driver;
	public $signal_in;
	public $signal_out;
	public $annotations_emitter;
	public $parent_manager;
	public $ui;
	/**
	 * Returns parent controller name
	 */
	function getParentControllerName(){
		return $this->ui->controller;
	}
	/**
	 * Constructor
	 */
	function __construct($context = null){
		parent::__construct($context);
		/* Analyze controllers annotaions */
		$introspection = RuntimeUtils::getIntrospection($this->getClassName());
		$introspection->each(function ($info){
			$annotations = (new \Runtime\Callback($info->getClassName(), "filterAnnotations"))("", $info);
			$annotations->each(function ($annotation) use (&$info){
				$this->initAnnotation($info, $annotation);
			});
		});
		/* Init manager */
		$this->initManager();
	}
	/**
	 * Init manager
	 */
	function initManager(){
		$this->signal_in->addMethod(new \Runtime\Callback($this, "signalInModelChange"), (new Vector())->push("Core.UI.Events.ModelChange"));
	}
	/**
	 * Destroy manager
	 */
	function destroyManager(){
	}
	/**
	 * Model changed by input signal
	 */
	function signalInModelChange($event){
	}
	/**
	 * Driver start manager
	 */
	function onStartManager(){
	}
	/**
	 * Model changed by driver or self
	 */
	function onModelChange($old_model, $new_model){
	}
	/**
	 * Driver update manager
	 */
	function onUpdateManager($old_model, $new_model){
	}
	/**
	 * Set parent manager
	 */
	function setParentManager($parent_manager, $ui){
		/* Remove old annotations */
		if ($this->annotations_emitter != null){
			$this->signal_out->removeEmitter($this->annotations_emitter);
			$this->annotations_emitter = null;
		}
		$this->ui = $ui;
		$this->parent_manager = $parent_manager;
		/*
		if (parent_manager != null and parent_controller_name != "")
		{
			UIControl parent_controller = parent_manager.takeValue(parent_controller_name, null);
			if (parent_controller != null)
			{
				parent_controller.signal_in.addEmitter( this.signal_in );
				this.signal_out.addEmitter( parent_controller.signal_out );
			}
		}
		*/
		/* Build annotations */
		$annotations = new Vector();
		if ($ui->annotations != null){
			$annotations = $ui->annotations->toVector();
		}
		if ($ui->bind != ""){
			$annotations->push(new BindModel((new Map())->set("model", $ui->bind)));
		}
		if ($annotations != null && $annotations->count() > 0){
			$this->annotations_emitter = new Emitter();
			for ($i = 0; $i < $annotations->count(); $i++){
				$annotation = $annotations->item($i);
				(new \Runtime\Callback($annotation->getClassName(), "addEmitter"))($this->parent_manager, $this->annotations_emitter, $ui, $annotation);
			}
			$this->signal_out->addEmitter($this->annotations_emitter);
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
		(new \Runtime\Callback($annotation->getClassName(), "initController"))($controller, $this, $annotation, $field_name);
	}
	/**
	 * Update current model
	 * @param Dict map
	 */
	function updateModel($map){
		$this->setModel($this->model->copy($map));
	}
	/**
	 * Set new manager's model and dispatch signal out ModelChange
	 * @param CoreModel model
	 */
	function setModel($model){
		if ($this->model != $model){
			$old_model = $this->model;
			$this->model = $model;
			$this->_model_updated_by_self = true;
			$this->signal_out->dispatch(new ModelChange((new Map())->set("model", $this->model)));
			$this->onModelChange($old_model, $model);
		}
	}
	/**
	 * Send output signals
	 * @param CoreEvent event
	 */
	function signalOut($event){
		$this->signal_out->dispatch($event);
	}
	/**
	 * Returns true if model is updated
	 * @return bool
	 */
	function isModelUpdated(){
		return $this->_model_updated_by_self || $this->_model_updated_by_driver;
	}
	/**
	 * Returns true if model is update by Driver
	 * @return bool
	 */
	function isModelUpdatedByDriver(){
		return $this->_model_updated_by_driver;
	}
	/**
	 * Returns true if model is update by self manager
	 * @return bool
	 */
	function isModelUpdatedBySelf(){
		return $this->_model_updated_by_self;
	}
	/**
	 * Set new manager's model
	 */
	function driverSetNewModel($model){
		$old_model = $this->model;
		if ($this->model != $model){
			$this->model = $model;
			$this->_model_updated_by_driver = true;
			$this->onModelChange($old_model, $model);
		}
	}
	/**
	 * Update DOM by manager. Return true if manager should update, or false if update should by driver
	 * @return bool
	 */
	function shouldUpdateElem($elem, $ui){
		return $this->isModelUpdated();
	}
	/**
	 * Overload driver render
	 * @return bool
	 */
	function driverRenderOverload($elem, $ui){
		return false;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Render.CoreManager";}
	public static function getCurrentNamespace(){return "Core.UI.Render";}
	public static function getCurrentClassName(){return "Core.UI.Render.CoreManager";}
	public static function getParentClassName(){return "Runtime.ContextObject";}
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