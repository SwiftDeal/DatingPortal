<?php
/**
* The admin controller which has highest privilege to manage the website
*
* @author Faizan Ayubi
*/
use Framework\Registry as Registry;
use Framework\RequestMethods as RequestMethods;
class Admin extends Users {
	/**
	* @readwrite
	*/
	protected $_employer;
	/**
	* Method which sets data stats for admin dashboard
	*
	* changeLayout
	*/
	public function index() {
		$this->changeLayout();
		$this->seo(array("title" => "Admin Panel", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
	}
	/**
	* Searchs for data and returns result from db
	* @param type $model the data model
	* @param type $property the property of modal
	* @param type $val the value of property
	* @before _secure, changeLayout
	*/
	public function search($model = NULL, $property = NULL, $val = 0, $page=1) {
		$this->seo(array("title" => "Search", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
		$model = RequestMethods::get("model", $model);
		$property = RequestMethods::get("key", $property);
		$val = RequestMethods::get("value", $val);
		$page = RequestMethods::get("page", $page);
		$sign = RequestMethods::get("sign", "equal");
		$view->set("items", array());
		$view->set("values", array());
		$view->set("model", $model);
		$view->set("page", $page);
		$view->set("property", $property);
		$view->set("val", $val);
		$view->set("sign", $sign);
		if ($model) {
		if($sign == "like"){
			$where = array("{$property} LIKE ?" => "%{$val}%");
		} else {
			$where = array("{$property} = ?" => $val);
		}
		$objects = $model::all($where,array("*"),"created", "desc", 10, $page);
		$count = $model::count($where);$i = 0;
		if ($objects) {
		foreach ($objects as $object) {
			$properties = $object->getJsonData();
			foreach ($properties as $key => $property) {
				$key = substr($key, 1);
				$items[$i][$key] = $property;
				$values[$i][] = $key;
			}
		$i++;
		}
		$view->set("items", $items);
		$view->set("values", $values[0]);
		$view->set("count", $count);
		//echo '<pre>', print_r($values[0]), '</pre>';
		$view->set("success", "Total Results : {$count}");
		} else {
			$view->set("success", "No Results Found");
		}
		}
	}
	/**
	* Shows any data info
	*
	* @before _secure, changeLayout
	* @param type $model the model to which shhow info
	* @param type $id the id of object model
	*/
	public function info($model = NULL, $id = NULL) {
		$this->seo(array("title" => "{$model} info", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
		$items = array();
		$values = array();
		$object = $model::first(array("id = ?" => $id));
		$properties = $object->getJsonData();
		foreach ($properties as $key => $property) {
			$key = substr($key, 1);
			if (strpos($key, "_id")) {
				$child = ucfirst(substr($key, 0, -3));
				$childobj = $child::first(array("id = ?" => $object->$key));
				$childproperties = $childobj->getJsonData();
				foreach ($childproperties as $k => $prop) {
					$k = substr($k, 1);
					$items[$k] = $prop;
					$values[] = $k;
				}
			} else {
				$items[$key] = $property;
				$values[] = $key;
			}
		}
		$view->set("items", $items);
		$view->set("values", $values);
		$view->set("model", $model);
	}
	/**
	* Updates any data provide with model and id
	*
	* @before _secure, changeLayout
	* @param type $model the model object to be updated
	* @param type $id the id of object
	*/
	public function update($model = NULL, $id = NULL) {
		$this->seo(array("title" => "Update", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
		$object = $model::first(array("id = ?" => $id));
		$vars = $object->columns;
		$array = array();
		foreach ($vars as $key => $value) {
			array_push($array, $key);
			$vars[$key] = htmlentities($object->$key);
		}
		if (RequestMethods::post("action") == "update") {
			foreach ($array as $field) {
				$object->$field = RequestMethods::post($field, $vars[$field]);
				$vars[$field] = htmlentities($object->$field);
			}
			$object->save();
			$view->set("success", true);
		}
		$view->set("vars", $vars);
		$view->set("array", $array);
		$view->set("model", $model);
		$view->set("id", $id);
	}
	/**
	* @before _secure, changeLayout
	*/
	public function stats() {
		$this->seo(array("title" => "Stats", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
		if (RequestMethods::get("action") == "getStats") {
			$startdate = RequestMethods::get("startdate");
			$enddate = RequestMethods::get("enddate");
			$property = ucfirst(RequestMethods::get("property"));
			$property_id = ucfirst(RequestMethods::get("property_id"));
			$diff = date_diff(date_create($startdate), date_create($enddate));
			for ($i = 0; $i < $diff->format("%a"); $i++) {
				$date = date('Y-m-d', strtotime($startdate . " +{$i} day"));
				$count = Stat::count(array("created = ?" => $date, "property = ?" => $property, "property_id = ?" => $property_id));
				$obj[] = array('y' => $date, 'a' => $count);
			}
			$view->set("data", \Framework\ArrayMethods::toObject($obj));
		}
	}
	/**
	* @before _secure, changeLayout
	*/
	public function data() {
		$this->seo(array("title" => "Data Analysis", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
		if (RequestMethods::get("action") == "dataAnalysis") {
			$startdate = RequestMethods::get("startdate");
			$enddate = RequestMethods::get("enddate");
			$model = ucfirst(RequestMethods::get("model"));
			$diff = date_diff(date_create($startdate), date_create($enddate));
			for ($i = 0; $i < $diff->format("%a"); $i++) {
				$date = date('Y-m-d', strtotime($startdate . " +{$i} day"));
				$count = $model::count(array("created LIKE ?" => "%{$date}%"));
				$obj[] = array('y' => $date, 'a' => $count);
			}
			$view->set("data", \Framework\ArrayMethods::toObject($obj));
		}
	}
	/**
	* @before _secure, changeLayout
	*/
	public function support() {
		$this->seo(array("title" => "Support Tickets", "keywords" => "admin", "description" => "admin", "view" => $this->getLayoutView()));
		$view = $this->getActionView();
		if (RequestMethods::post('action') == 'support') {
			$email = [RequestMethods::post('email')];
			$this->notify(array(
			"template" => "message",
			"subject" => RequestMethods::post('subject'),
			"emails" => [$email],
			"message" => RequestMethods::post("body")
			));
		}
		$inbox = Conversation::all(array("property = ?" => "email"), array("created", "property_id", "message_id"), "id", "desc");
		$allinbox = [];
		foreach ($inbox as $message) {
			$body = Message::first(array("id = ?" => $message->message_id), array("body", "subject"));
			$allinbox[] = [
			"id" => $message->message_id,
			"from" => $message->property_id,
			"subject" => $body->subject,
			"message" => $body->body,
			"received" => \Framework\StringMethods::datetime_to_text($message->created)
			];
		}
		$view->set("allinbox", \Framework\ArrayMethods::toObject($allinbox));
	}
	public function changeLayout() {
		$this->defaultLayout = "layouts/admin";
		$this->setLayout();
		}
	}