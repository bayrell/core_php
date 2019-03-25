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
use Runtime\Interfaces\StringInterface;
use RuntimeUI\Render\RenderContainer;
class RenderHelper{
	/**
	 * Render class with data
	 */
	static function render($class_name, $data){
		$st = null;
		if ($data instanceof CoreStruct){
			$st = new UIStruct((new Map())->set("name", $class_name)->set("kind", UIStruct::TYPE_COMPONENT)->set("model", $data));
		}
		else {
			$st = new UIStruct((new Map())->set("name", $class_name)->set("kind", UIStruct::TYPE_COMPONENT)->set("props", $data));
		}
		return RenderHelper::getUIString($st);
	}
	/**
	 * Returns if tag name is double token
	 */
	static function isDoubleToken($tag_name){
		$__memorize_value = rtl::_memorizeValue("RuntimeUI.Render.RenderHelper::isDoubleToken", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$tokens = (new Vector())->push("img")->push("meta")->push("input")->push("link")->push("br");
		if ($tokens->indexOf($tag_name) == -1){
			$__memorize_value = true;
			rtl::_memorizeSave("RuntimeUI.Render.RenderHelper::isDoubleToken", func_get_args(), $__memorize_value);
			return $__memorize_value;
		}
		$__memorize_value = false;
		rtl::_memorizeSave("RuntimeUI.Render.RenderHelper::isDoubleToken", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Retuns css hash 
	 * @param string component class name
	 * @return string hash
	 */
	static function getCssHash($s){
		$__memorize_value = rtl::_memorizeValue("RuntimeUI.Render.RenderHelper::getCssHash", func_get_args());
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
		rtl::_memorizeSave("RuntimeUI.Render.RenderHelper::getCssHash", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Returns attrs
	 */
	static function getUIAttrs($st){
		$attrs = new Map();
		if ($st == null){
			return $attrs->toDict();
		}
		if ($st->props == null){
			return $attrs->toDict();
		}
		$props = UIStruct::getAttrs($st);
		$keys = $props->keys();
		for ($ki = 0; $ki < $keys->count(); $ki++){
			$key = $keys->item($ki);
			$item = $props->item($key);
			$value = "";
			if (rs::strlen($key) == 0){
				continue;
			}
			if ($key == "style" && $item instanceof Map){
				$value = $item->reduce(function ($res, $key, $value){
					return rtl::toString($res) . rtl::toString($key) . ":" . rtl::toString($value) . ";";
				}, "");
			}
			else if ($item instanceof StringInterface){
				$value = rtl::toString($item);
			}
			else if (rtl::isString($item)){
				$value = rtl::toString($item);
			}
			if ($key == "@class"){
				$css_arr = rs::explode(" ", $value);
				$css_arr = $css_arr->map(function ($item) use (&$st){
					return rtl::toString($item) . "-" . rtl::toString($st->space);
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
					$value = rtl::toString($attrs->item($key)) . " " . rtl::toString($value);
				}
				$attrs->set($key, $value);
			}
		}
		return $attrs;
	}
	/**
	 * Returns attrs
	 */
	static function getUIStringAttrs($st){
		$attrs = static::getUIAttrs($st);
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
	static function getUIString($st){
		if ($st == null){
			return "";
		}
		if (UIStruct::isString($st)){
			return $st->content;
		}
		if (UIStruct::isComponent($st)){
			$render = rtl::method($st->name, "render");
			$res = $render(UIStruct::getModel($st));
			if (!($res instanceof Collection)){
				$res = rtl::normalizeUIVector($res);
			}
			return static::getUIStringVector($res, $st->name);
		}
		$attrs = static::getUIStringAttrs($st);
		$content = "";
		if (static::isDoubleToken($st->name)){
			$content = "<" . rtl::toString($st->name) . rtl::toString(($attrs != "") ? (" " . rtl::toString($attrs)) : ("")) . ">";
			$content .= static::getUIStringVector($st->children);
			$content .= "</" . rtl::toString($st->name) . ">";
		}
		else {
			$content = "<" . rtl::toString($st->name) . rtl::toString(($attrs != "") ? (" " . rtl::toString($attrs)) : ("")) . "/>";
		}
		return $content;
	}
	/**
	 * Add unique items to collection
	 * @param Collection<string> res
	 * @param Collection<string> items
	 * @return Collection<string>
	 */
	static function addUniqueItems($res, $items){
		$r = new Vector();
		for ($i = 0; $i < $items->count(); $i++){
			$item_name = $items->item($i);
			if ($res->indexOf($item_name) == -1){
				$r->push($item_name);
			}
		}
		return $res->appendCollectionIm($r);
	}
	/**
	 * Returns all components
	 * @param Collection<string> views
	 * @return Collection<string>
	 */
	static function getAllComponents($views){
		/* Add components from views */
		$res = new Collection($views);
		/* Add require components */
		$w = null;
		while ($w != $res){
			$w = $res;
			for ($i = 0; $i < $w->count(); $i++){
				$class_name = $w->item($i);
				$components = rtl::method($class_name, "components")();
				$res = static::addUniqueItems($res, $components);
			}
		}
		return $res;
	}
	/**
	 * Returns assets by views
	 * @param Collection<string> views
	 * @return Collection<string>
	 */
	static function loadAssetsFromComponents($components, $container = null){
		/* Add assets from components */
		$res = new Collection();
		if ($components == null){
			return $res;
		}
		for ($i = 0; $i < $components->count(); $i++){
			$class_name = $components->item($i);
			$assets = rtl::method($class_name, "assets")();
			$res = static::addUniqueItems($res, $assets);
		}
		/* Add require assets */
		$w = null;
		while ($w != $res){
			$w = $res;
			for ($i = 0; $i < $w->count(); $i++){
				$class_name = $w->item($i);
				$assets = rtl::method($class_name, "getRequiredAssets")($container);
				$res = static::addUniqueItems($res, $assets);
			}
		}
		return $res;
	}
	/**
	 * Returns assets
	 * @param Collection<string> assets
	 * @return Collection<string>
	 */
	static function loadAsyncResources($assets){
		$__memorize_value = rtl::_memorizeValue("RuntimeUI.Render.RenderHelper::loadAsyncResources", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$res = new Collection();
		if ($assets == null){
			$__memorize_value = $res;
			rtl::_memorizeSave("RuntimeUI.Render.RenderHelper::loadAsyncResources", func_get_args(), $__memorize_value);
			return $__memorize_value;
		}
		for ($i = 0; $i < $assets->count(); $i++){
			$assets_name = $assets->item($i);
			$r = rtl::method($assets_name, "assetsAsyncLoad")(null);
			for ($j = 0; $j < $r->count(); $j++){
				$arr = $r->item($j);
				$res = static::addUniqueItems($res, $arr);
			}
		}
		$__memorize_value = $res;
		rtl::_memorizeSave("RuntimeUI.Render.RenderHelper::loadAsyncResources", func_get_args(), $__memorize_value);
		return $__memorize_value;
	}
	/**
	 * Returns css string
	 * @param Collection<string> components
	 * @param Dict<string> css_vars
	 * @return string
	 */
	static function getCSSFromComponents($components, $css_vars){
		$__memorize_value = rtl::_memorizeValue("RuntimeUI.Render.RenderHelper::getCSSFromComponents", func_get_args());
		if ($__memorize_value != rtl::$_memorize_not_found) return $__memorize_value;
		$res = new Vector();
		for ($i = 0; $i < $components->count(); $i++){
			$component_name = $components->item($i);
			$css = rtl::method($component_name, "css")($css_vars);
			$res->push($css);
		}
		$s = $res->reduce(function ($res, $s){
			return rtl::toString($res) . rtl::toString($s);
		}, "");
		$__memorize_value = $s;
		rtl::_memorizeSave("RuntimeUI.Render.RenderHelper::getCSSFromComponents", func_get_args(), $__memorize_value);
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
	public function getClassName(){return "RuntimeUI.Render.RenderHelper";}
	public static function getCurrentClassName(){return "RuntimeUI.Render.RenderHelper";}
	public static function getParentClassName(){return "";}
}