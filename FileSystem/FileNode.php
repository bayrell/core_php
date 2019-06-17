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
namespace Core\FileSystem;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreStruct;
class FileNode extends CoreStruct{
	const KIND_FOLDER = "folder";
	const KIND_SYMLINK = "symlink";
	const KIND_FILE = "file";
	protected $__name;
	protected $__kind;
	protected $__items;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.FileSystem.FileNode";}
	public static function getCurrentNamespace(){return "Core.FileSystem";}
	public static function getCurrentClassName(){return "Core.FileSystem.FileNode";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__name = "";
		$this->__kind = "";
		$this->__items = null;
	}
	public function assignObject($obj){
		if ($obj instanceof FileNode){
			$this->__name = $obj->__name;
			$this->__kind = $obj->__kind;
			$this->__items = $obj->__items;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "name")$this->__name = rtl::convert($value,"string","","");
		else if ($variable_name == "kind")$this->__kind = rtl::convert($value,"string","","");
		else if ($variable_name == "items")$this->__items = rtl::convert($value,"Runtime.Collection",null,"Core.FileSystem.FileNode");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "name") return $this->__name;
		else if ($variable_name == "kind") return $this->__kind;
		else if ($variable_name == "items") return $this->__items;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("name");
			$names->push("kind");
			$names->push("items");
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