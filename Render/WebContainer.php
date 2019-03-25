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
use RuntimeUI\Annotations\RouteInfo;
use RuntimeUI\Http\Request;
use RuntimeUI\Http\Response;
use RuntimeUI\Http\Session;
use RuntimeUI\Http\WebFile;
use RuntimeUI\Render\RenderContainer;
use RuntimeUI\Render\RenderHelper;
class WebContainer extends CoreStruct{
	protected $__request;
	protected $__response;
	protected $__route_info;
	protected $__cookies;
	protected $__params;
	/**
	 * Returns assets
	 * @param string layout_class_name
	 * @param CoreLayoutModel layout_data
	 * @param string view_class_name
	 * @param CoreStruct view_data
	 * @return Response
	 */
	static function responsePage($layout_class_name, $layout_data, $view_class_name, $view_data){
		/* Render view */
		$content = RenderHelper::render($view_class_name, $view_data);
		/* Render layout */
		if ($layout_class_name != "" && $layout_data != null && $layout_data instanceof RenderContainer){
			$components = RenderHelper::getAllComponents((new Vector())->push($layout_class_name)->push($view_class_name));
			$assets = RenderHelper::loadAssetsFromComponents($components, $layout_data);
			$layout_data = RenderHelper::initRenderContainer($layout_data);
			$layout_data = $layout_data->copy((new Map())->set("assets", $assets)->set("components", $components)->set("content", $content)->set("view", $view_class_name)->set("model", $view_data));
			$content = RenderHelper::render($layout_class_name, $layout_data);
		}
		return new Response((new Map())->set("content", $content));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Render.WebContainer";}
	public static function getCurrentClassName(){return "RuntimeUI.Render.WebContainer";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__request = null;
		$this->__response = null;
		$this->__route_info = null;
		$this->__cookies = null;
		$this->__params = null;
	}
	public function assignObject($obj){
		if ($obj instanceof WebContainer){
			$this->__request = $obj->__request;
			$this->__response = $obj->__response;
			$this->__route_info = $obj->__route_info;
			$this->__cookies = $obj->__cookies;
			$this->__params = $obj->__params;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "request")$this->__request = rtl::convert($value,"RuntimeUI.Http.Request",null,"");
		else if ($variable_name == "response")$this->__response = rtl::convert($value,"RuntimeUI.Http.Response",null,"");
		else if ($variable_name == "route_info")$this->__route_info = rtl::convert($value,"RuntimeUI.Annotations.RouteInfo",null,"");
		else if ($variable_name == "cookies")$this->__cookies = rtl::convert($value,"Runtime.Collection",null,"Cookie");
		else if ($variable_name == "params")$this->__params = rtl::convert($value,"Runtime.Map",null,"string");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "request") return $this->__request;
		else if ($variable_name == "response") return $this->__response;
		else if ($variable_name == "route_info") return $this->__route_info;
		else if ($variable_name == "cookies") return $this->__cookies;
		else if ($variable_name == "params") return $this->__params;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("request");
			$names->push("response");
			$names->push("route_info");
			$names->push("cookies");
			$names->push("params");
		}
	}
	public static function getFieldInfoByName($field_name){
		return null;
	}
	public function __get($key){ return $this->takeValue($key); }
	public function __set($key, $value){throw new \Runtime\Exceptions\AssignStructValueError($key);}
}