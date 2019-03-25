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
namespace RuntimeUI;
use Runtime\rs;
use Runtime\rtl;
use Runtime\Map;
use Runtime\Vector;
use Runtime\Dict;
use Runtime\Collection;
use Runtime\IntrospectionInfo;
use Runtime\UIStruct;
use RuntimeUI\Interfaces\AssetsInterface;
use RuntimeUI\Render\RenderContainer;
class Assets implements AssetsInterface{
	/**
	 * Returns required assets
	 * @return Map<string, string>
	 */
	static function getRequiredAssets($context){
		return (new Vector());
	}
	/**
	 * Returns sync loaded files
	 */
	static function assetsSyncLoad($context){
		return (new Vector());
	}
	/**
	 * Returns async loaded files
	 */
	static function assetsAsyncLoad($context){
		return (new Vector())->push((new Vector())->push("/assets/bayrell-runtime-es6/rs.js")->push("/assets/bayrell-runtime-es6/re.js")->push("/assets/bayrell-runtime-es6/rtl.js")->push("/assets/bayrell-runtime-es6/Collection.js")->push("/assets/bayrell-runtime-es6/Container.js")->push("/assets/bayrell-runtime-es6/CoreObject.js")->push("/assets/bayrell-runtime-es6/Dict.js")->push("/assets/bayrell-runtime-es6/Emitter.js")->push("/assets/bayrell-runtime-es6/RuntimeConstant.js")->push("/assets/bayrell-runtime-es6/RuntimeUtils.js")->push("/assets/bayrell-runtime-es6/Exceptions/RuntimeException.js")->push("/assets/bayrell-runtime-es6/Interfaces/CloneableInterface.js")->push("/assets/bayrell-runtime-es6/Interfaces/ContextInterface.js")->push("/assets/bayrell-runtime-es6/Interfaces/FactoryInterface.js")->push("/assets/bayrell-runtime-es6/Interfaces/ModuleDescriptionInterface.js")->push("/assets/bayrell-runtime-es6/Interfaces/SerializeInterface.js")->push("/assets/bayrell-runtime-es6/Interfaces/StringInterface.js")->push("/assets/bayrell-runtime-es6/Interfaces/SubscribeInterface.js"))->push((new Vector())->push("/assets/bayrell-runtime-es6/AsyncTask.js")->push("/assets/bayrell-runtime-es6/AsyncThread.js")->push("/assets/bayrell-runtime-es6/Context.js")->push("/assets/bayrell-runtime-es6/ContextObject.js")->push("/assets/bayrell-runtime-es6/CoreStruct.js")->push("/assets/bayrell-runtime-es6/CoreEvent.js")->push("/assets/bayrell-runtime-es6/Map.js")->push("/assets/bayrell-runtime-es6/Maybe.js")->push("/assets/bayrell-runtime-es6/ModuleDescription.js")->push("/assets/bayrell-runtime-es6/Reference.js")->push("/assets/bayrell-runtime-es6/Vector.js")->push("/assets/bayrell-runtime-es6/Exceptions/IndexOutOfRange.js")->push("/assets/bayrell-runtime-es6/Exceptions/KeyNotFound.js")->push("/assets/bayrell-runtime-es6/Exceptions/UnknownError.js"))->push((new Vector())->push("/assets/bayrell-runtime-es6/DateTime.js")->push("/assets/bayrell-runtime-es6/IntrospectionInfo.js")->push("/assets/bayrell-runtime-es6/UIStruct.js")->push("/assets/bayrell-runtime-es6/VectorStruct.js"))->push((new Vector())->push("/assets/bayrell-runtime-ui-es6/UIController.js")->push("/assets/bayrell-runtime-ui-es6/Annotations/ControllerAnnotation.js")->push("/assets/bayrell-runtime-ui-es6/Annotations/RouteInfo.js")->push("/assets/bayrell-runtime-ui-es6/Events/CommandEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/ComponentEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/ModelChange.js")->push("/assets/bayrell-runtime-ui-es6/Events/MountEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/UpdateStateEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/UserEvent/UserEvent.js")->push("/assets/bayrell-runtime-ui-es6/Http/ApiRequest.js")->push("/assets/bayrell-runtime-ui-es6/Http/ApiResult.js")->push("/assets/bayrell-runtime-ui-es6/Http/Cookie.js")->push("/assets/bayrell-runtime-ui-es6/Http/Request.js")->push("/assets/bayrell-runtime-ui-es6/Http/Response.js")->push("/assets/bayrell-runtime-ui-es6/Interfaces/ApiDeclaringInterface.js")->push("/assets/bayrell-runtime-ui-es6/Interfaces/AssetsInterface.js")->push("/assets/bayrell-runtime-ui-es6/Interfaces/FrontendInterface.js")->push("/assets/bayrell-runtime-ui-es6/Interfaces/RoutesDeclaringInterface.js")->push("/assets/bayrell-runtime-ui-es6/Interfaces/RoutesInterface.js")->push("/assets/bayrell-runtime-ui-es6/Render/CoreManager.js")->push("/assets/bayrell-runtime-ui-es6/Render/CoreRoute.js")->push("/assets/bayrell-runtime-ui-es6/Render/CoreView.js")->push("/assets/bayrell-runtime-ui-es6/Render/RenderContainer.js")->push("/assets/bayrell-runtime-ui-es6/Render/RenderHelper.js")->push("/assets/bayrell-runtime-ui-es6/Render/WebContainer.js"))->push((new Vector())->push("/assets/bayrell-runtime-ui-es6/Assets.js")->push("/assets/bayrell-runtime-ui-es6/Animations/FadeIn.js")->push("/assets/bayrell-runtime-ui-es6/Animations/FadeOut.js")->push("/assets/bayrell-runtime-ui-es6/Annotations/BindModel.js")->push("/assets/bayrell-runtime-ui-es6/Annotations/BindValue.js")->push("/assets/bayrell-runtime-ui-es6/Annotations/Event.js")->push("/assets/bayrell-runtime-ui-es6/Events/KeyboardEvent/KeyboardEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/UserEvent/BlurEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/UserEvent/ChangeEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/UserEvent/FocusEvent.js")->push("/assets/bayrell-runtime-ui-es6/Http/JsonResponse.js")->push("/assets/bayrell-runtime-ui-es6/Render/CoreLayout.js"))->push((new Vector())->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseClickEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseDoubleClickEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseDownEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseEnterEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseLeaveEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseMoveEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseOutEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseOverEvent.js")->push("/assets/bayrell-runtime-ui-es6/Events/MouseEvent/MouseUpEvent.js"));
	}
	/**
	 * Init render container
	 */
	static function initContainer($container){
		return $container;
	}
	/* ======================= Class Init Functions ======================= */
	public function getClassName(){return "RuntimeUI.Assets";}
	public static function getCurrentClassName(){return "RuntimeUI.Assets";}
	public static function getParentClassName(){return "";}
}