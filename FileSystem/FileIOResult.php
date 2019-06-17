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
class FileIOResult extends CoreStruct{
	const KIND_READ_BINARY = "rb";
	const KIND_WRITE_BINARY = "wb";
	protected $__name;
	protected $__kind;
	protected $__content;
	protected $__bytes;
	protected $__offset;
	protected $__count;
	protected $__size;
	protected $__eof;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.FileSystem.FileIOResult";}
	public static function getCurrentNamespace(){return "Core.FileSystem";}
	public static function getCurrentClassName(){return "Core.FileSystem.FileIOResult";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	protected function _init(){
		parent::_init();
		$this->__name = "";
		$this->__kind = "";
		$this->__content = "";
		$this->__bytes = null;
		$this->__offset = 0;
		$this->__count = 0;
		$this->__size = 0;
		$this->__eof = false;
	}
	public function assignObject($obj){
		if ($obj instanceof FileIOResult){
			$this->__name = $obj->__name;
			$this->__kind = $obj->__kind;
			$this->__content = $obj->__content;
			$this->__bytes = $obj->__bytes;
			$this->__offset = $obj->__offset;
			$this->__count = $obj->__count;
			$this->__size = $obj->__size;
			$this->__eof = $obj->__eof;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "name")$this->__name = rtl::convert($value,"string","","");
		else if ($variable_name == "kind")$this->__kind = rtl::convert($value,"string","","");
		else if ($variable_name == "content")$this->__content = rtl::convert($value,"string","","");
		else if ($variable_name == "bytes")$this->__bytes = rtl::convert($value,"Runtime.Collection",null,"mixed");
		else if ($variable_name == "offset")$this->__offset = rtl::convert($value,"int",0,"");
		else if ($variable_name == "count")$this->__count = rtl::convert($value,"int",0,"");
		else if ($variable_name == "size")$this->__size = rtl::convert($value,"int",0,"");
		else if ($variable_name == "eof")$this->__eof = rtl::convert($value,"bool",false,"");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "name") return $this->__name;
		else if ($variable_name == "kind") return $this->__kind;
		else if ($variable_name == "content") return $this->__content;
		else if ($variable_name == "bytes") return $this->__bytes;
		else if ($variable_name == "offset") return $this->__offset;
		else if ($variable_name == "count") return $this->__count;
		else if ($variable_name == "size") return $this->__size;
		else if ($variable_name == "eof") return $this->__eof;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("name");
			$names->push("kind");
			$names->push("content");
			$names->push("bytes");
			$names->push("offset");
			$names->push("count");
			$names->push("size");
			$names->push("eof");
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