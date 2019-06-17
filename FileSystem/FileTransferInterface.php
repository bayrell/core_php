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
interface FileTransferInterface{
	/**
	 * Returns files and folders from directory
	 * @param string path
	 * @return Collection<FileNode>
	 */
	static function getDirectoryListing();
	/**
	 * Returns files stat
	 * @param Collection<string> items
	 * @return Collection<FileStat>
	 */
	static function stat();
	/**
	 * Create new node
	 * @param string path
	 * @param string name
	 * @param string kind
	 * @return bool
	 */
	static function createNode();
	/**
	 * Clear file
	 * @param string path
	 * @return bool
	 */
	static function clearFile();
	/**
	 * Read file
	 * @param string path
	 * @param int offset
	 * @param int count
	 * @return FileIOResult
	 */
	static function readBlock();
	/**
	 * Write file
	 * @param string path
	 * @param Collection<byte> content
	 * @param int offset
	 * @return FileIOResult
	 */
	static function writeBlock();
}