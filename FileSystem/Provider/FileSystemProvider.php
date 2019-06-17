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
namespace Core\FileSystem\Provider;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use Runtime\CoreStruct;
use Core\FileSystem\FileIOResult;
use Core\FileSystem\FileNode;
use Core\FileSystem\FileSystemInterface;
class FileSystemProvider extends CoreStruct{
	/**
	 * Init FileSystemProvider
	 */
	static function init($context, $provider){
		return $provider;
	}
	/**
	 * Returns files and folders from directory
	 * @param string basedir
	 * @return Vector<string> res - Result
	 */
	static function getDirectoryListing($context, $fs, $basedir = ""){
		
		$arr = scandir($basedir, SCANDIR_SORT_ASCENDING);
		if ($arr == false) $arr = [];
		$res = new Vector();
		$res->_assignArr($arr);
		$res->removeValue(".");
		$res->removeValue("..");
		return $res;
	}
	/**
	 * Returns recursive files and folders from directory
	 * @param string basedir
	 * @param Vector<string> res - Result
	 */
	static function readDirectoryRecursive($context, $fs, $basedir = ""){
		$res = new Vector();
		$arr = $this->getDirectoryListing($basedir);
		$arr->each(function ($path) use (&$res, &$basedir){
			$path = rtl::toString($basedir) . "/" . rtl::toString($path);
			$res->push($path);
			if ($this->isDir($path)){
				$res->appendVector($this->getDirectoryListing($path));
			}
		});
		return $res;
	}
	/**
	 * Returns recursive only files from directory
	 * @param string basedir
	 * @param Vector<string> res - Result
	 */
	static function getFilesRecursive($context, $fs, $basedir = ""){
		$res = new Vector();
		$arr = $this->getDirectoryListing($basedir);
		$arr->each(function ($path) use (&$res, &$basedir){
			$path = rtl::toString($basedir) . "/" . rtl::toString($path);
			if ($this->isDir($path)){
				$res->appendVector($this->getFilesRecursive($path));
			}
			else {
				$res->push($path);
			}
		});
		return $res;
	}
	/**
	 * Returns content of the file
	 * @param string filepath
	 * @param string charset
	 * @return string
	 */
	static function readFile($context, $fs, $filepath = "", $charset = "utf8"){
		
		return file_get_contents($filepath);
		return "";
	}
	/**
	 * Save file content
	 * @param string filepath
	 * @param string content
	 * @param string charset
	 */
	static function saveFile($context, $fs, $filepath = "", $content = "", $charset = "utf8"){
		
		file_put_contents($filepath, $content);
	}
	/**
	 * Open file
	 * @param string filepath
	 * @param string mode
	 * @return FileInterface
	 */
	static function openFile($context, $fs, $filepath = "", $mode = ""){
	}
	/**
	 * Make dir
	 * @param string dirpath
	 * @param boolean create_parent. Default is true
	 */
	static function fileExists($context, $fs, $filepath = ""){
		
		return file_exists($filepath);
	}
	/**
	 * Make dir
	 * @param string dirpath
	 * @param boolean create_parent. Default is true
	 */
	static function makeDir($context, $fs, $dirpath = "", $create_parent = false){
		
		if (!file_exists($dirpath))
		{
			mkdir($dirpath, 0755, true);
		}
	}
	/**
	 * Return true if path is folder
	 * @param string path
	 * @param boolean 
	 */
	static function isDir($context, $fs, $path){
		
		return is_dir($path);
	}
	/**
	 * Return true if path is file
	 * @param string path
	 * @param boolean 
	 */
	static function isFile($context, $fs, $path){
		if (!$this->fileExists($path)){
			return false;
		}
		return !$this->isDir($path);
	}
	/**
	 * Create new node
	 * @param string filepath
	 * @param string kind
	 * @param Dict options
	 * @return bool
	 */
	static function createNode($context, $fs, $filepath, $kind, $options = null){
		$res = false;
		$clear = false;
		if ($options){
			$clear = $options->get("clear", false, "bool");
		}
		if ($kind == FileNode::KIND_FILE){
			
			$mode = "a";
			if ($clear) $mode = "w";
			$f = fopen($filepath, $mode);
			if ($f)
			{
				$res = true;
				fclose($f);
			}
		}
		if ($kind == FileNode::KIND_FOLDER){
			
			$res = @mkdir($filepath);
		}
		return $res;
	}
	/**
	 * Rename node
	 * @param string folderpath
	 * @param string old_name
	 * @param string new_name
	 * @return bool
	 */
	static function renameNode($context, $fs, $folderpath, $old_name, $new_nam){
		$res = false;
		
		$path = $folderpath . "/" . $old_name;
		if (!file_exists($path)) return false;
		
		$res = rename($folderpath . "/" . $old_name, $folderpath . "/" . $new_name);
		return $res;
	}
	/**
	 * Delete node
	 * @param string path
	 * @return bool
	 */
	static function deleteNode($context, $fs, $path){
		$res = false;
		
		if (!file_exists($path)) return false;
		$res = unlink($path);
		return $res;
	}
	/**
	 * Read string from file
	 * @param string filepath
	 * @param int offset
	 * @param int count
	 * @return FileIOResult
	 */
	static function readBlock($context, $fs, $filepath, $offset, $count = -1){
		$content = "";
		$bytes = null;
		$size = 0;
		$eof = true;
		if ($count == -1){
			$count = 1048576;
		}
		
		$f = fopen($filepath, "rb");
		if ($f)		
		{
			$size = filesize($filepath);
			fseek($f, $offset);
			$c = fread($f, $count); 
			$bytes = unpack("C*", $c);
			$bytes = Collection::create($bytes);
			$count = $bytes->count();
			$eof = feof($f);
			fclose($f);
		}
		return new FileIOResult((new Map())->set("kind", FileIOResult::KIND_READ_BINARY)->set("name", $filepath)->set("offset", $offset)->set("bytes", $bytes)->set("count", $count)->set("size", $size)->set("eof", $eof));
	}
	/**
	 * Read string from file
	 * @param string filepath
	 * @param int offset
	 * @param int count
	 * @return FileIOResult
	 */
	static function writeBlock($context, $fs, $filepath, $bytes, $offset, $count = -1){
		if ($count == -1){
			$count = 1048576;
		}
		
		$f = fopen($filepath, "cb+");
		if ($f)		
		{
			$arr = $bytes->_getArr();
			$sz = count($arr);
			if ($sz > $count) $arr = array_slice($arr, 0, $count);
			
			fseek($f, $offset);
			$count = count($arr);
			$content = pack("C*", ...$arr);
			/*var_dump($count);*/
			fwrite($f, $content);
			fclose($f);
		}
		return new FileIOResult((new Map())->set("kind", FileIOResult::KIND_WRITE_BINARY)->set("name", $filepath)->set("offset", $offset)->set("bytes", $bytes)->set("count", $count)->set("size", 0)->set("eof", false));
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "Core.FileSystem.Provider.FileSystemProvider";}
	public static function getCurrentNamespace(){return "Core.FileSystem.Provider";}
	public static function getCurrentClassName(){return "Core.FileSystem.Provider.FileSystemProvider";}
	public static function getParentClassName(){return "Runtime.CoreStruct";}
	public function assignObject($obj){
		if ($obj instanceof FileSystemProvider){
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