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
namespace Core\FileSystem\Provider;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\Provider;
use Runtime\Interfaces\ContextInterface;
use Runtime\Interfaces\ModuleDescriptionInterface;
use Core\FileSystem\Provider\FileSystemProvider;
class ModuleDescription implements ModuleDescriptionInterface{
	/**
	 * Returns module name
	 * @return string
	 */
	static function getModuleName(){
		return "Core.FileSystem.Provider";
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
	 * @return Map<string, string>
	 */
	static function requiredModules(){
		return (new Map())->set("Runtime", ">=0.2 <1.0")->set("Core.FileSystem", "*");
	}
	/**
	 * Returns module files load order
	 * @return Collection<string>
	 */
	static function getModuleFiles(){
		return (new Vector())->push("Core.FileSystem.Provider.FileSystemProvider")->push("Core.FileSystem.Provider.FileSystemProviderFactory")->push("Core.FileSystem.Provider.ModuleDescription");
	}
	/**
	 * Returns enities
	 */
	static function entities(){
		return (new Vector())->push(new Provider((new Map())->set("name", "default.fs")->set("value", "Core.FileSystem.Provider.FileSystemProvider")));
	}
	/**
	 * Called then module registed in context
	 * @param ContextInterface context
	 */
	static function onRegister($context){
	}
	/**
	 * Init context
	 * @param ContextInterface context
	 */
	static function onInitContext($context){
	}
	/**
	 * Called then context read config
	 * @param Map<mixed> config
	 */
	static function onReadConfig($context, $config){
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.FileSystem.Provider.ModuleDescription";}
	public static function getCurrentNamespace(){return "Core.FileSystem.Provider";}
	public static function getCurrentClassName(){return "Core.FileSystem.Provider.ModuleDescription";}
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