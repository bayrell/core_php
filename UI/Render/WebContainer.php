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
use Runtime\Interfaces\ModuleDescriptionInterface;
use Core\Interfaces\AssetsInterface;
use Core\Interfaces\ComponentInterface;
use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Session;
use Core\Http\WebFile;
use Core\UI\Annotations\RouteInfo;
use Core\UI\Render\LayoutModel;
use Core\UI\Render\RenderHelper;
use Core\UI\Render\RenderResult;
class WebContainer extends CoreStruct{
	protected $__request;
	protected $__render;
	protected $__response;
	protected $__route_info;
	protected $__cookies;
	protected $__params;
	/**
	 * Render view
	 */
	static function renderView($context, $container){
		$render_result = $container->render;
		if ($render_result == null){
			return $container;
		}
		$layout_model = $render_result->layout_model;
		if ($layout_model == null){
			$layout_model = new LayoutModel();
		}
		$content = RenderHelper::render($render_result->view_class, $render_result->view_model);
		/* Get modules name */
		$arr = (new Vector())->push($render_result->view_class);
		if ($render_result->layout_class != ""){
			$arr->push($render_result->layout_class);
		}
		$arr = $arr->map(function ($class_name){
			return rtl::method($class_name, "moduleDescription")();
		});
		/* Get all assets and components */
		$modules = RenderHelper::getModules($arr, $layout_model);
		$assets = $modules->filter(function ($class_name){
			$is_assets = rtl::class_implements($class_name, "Core.Interfaces.AssetsInterface") || rtl::class_implements($class_name, "Runtime.Interfaces.ModuleDescriptionInterface") || rtl::class_implements($class_name, "Core.Interfaces.ComponentInterface");
			return $is_assets;
		});
		$components = $modules->filter(function ($class_name){
			$is_component = rtl::class_implements($class_name, "Core.Interfaces.ComponentInterface");
			return $is_component;
		});
		/* Init layout model */
		$layout_model = RenderHelper::initRenderContainer($layout_model);
		$layout_model = $layout_model->copy((new Map())->set("modules", $modules)->set("assets", $assets)->set("components", $components)->set("content", $content));
		$container = $container->copy( new Map([ "render" => $container->render->copy( new Map([ "layout_model" => $layout_model ])  ) ])  );
		return $container;
	}
	/**
	 * Render layout
	 */
	static function renderLayout($context, $container){
		if ($container->render == null){
			return $container;
		}
		if ($container->render->layout_class == "" || $container->render->layout_model == null){
			return $container;
		}
		$layout_model = $container->render->layout_model->copy((new Map())->set("view", $container->render->view_class)->set("model", $container->render->view_model));
		$container = $container->copy( new Map([ "render" => $container->render->copy( new Map([ "layout_model" => $layout_model ])  ) ])  );
		$content = RenderHelper::render($container->render->layout_class, $container->render->layout_model);
		$container = $container->copy( new Map([ "response" => new Response((new Map())->set("content", $content)) ])  );
		return $container;
	}
	/**
	 * Render container
	 */
	static function response($context, $container){
		if ($container->response != null){
			return $container;
		}
		if ($container->render == null){
			return $container;
		}
		$container = static::renderView($context, $container);
		$container = static::renderLayout($context, $container);
		return $container;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Render.WebContainer";}
	public static function getCurrentNamespace(){return "Core.UI.Render";}
	public static function getCurrentClassName(){return "Core.UI.Render.WebContainer";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__request = null;
		$this->__render = null;
		$this->__response = null;
		$this->__route_info = null;
		$this->__cookies = null;
		$this->__params = null;
	}
	public function assignObject($obj){
		if ($obj instanceof WebContainer){
			$this->__request = $obj->__request;
			$this->__render = $obj->__render;
			$this->__response = $obj->__response;
			$this->__route_info = $obj->__route_info;
			$this->__cookies = $obj->__cookies;
			$this->__params = $obj->__params;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "request")$this->__request = rtl::convert($value,"Core.Http.Request",null,"");
		else if ($variable_name == "render")$this->__render = rtl::convert($value,"Core.UI.Render.RenderResult",null,"");
		else if ($variable_name == "response")$this->__response = rtl::convert($value,"Core.Http.Response",null,"");
		else if ($variable_name == "route_info")$this->__route_info = rtl::convert($value,"Core.UI.Annotations.RouteInfo",null,"");
		else if ($variable_name == "cookies")$this->__cookies = rtl::convert($value,"Runtime.Collection",null,"Cookie");
		else if ($variable_name == "params")$this->__params = rtl::convert($value,"Runtime.Map",null,"string");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "request") return $this->__request;
		else if ($variable_name == "render") return $this->__render;
		else if ($variable_name == "response") return $this->__response;
		else if ($variable_name == "route_info") return $this->__route_info;
		else if ($variable_name == "cookies") return $this->__cookies;
		else if ($variable_name == "params") return $this->__params;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("request");
			$names->push("render");
			$names->push("response");
			$names->push("route_info");
			$names->push("cookies");
			$names->push("params");
		}
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