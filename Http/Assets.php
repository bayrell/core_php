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
namespace Core\Http;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Core\UI\Interfaces\AssetsInterface;
use Core\UI\Render\RenderContainer;
class Assets implements AssetsInterface{
	/**
	 * Returns required assets
	 * @return Map<string, string>
	 */
	static function getRequiredAssets($context){
		return (new Vector());
	}
	/**
	 * Returns sync loaded files
	 */
	static function assetsSyncLoad($context){
		return (new Vector());
	}
	/**
	 * Returns async loaded files
	 */
	static function assetsAsyncLoad($context){
		return (new Vector())->push((new Vector())->push("@Core/Http/ApiRequest.js")->push("@Core/Http/ApiResult.js")->push("@Core/Http/Cookie.js")->push("@Core/Http/Request.js")->push("@Core/Http/Response.js"))->push((new Vector())->push("@Core/Http/JsonResponse.js"));
	}
	/**
	 * Init render container
	 */
	static function initContainer($container){
		return $container;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.Http.Assets";}
	public static function getCurrentNamespace(){return "Core.Http";}
	public static function getCurrentClassName(){return "Core.Http.Assets";}
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