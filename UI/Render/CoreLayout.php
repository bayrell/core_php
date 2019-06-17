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
use Runtime\CoreStruct;
use Runtime\RuntimeUtils;
use Core\UI\Assets;
use Core\UI\Render\LayoutModel;
use Core\UI\Render\CoreView;
use Core\UI\Render\RenderHelper;
class CoreLayout extends CoreView{
	/**
	 * Returns module name
	 */
	static function moduleName(){
		return "Core.UI";
	}
	/**
	 * Required Assets
	 */
	static function assets(){
		return (new Vector())->push("Core.UI.Assets");
	}
	/**
	 * Required components
	 */
	static function components(){
		return (new Vector());
	}
	/**
	 * Component css
	 */
	static function css($vars){
		return "*{box-sizing: border-box;}body{margin:0;padding:0;}";
	}
	/**
	 * Render head
	 */
	static function head($data){
		return rtl::normalizeUIVector(new Vector(
		new UIStruct(new Map([
		"space"=>"bdb8",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"meta",
		"props"=>(new Map())
			->set("name", "Content-Type")
			->set("content", "text/html; charset=utf-8")
		,
		])),
		new UIStruct(new Map([
		"space"=>"bdb8",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"title",
		"children" => rtl::normalizeUIVector(new Vector(
			rs::htmlEscape($data->title)
		))
		]))));
	}
	/**
	 * Patch modules
	 */
	static function patchAssets($data, $arr){
		$arr = $arr->map(function ($name) use (&$data){
			if (mb_substr($name, 0, 1) == "@"){
				$pos = rs::strpos($name, "/");
				$module_name = rs::substr($name, 1, $pos - 1);
				$path = rs::substr($name, $pos);
				$name = "/assets/" . rtl::toString($module_name) . rtl::toString($path);
			}
			return $name;
		});
		return $arr;
	}
	/**
	 * Render assets in header
	 */
	static function assetsHeader($data){
		$resources = RenderHelper::loadResources($data->assets);
		$css_arr = $resources->filter(function ($name){
			return rs::extname($name) == "css";
		});
		$css_arr = static::patchAssets($data, $css_arr);
		$css_arr = $css_arr->map(function ($css){
			return rtl::normalizeUIVector(new Vector(
			new UIStruct(new Map([
			"space"=>"bdb8",
			"class_name"=>static::getCurrentClassName(),
			"name"=>"link",
			"props"=>(new Map())
				->set("rel", "stylesheet")
				->set("href", $css)
			,
			]))));
		});
		$css = static::css($data->css_vars);
		$css .= RenderHelper::getCSSFromComponents($data->components, $data->css_vars);
		return rtl::normalizeUIVector(new Vector(
		rtl::normalizeUIVector(new Vector(
		rs::htmlEscape($css_arr),
		new UIStruct(new Map([
		"space"=>"bdb8",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"style",
		"props"=>(new Map())
			->set("type", "text/css")
		,
		"children" => rtl::normalizeUIVector(new Vector(
			$css
		))
		]))
		))));
	}
	/**
	 * Render assets in body
	 */
	static function assetsBody($data){
		$resources = RenderHelper::loadResources($data->assets);
		$js_arr = $resources->filter(function ($name){
			return rs::extname($name) == "js";
		});
		$js_arr = $js_arr->pushIm("@Core.UI/es6/Drivers/RenderDriver.js");
		$js_arr = $js_arr->pushIm("@Core.UI/es6/Drivers/ApiBusDriver.js");
		$js_arr = static::patchAssets($data, $js_arr);
		$js_arr = $js_arr->map(function ($js){
			return rtl::normalizeUIVector(new Vector(
			new UIStruct(new Map([
			"space"=>"bdb8",
			"class_name"=>static::getCurrentClassName(),
			"name"=>"script",
			"props"=>(new Map())
				->set("src", $js)
			,
			]))));
		});
		return $js_arr;
	}
	/**
	 * Content render
	 */
	static function content($data){
		return $data->content;
	}
	/**
	 * Component render
	 */
	static function render($data){
		return rtl::normalizeUIVector(new Vector(
		"<!DOCTYPE html>",
		new UIStruct(new Map([
		"space"=>"bdb8",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"html",
		"children" => rtl::normalizeUIVector(new Vector(
			new UIStruct(new Map([
			"space"=>"bdb8",
			"class_name"=>static::getCurrentClassName(),
			"name"=>"head",
			"children" => rtl::normalizeUIVector(new Vector(
				rs::htmlEscape(static::head($data)),
				rs::htmlEscape(static::assetsHeader($data))
			))
			])),
			new UIStruct(new Map([
			"space"=>"bdb8",
			"class_name"=>static::getCurrentClassName(),
			"name"=>"body",
			"children" => rtl::normalizeUIVector(new Vector(
				new UIStruct(new Map([
				"space"=>"bdb8",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"div",
				"props"=>(new Map())
					->set("id", "root")
				,
				"children" => rtl::normalizeUIVector(new Vector(
					static::content($data)
				))
				])),
				new UIStruct(new Map([
				"space"=>"bdb8",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"input",
				"props"=>(new Map())
					->set("id", "view")
					->set("value", $data->view)
					->set("style", "display: none;")
				,
				])),
				new UIStruct(new Map([
				"space"=>"bdb8",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"input",
				"props"=>(new Map())
					->set("id", "model")
					->set("value", RuntimeUtils::base64_encode(rtl::json_encode($data->model)))
					->set("style", "display: none;")
				,
				])),
				new UIStruct(new Map([
				"space"=>"bdb8",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"div",
				"props"=>(new Map())
					->set("id", "scripts")
				,
				"children" => rtl::normalizeUIVector(new Vector(
					rs::htmlEscape(static::assetsBody($data))
				))
				]))
			))
			]))
		))
		]))));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Render.CoreLayout";}
	public static function getCurrentNamespace(){return "Core.UI.Render";}
	public static function getCurrentClassName(){return "Core.UI.Render.CoreLayout";}
	public static function getParentClassName(){return "Core.UI.Render.CoreView";}
	public function assignObject($obj){
		if ($obj instanceof CoreLayout){
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