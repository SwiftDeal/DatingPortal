<?php

/**
 * The Default Example Controller Class
 *
 * @author Meraj Siddiqui <meraj@cloudstuffs.com>
 */
use Shared\Controller as Controller;
use Framework\Registry as Registry;
use Framework\RequestMethods as RequestMethods;

class Home extends Controller
{
    
    public function index() {
        $view = $this->getActionView();

        if (RequestMethods::post("register") == "truemodal") {
            $newuser = new User(array(
                "name" => RequestMethods::post("name"),
                "age" => RequestMethods::post("age"),
                "gender" => RequestMethods::post("gender"),
                "religion" => RequestMethods::post("religion"),
                "caste" => RequestMethods::post("caste"),
                "mobile" => RequestMethods::post("mobile"),
                "email" => RequestMethods::post("email"),
                "password" => sha1(RequestMethods::post("password"))));
            
            $newuser->save();
            $this->setUser($newuser);
            self::redirect("/users/myaccount");
        }
        if (RequestMethods::post("login") == "true_modal") {
            $email = RequestMethods::post("email");
            $password = sha1(RequestMethods::post("password"));
            
            $user = User::first(array("email = ?" => $email, "password = ?" => $password));
            
            if (isset($user)){
                $this->setUser($user);
                self::redirect("/users/myaccount");
            } else {
                $view->set("success", "Incorrect email or password");
            }

        }
        
        if(RequestMethods::post("register")=="home")
        {
            $password = $this->generateStrongPassword();
            $newUser = new User(array(
                "name"=>RequestMethods::post("name"),
                "age"=>RequestMethods::post("age"),
                "gender"=>RequestMethods::post("gender"),
                "religion"=> RequestMethods::post("religion"),
                "caste"=>RequestMethods::post("caste"),
                "phone"=>RequestMethods::post("phone"),
                "email"=>RequestMethods::post("email"),
                "password"=> sha1($password)
                ));
            if($newUser->save()){
                //mail the paswword to users email ID
                $vie->set("alert", "Your password has been mailed to you... Check Your email");
            }       
        }
    }
    public function contact() {
    }
    public function about() {
    }

    protected function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
        {
            $sets = array();
            if(strpos($available_sets, 'l') !== false)
                $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            if(strpos($available_sets, 'u') !== false)
                $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
            if(strpos($available_sets, 'd') !== false)
                $sets[] = '23456789';
            if(strpos($available_sets, 's') !== false)
                $sets[] = '!@#$%&*?';
            $all = '';
            $password = '';
            foreach($sets as $set)
            {
                $password .= $set[array_rand(str_split($set))];
                $all .= $set;
            }
            $all = str_split($all);
            for($i = 0; $i < $length - count($sets); $i++)
                $password .= $all[array_rand($all)];
            $password = str_shuffle($password);
            if(!$add_dashes)
                return $password;
            $dash_len = floor(sqrt($length));
            $dash_str = '';
            while(strlen($password) > $dash_len)
            {
                $dash_str .= substr($password, 0, $dash_len) . '-';
                $password = substr($password, $dash_len);
            }
            $dash_str .= $password;
            return $dash_str;
        }
}


