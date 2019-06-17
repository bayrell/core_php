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
namespace Core\Interfaces;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Core\UI\Render\RenderContainer;
interface AssetsInterface{
	/**
	 * Returns module name
	 * @return string
	 */
	static function getModuleName();
	/**
	 * Returns required modules
	 * @return Dict<string>
	 */
	static function requiredModules();
	/**
	 * Returns module files load order
	 * @return Collection<string>
	 */
	static function getModuleFiles();
	/**
	 * Returns required assets
	 * @return Collection<string>
	 */
	static function assets($container);
	/**
	 * Returns sync loaded files
	 */
	static function resources($container);
	/**
	 * Init render container
	 */
	static function initContainer($container);
}