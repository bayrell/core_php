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
namespace Core\UI;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\Interfaces\ContextInterface;
use Runtime\Interfaces\ModuleDescriptionInterface;
use Core\Interfaces\AssetsInterface;
use Core\UI\Render\RenderContainer;
class ModuleDescription implements ModuleDescriptionInterface, AssetsInterface{
	/**
	 * Returns module name
	 * @return string
	 */
	static function getModuleName(){
		return "Core.UI";
	}
	/**
	 * Returns module name
	 * @return string
	 */
	static function getModuleVersion(){
		return "0.7.3";
	}
	/**
	 * Returns required modules
	 * @return Dict<string>
	 */
	static function requiredModules(){
		return (new Map())->set("Runtime", ">=0.3")->set("Core.Interfaces", "*")->set("Core.Http", "*");
	}
	/**
	 * Returns module files load order
	 * @return Collection<string>
	 */
	static function getModuleFiles(){
		return (new Vector())->push("Core.UI.UIEvent")->push("Core.UI.Annotations.AnnotationEvent")->push("Core.UI.Annotations.ApiInstance")->push("Core.UI.Annotations.RouteInfo")->push("Core.UI.Annotations.RoutesInstance")->push("Core.UI.Events.CommandEvent")->push("Core.UI.Events.ComponentEvent")->push("Core.UI.Events.ModelChange")->push("Core.UI.Events.MountEvent")->push("Core.UI.Events.UpdateStateEvent")->push("Core.UI.Events.UserEvent.UserEvent")->push("Core.UI.Render.CoreManager")->push("Core.UI.Render.CoreRoute")->push("Core.UI.Render.CoreView")->push("Core.UI.Render.RenderContainer")->push("Core.UI.Render.RenderHelper")->push("Core.UI.Render.WebContainer")->push("Core.UI.Assets")->push("Core.UI.Annotations.BindModel")->push("Core.UI.Annotations.Event")->push("Core.UI.Annotations.EventAsync")->push("Core.UI.Events.KeyboardEvent.KeyboardEvent")->push("Core.UI.Events.MouseEvent.MouseEvent")->push("Core.UI.Events.UserEvent.BlurEvent")->push("Core.UI.Events.UserEvent.ChangeEvent")->push("Core.UI.Events.UserEvent.FocusEvent")->push("Core.UI.Render.CoreLayout")->push("Core.UI.Events.KeyboardEvent.KeyDownEvent")->push("Core.UI.Events.KeyboardEvent.KeyPressEvent")->push("Core.UI.Events.KeyboardEvent.KeyUpEvent")->push("Core.UI.Events.MouseEvent.MouseClickEvent")->push("Core.UI.Events.MouseEvent.MouseContextMenuEvent")->push("Core.UI.Events.MouseEvent.MouseDoubleClickEvent")->push("Core.UI.Events.MouseEvent.MouseDownEvent")->push("Core.UI.Events.MouseEvent.MouseEnterEvent")->push("Core.UI.Events.MouseEvent.MouseLeaveEvent")->push("Core.UI.Events.MouseEvent.MouseMoveEvent")->push("Core.UI.Events.MouseEvent.MouseOutEvent")->push("Core.UI.Events.MouseEvent.MouseOverEvent")->push("Core.UI.Events.MouseEvent.MouseUpEvent");
	}
	/**
	 * Returns enities
	 */
	static function entities(){
		return null;
	}
	/**
	 * Returns required assets
	 * @return Collection<string>
	 */
	static function assets($context){
		return null;
	}
	/**
	 * Returns sync loaded files
	 */
	static function resources($context){
		return null;
	}
	/**
	 * Init render container
	 */
	static function initContainer($container){
		return $container;
	}
	/**
	 * Get lambda filters
	 */
	static function lambdaFilters(){
		return null;
	}
	/**
	 * Called then module registed in context
	 * @param ContextInterface context
	 */
	static function onRegister($context){
	}
	/**
	 * Called then context read config
	 * @param Map<mixed> config
	 */
	static function onReadConfig($context, $config){
	}
	/**
	 * Init context
	 * @param ContextInterface context
	 */
	static function onInitContext($context){
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.ModuleDescription";}
	public static function getCurrentNamespace(){return "Core.UI";}
	public static function getCurrentClassName(){return "Core.UI.ModuleDescription";}
	public static function getParentClassName(){return "";}
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