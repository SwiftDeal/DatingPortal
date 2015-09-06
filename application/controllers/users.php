<?php

/**
 * The Default Example Controller Class
 *
 * @author Cloudstuffs Team
 */
use Shared\Controller as Controller;
use Framework\RequestMethods as RequestMethods;

class Users extends Controller {

    public function index() {

	if(RequestMethods::post("psearch")=="search"){
		$gender = RequestMethods::post("gender");
		$religion =RequestMethods::post("religion");
		$caste = RequestMethods::post("caste");
		$age_b = RequestMethods::post("age_b");
		$age_l = RequestMethods::post("age_l");

	$search_result = User::all("genedr=?"=>$gender, "religion =?"=>$religion, "caste =?"=>$caste, "age >"=>$age_b ,"age <"=>$age_l );
	}
	if(RequestMethods::get("psearch")=="search"){
		$gender = RequestMethods::post("gender");
		$religion =RequestMethods::post("religion");
		$age_b = RequestMethods::post("age_b");
		$age_l = RequestMethods::post("age_l");

	$search_result = User::all("genedr=?"=>$gender, "religion =?"=>$religion, "age >"=>$age_b ,"age <"=>$age_l );
	}
        
    }
    public function profile() {
        
    }
    public function myaccount() {
        
    }

}
