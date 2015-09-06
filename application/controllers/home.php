<?php

/**
 * The Default Example Controller Class
 *
 * @author Cloudstuffs Team
 */
use Shared\Controller as Controller;
use Framework\Registry as Registry;
use Framework\RequestMethods as RequestMethods;

class Home extends Controller
{
    
    public function index() {
        $view = $this->getActionView();
        if (RequestMethods::post("register") == "truemodal") {
            $newuser = new User(array("name" => RequestMethods::post("name"), "age" => RequestMethods::post("age"), "gender" => RequestMethods::post("gender"), "religion" => RequestMethods::post("religion"), "caste" => RequestMethods::post("caste"), "mobile" => RequestMethods::post("mobile"), "email" => RequestMethods::post("email"), "password" => sha1(RequestMethods::post("password"))));
            
            $newuser->save();
            $session = Registry::get("session");
            $session->set("user", $newuser);
            self::redirect("/users/myaccount");
        }
        if (RequestMethods::post("login") == "true_modal") {
            $email = RequestMethods::post("email");
            $password = sha1(RequestMethods::post("password"));
            
            $user = User::first(array("email =?" => $email, "password=?" => $password));
            
            if (isset($user)) {
                $this->setUser($user);
                $session = Registry::get("session");
                $session->set("user", $user);
                self::redirect("/users/myaccount");
            } 
            else {
                $view->set("success", "Incorrect email or password");
            }
        }
    }
    public function contact() {
    }
}

/*
$model = new User();
$db = Registry::get("database");
$db->sync($model);
*/
