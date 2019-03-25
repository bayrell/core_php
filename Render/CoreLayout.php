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
use Runtime\CoreStruct;
use RuntimeUI\Assets;
use RuntimeUI\Render\CoreLayoutModel;
use RuntimeUI\Render\CoreView;
use RuntimeUI\Render\RenderHelper;
class CoreLayout extends CoreView{
	/**
	 * Required Assets
	 */
	static function assets(){
		return (new Vector())->push("RuntimeUI.Assets");
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
		return "";
	}
	/**
	 * Render head
	 */
	static function head($data){
		return rtl::normalizeUIVector(new Vector([
		new UIStruct(new Map([
		"space"=>"8f09",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"meta",
		"props"=>(new Map())
			->set("name", "Content-Type")
			->set("content", "text/html; charset=utf-8")
		,
		])),
		new UIStruct(new Map([
		"space"=>"8f09",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"title",
		"children" => rtl::normalizeUIVector(new Vector([
			rs::htmlEscape($data->title)
		]))
		]))]));
	}
	/**
	 * Render assets in header
	 */
	static function assetsHeader($data){
		$css = RenderHelper::getCSSFromComponents($data->components, $data->css_vars);
		return new UIStruct((new Map())->set("kind", UIStruct::TYPE_ELEMENT)->set("name", "style")->set("props", (new Map())->set("type", "text/css"))->set("children", (new Vector())->push(rtl::normalizeUI($css))));
	}
	/**
	 * Render assets in body
	 */
	static function assetsBody($data){
		$js = RenderHelper::loadAsyncResources($data->assets);
		$res = new Vector();
		for ($i = 0; $i < $js->count(); $i++){
			$res->push(new UIStruct((new Map())->set("kind", UIStruct::TYPE_ELEMENT)->set("name", "script")->set("props", (new Map())->set("src", $js->item($i)))));
		}
		$res->push(new UIStruct((new Map())->set("kind", UIStruct::TYPE_ELEMENT)->set("name", "script")->set("props", (new Map())->set("src", "/assets/bayrell-runtime-ui-es6/Drivers/RenderDriver.js"))));
		return $res->toCollection();
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
		return rtl::normalizeUIVector(new Vector([
		"<!DOCTYPE html>",
		new UIStruct(new Map([
		"space"=>"8f09",
		"class_name"=>static::getCurrentClassName(),
		"name"=>"html",
		"children" => rtl::normalizeUIVector(new Vector([
			new UIStruct(new Map([
			"space"=>"8f09",
			"class_name"=>static::getCurrentClassName(),
			"name"=>"head",
			"children" => rtl::normalizeUIVector(new Vector([
				rs::htmlEscape(static::head($data)),
				rs::htmlEscape(static::assetsHeader($data))
			]))
			])),
			new UIStruct(new Map([
			"space"=>"8f09",
			"class_name"=>static::getCurrentClassName(),
			"name"=>"body",
			"children" => rtl::normalizeUIVector(new Vector([
				new UIStruct(new Map([
				"space"=>"8f09",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"div",
				"props"=>(new Map())
					->set("id", "root")
				,
				"children" => rtl::normalizeUIVector(new Vector([
					static::content($data)
				]))
				])),
				new UIStruct(new Map([
				"space"=>"8f09",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"input",
				"props"=>(new Map())
					->set("id", "view")
					->set("value", $data->view)
					->set("style", "display: none;")
				,
				])),
				new UIStruct(new Map([
				"space"=>"8f09",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"input",
				"props"=>(new Map())
					->set("id", "model")
					->set("value", rtl::json_encode($data->model))
					->set("style", "display: none;")
				,
				])),
				new UIStruct(new Map([
				"space"=>"8f09",
				"class_name"=>static::getCurrentClassName(),
				"name"=>"div",
				"props"=>(new Map())
					->set("id", "scripts")
				,
				"children" => rtl::normalizeUIVector(new Vector([
					rs::htmlEscape(static::assetsBody($data))
				]))
				]))
			]))
			]))
		]))
		]))]));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Render.CoreLayout";}
	public static function getCurrentClassName(){return "RuntimeUI.Render.CoreLayout";}
	public static function getParentClassName(){return "RuntimeUI.Render.CoreView";}
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
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}