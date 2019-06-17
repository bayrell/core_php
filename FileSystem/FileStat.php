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
use Core\FileSystem\FileNode;
class FileStat extends FileNode{
	protected $__exists;
	protected $__mode;
	protected $__user;
	protected $__group;
	protected $__size;
	protected $__atime;
	protected $__ctime;
	protected $__mtime;
	protected $__mime;
	protected $__charset;
	protected $__download_url;
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.FileSystem.FileStat";}
	public static function getCurrentNamespace(){return "Core.FileSystem";}
	public static function getCurrentClassName(){return "Core.FileSystem.FileStat";}
	public static function getParentClassName(){return "Core.FileSystem.FileNode";}
	protected function _init(){
		parent::_init();
		$this->__exists = false;
		$this->__mode = "";
		$this->__user = "";
		$this->__group = "";
		$this->__size = 0;
		$this->__atime = 0;
		$this->__ctime = 0;
		$this->__mtime = 0;
		$this->__mime = "";
		$this->__charset = "";
		$this->__download_url = "";
	}
	public function assignObject($obj){
		if ($obj instanceof FileStat){
			$this->__exists = $obj->__exists;
			$this->__mode = $obj->__mode;
			$this->__user = $obj->__user;
			$this->__group = $obj->__group;
			$this->__size = $obj->__size;
			$this->__atime = $obj->__atime;
			$this->__ctime = $obj->__ctime;
			$this->__mtime = $obj->__mtime;
			$this->__mime = $obj->__mime;
			$this->__charset = $obj->__charset;
			$this->__download_url = $obj->__download_url;
		}
		parent::assignObject($obj);
	}
	public function assignValue($variable_name, $value, $sender = null){
		if ($variable_name == "exists")$this->__exists = rtl::convert($value,"bool",false,"");
		else if ($variable_name == "mode")$this->__mode = rtl::convert($value,"string","","");
		else if ($variable_name == "user")$this->__user = rtl::convert($value,"string","","");
		else if ($variable_name == "group")$this->__group = rtl::convert($value,"string","","");
		else if ($variable_name == "size")$this->__size = rtl::convert($value,"int",0,"");
		else if ($variable_name == "atime")$this->__atime = rtl::convert($value,"int",0,"");
		else if ($variable_name == "ctime")$this->__ctime = rtl::convert($value,"int",0,"");
		else if ($variable_name == "mtime")$this->__mtime = rtl::convert($value,"int",0,"");
		else if ($variable_name == "mime")$this->__mime = rtl::convert($value,"string","","");
		else if ($variable_name == "charset")$this->__charset = rtl::convert($value,"string","","");
		else if ($variable_name == "download_url")$this->__download_url = rtl::convert($value,"string","","");
		else parent::assignValue($variable_name, $value, $sender);
	}
	public function takeValue($variable_name, $default_value = null){
		if ($variable_name == "exists") return $this->__exists;
		else if ($variable_name == "mode") return $this->__mode;
		else if ($variable_name == "user") return $this->__user;
		else if ($variable_name == "group") return $this->__group;
		else if ($variable_name == "size") return $this->__size;
		else if ($variable_name == "atime") return $this->__atime;
		else if ($variable_name == "ctime") return $this->__ctime;
		else if ($variable_name == "mtime") return $this->__mtime;
		else if ($variable_name == "mime") return $this->__mime;
		else if ($variable_name == "charset") return $this->__charset;
		else if ($variable_name == "download_url") return $this->__download_url;
		return parent::takeValue($variable_name, $default_value);
	}
	public static function getFieldsList($names, $flag=0){
		if (($flag | 3)==3){
			$names->push("exists");
			$names->push("mode");
			$names->push("user");
			$names->push("group");
			$names->push("size");
			$names->push("atime");
			$names->push("ctime");
			$names->push("mtime");
			$names->push("mime");
			$names->push("charset");
			$names->push("download_url");
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