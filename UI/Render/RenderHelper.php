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
use Runtime\Interfaces\ModuleDescriptionInterface;
use Runtime\Interfaces\StringInterface;
use Core\Interfaces\AssetsInterface;
use Core\Interfaces\ComponentInterface;
use Core\UI\Render\RenderContainer;
class RenderHelper{
	/**
	 * Render class with data
	 */
	static function render($class_name, $data){
		$ui = null;
		if ($data instanceof CoreStruct){
			$ui = new UIStruct((new Map())->set("name", $class_name)->set("kind", UIStruct::TYPE_COMPONENT)->set("model", $data));
		}
		else {
			$ui = new UIStruct((new Map())->set("name", $class_name)->set("kind", UIStruct::TYPE_COMPONENT)->set("props", $data));
		}
		return RenderHelper::getUIString($ui);
	}
	/**
	 * Returns if tag name is double token
	 */
	static function isDoubleToken($tag_name){
		$__memorize_value = rtl::_memorizeValue("Core.UI.Render.RenderHelper::isDoubleToken", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$tokens = (new Vector())->push("img")->push("meta")->push("input")->push("link")->push("br");
		if ($tokens->indexOf($tag_name) == -1){
			$__memorize_value = true;
			rtl::_memorizeSave("Core.UI.Render.RenderHelper::isDoubleToken", func_get_args(), $__memorize_value);
			return $__memorize_value;
		}
		$__memorize_value = false;
		rtl::_memorizeSave("Core.UI.Render.RenderHelper::isDoubleToken", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Retuns css hash 
	 * @param string component class name
	 * @return string hash
	 */
	static function getCssHash($s){
		$__memorize_value = rtl::_memorizeValue("Core.UI.Render.RenderHelper::getCssHash", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$sz = rs::strlen($s);
		$h = 0;
		for ($i = 0; $i < $sz; $i++){
			$ch = rs::ord(mb_substr($s, $i, 1));
			$h = ($h << 2) + ($h >> 14) + $ch & 65535;
		}
		$arr = "1234567890abcdef";
		$res = "";
		while ($h != 0){
			$c = $h & 15;
			$h = $h >> 4;
			$res .= mb_substr($arr, $c, 1);
		}
		$__memorize_value = $res;
		rtl::_memorizeSave("Core.UI.Render.RenderHelper::getCssHash", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Returns attrs
	 */
	static function getUIAttrs($ui){
		$attrs = new Map();
		if ($ui == null){
			return $attrs->toDict();
		}
		if ($ui->props == null){
			return $attrs->toDict();
		}
		$props = UIStruct::getAttrs($ui);
		$keys = $props->keys();
		for ($ki = 0; $ki < $keys->count(); $ki++){
			$key = $keys->item($ki);
			$item = $props->item($key);
			$value = "";
			if (rs::strlen($key) == 0){
				continue;
			}
			if ($key == "@style"){
				if ($item instanceof Dict){
					$key = "style";
					$value = $item->reduce(function ($res, $key, $value){
						return rtl::toString($res) . rtl::toString($key) . ":" . rtl::toString($value) . ";";
					}, "");
				}
				else {
					continue;
				}
			}
			else if ($item instanceof StringInterface){
				$value = rtl::toString($item);
			}
			else if (rtl::isString($item)){
				$value = rtl::toString($item);
			}
			if ($key == "@class"){
				$css_arr = rs::explode(" ", $value);
				$css_arr = $css_arr->map(function ($item) use (&$ui){
					return rtl::toString($item) . "-" . rtl::toString($ui->space);
				});
				$key = "class";
				$value = rs::implode(" ", $css_arr);
			}
			else if (mb_substr($key, 0, 1) == "@"){
				continue;
			}
			else if ($key == "dangerouslySetInnerHTML"){
				continue;
			}
			else if ($key == "defaultValue"){
				$key = "value";
			}
			else if ($key == "className"){
				$key = "class";
			}
			else if ($key == "selected"){
				if ($item == true){
					$value = "selected";
				}
				else if ($item == false){
					return ;
				}
				$value = "selected";
			}
			else if ($key == "checked"){
				if ($item == true){
					$value = "checked";
				}
				else if ($item == false){
					return ;
				}
				$value = "checked";
			}
			if ($value != ""){
				if ($attrs->has($key)){
					if ($key == "style"){
						$value = rtl::toString($attrs->item($key)) . "" . rtl::toString($value);
					}
					else {
						$value = rtl::toString($attrs->item($key)) . " " . rtl::toString($value);
					}
				}
				$attrs->set($key, $value);
			}
		}
		return $attrs;
	}
	/**
	 * Returns attrs
	 */
	static function getUIStringAttrs($ui){
		$attrs = static::getUIAttrs($ui);
		$attrs = $attrs->map(function ($key, $value){
			return rtl::toString($key) . "='" . rtl::toString($value) . "'";
		});
		return rs::implode(" ", $attrs->values());
	}
	/**
	 * Convert UI to string
	 */
	static function getUIStringVector($arr){
		if ($arr == null){
			return "";
		}
		$content = "";
		for ($i = 0; $i < $arr->count(); $i++){
			$content .= static::getUIString($arr->item($i));
		}
		return $content;
	}
	/**
	 * Convert UI to string
	 */
	static function getUIString($ui){
		if ($ui == null){
			return "";
		}
		if (UIStruct::isString($ui)){
			return $ui->content;
		}
		if (UIStruct::isComponent($ui)){
			$render = rtl::method($ui->name, "render");
			$res = $render(UIStruct::getModel($ui), $ui);
			if (!($res instanceof Collection)){
				$res = rtl::normalizeUIVector($res);
			}
			return static::getUIStringVector($res, $ui->name);
		}
		$attrs = static::getUIStringAttrs($ui);
		$content = "";
		if (static::isDoubleToken($ui->name)){
			$content = "<" . rtl::toString($ui->name) . rtl::toString(($attrs != "") ? (" " . rtl::toString($attrs)) : ("")) . ">";
			$content .= static::getUIStringVector($ui->children);
			$content .= "</" . rtl::toString($ui->name) . ">";
		}
		else {
			$content = "<" . rtl::toString($ui->name) . rtl::toString(($attrs != "") ? (" " . rtl::toString($attrs)) : ("")) . "/>";
		}
		return $content;
	}
	/**
	 * Add unique items to collection
	 * @param Collection<string> res
	 * @param Collection<string> items
	 * @return Collection<string>
	 */
	static function addUniqueItems($res, $items, $insert_first = false){
		if ($items == null){
			return $res;
		}
		$r = new Vector();
		for ($i = 0; $i < $items->count(); $i++){
			$item_name = $items->item($i);
			if ($res->indexOf($item_name) == -1){
				if ($insert_first){
					$r->unshift($item_name);
				}
				else {
					$r->push($item_name);
				}
			}
		}
		return $res->appendCollectionIm($r);
	}
	/**
	 * Returns required modules
	 * @param string class_name
	 * @return Collection<string>
	 */
	static function _getModules($res, $cache, $modules, $container){
		if ($modules == null){
			return ;
		}
		for ($i = 0; $i < $modules->count(); $i++){
			$module_name = $modules->item($i);
			$interfaces = RuntimeUtils::getInterfaces($module_name);
			$is_assets = $interfaces->indexOf("Core.Interfaces.AssetsInterface") != -1;
			$is_components = $interfaces->indexOf("Core.Interfaces.ComponentInterface") != -1;
			$is_module = $interfaces->indexOf("Runtime.Interfaces.ModuleDescriptionInterface") != -1;
			if (!($is_components || $is_assets || $is_module)){
				continue;
			}
			if ($cache->get($module_name, false) == false){
				$cache->set($module_name, true);
				if ($is_module){
					$sub_modules = rtl::method($module_name, "requiredModules")();
					if ($sub_modules != null){
						$sub_modules = $sub_modules->keys();
						$sub_modules = $sub_modules->map(function ($module_name){
							return rs::replace("/", ".", rtl::toString($module_name) . ".ModuleDescription");
						});
						static::_getModules($res, $cache, $sub_modules, $container);
					}
				}
				if ($is_assets || $is_components){
					$sub_assets = rtl::method($module_name, "assets")($container);
					if ($sub_assets != null){
						static::_getModules($res, $cache, $sub_assets, $container);
					}
				}
				$res->push($module_name);
			}
		}
	}
	/**
	 * Returns all assets and modules
	 * @param Collection<string> modules
	 * @return Collection<string>
	 */
	static function getModules($modules, $container){
		/* Add modules */
		$res = new Vector();
		$cache = new Map();
		static::_getModules($res, $cache, $modules, $container);
		$res = $res->removeDublicatesIm();
		return $res->toCollection();
	}
	/**
	 * Returns assets
	 * @param Collection<string> assets
	 * @return Collection<string>
	 */
	static function loadResources($assets){
		$__memorize_value = rtl::_memorizeValue("Core.UI.Render.RenderHelper::loadResources", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$res = new Collection();
		if ($assets == null){
			$__memorize_value = $res;
			rtl::_memorizeSave("Core.UI.Render.RenderHelper::loadResources", func_get_args(), $__memorize_value);
			return $__memorize_value;
		}
		for ($i = 0; $i < $assets->count(); $i++){
			$class_name = $assets->item($i);
			$interfaces = RuntimeUtils::getInterfaces($class_name);
			$is_assets = $interfaces->indexOf("Core.Interfaces.AssetsInterface") != -1;
			$is_components = $interfaces->indexOf("Core.Interfaces.ComponentInterface") != -1;
			$is_module = $interfaces->indexOf("Runtime.Interfaces.ModuleDescriptionInterface") != -1;
			if (!($is_components || $is_assets || $is_module)){
				continue;
			}
			$r = rtl::method($class_name, "getModuleFiles")(null);
			if ($r != null){
				$module_name = rtl::method($class_name, "getModuleName")();
				$pos = rs::strpos($module_name, "/");
				$parent_module_name = $module_name;
				if ($pos >= 0){
					$parent_module_name = rs::substr($module_name, 0, $pos);
				}
				$r = $r->map(function ($item) use (&$parent_module_name){
					if (rs::strpos($item, $parent_module_name) == 0){
						$item = rs::substr($item, rs::strlen($parent_module_name));
						$item = rs::replace(".", "/", $item);
					}
					return "@" . rtl::toString($parent_module_name) . "/es6" . rtl::toString($item) . ".js";
				});
				$res = static::addUniqueItems($res, $r);
			}
			if ($is_assets || $is_components){
				$r = rtl::method($class_name, "resources")(null);
				if ($r != null){
					$res = static::addUniqueItems($res, $r);
				}
			}
		}
		$__memorize_value = $res;
		rtl::_memorizeSave("Core.UI.Render.RenderHelper::loadResources", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Returns css string
	 * @param Collection<string> components
	 * @param Dict<string> css_vars
	 * @return string
	 */
	static function getCSSFromComponents($components, $css_vars){
		$__memorize_value = rtl::_memorizeValue("Core.UI.Render.RenderHelper::getCSSFromComponents", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$res = new Vector();
		for ($i = 0; $i < $components->count(); $i++){
			$component_name = $components->item($i);
			$view_name = rtl::method($component_name, "componentViewName")($css_vars);
			$css = rtl::method($view_name, "css")($css_vars);
			$res->push($css);
		}
		$s = $res->reduce(function ($res, $s){
			return rtl::toString($res) . rtl::toString($s);
		}, "");
		$__memorize_value = $s;
		rtl::_memorizeSave("Core.UI.Render.RenderHelper::getCSSFromComponents", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Init render container
	 * @param RenderContainer container
	 * @return RenderContainer
	 */
	static function initRenderContainer($container){
		return $container;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.UI.Render.RenderHelper";}
	public static function getCurrentNamespace(){return "Core.UI.Render";}
	public static function getCurrentClassName(){return "Core.UI.Render.RenderHelper";}
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