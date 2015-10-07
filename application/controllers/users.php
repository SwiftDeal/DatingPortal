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
    	
    	$view = $this->getActionView();
	if(RequestMethods::post("psearch")=="search"){
		$gender = RequestMethods::post("gender");
		$religion =RequestMethods::post("religion");
		$age_b = RequestMethods::post("age_b");
		$age_l = RequestMethods::post("age_l");

	$search_result = User::all(array("gender = ?"=>$gender, "religion = ?"=>$religion, "age > ?"=>$age_b ,"age < ?"=>$age_l ));
	$view->set("profiles", $search_result);
	}
	if(RequestMethods::get("psearch")=="search"){
		$gender = RequestMethods::post("gender");
		$religion =RequestMethods::post("religion");
		$age_b = RequestMethods::post("age_b");
		$age_l = RequestMethods::post("age_l");

	$search_result = User::all(array("genedr=?"=>$gender, "religion =?"=>$religion, "age >"=>$age_b ,"age <"=>$age_l ));
	}
        
    }
    public function profile() {
    	$view = $this->getActionView();
        if(!empty(RequestMethods::get("user_id"))){
        	$id = base64_decode(RequestMethods::get("user_id"));
        	$user = User::first(array("id = ?"=>$id));
        	if($user){
        		$view->set("profile", $user);
        	}else{
        		$view->set("warning", "No profile found");
        	}
        }
    }
    /**
    *
    *@before _secure
    */
    public function myaccount() {
        if(RequestMethods::post("update_info")=="update_info") {
            $summary = RequestMethods::post("self_summary");
            $favorites = RequestMethods::post("favourites");
            $ncompromise= RequestMethods::post("ncompromise");
            $fmembers = RequestMethods::post("fmembers");
            $familytype= RequestMethods::post("family");
            $status = RequestMethods::post("status");
            $smoking = RequestMethods::post("smoking");
            $drinking = RequestMethods::post("drinking");
            $languages = RequestMethods::post("languages");
            $height = RequestMethods::post("height");
            $weight = RequestMethods::post("weight");
            $rashi = RequestMethods::post("rashi");
            $profession = RequestMethods::post("profession");
            $qualification = RequestMethods::post("qualification");
            $jobstatus = RequestMethods::post("job_status");

            $profile = new UserProfile(array(
                "user_id"=>$this->user->id,
                "self_summary"=>$summary,
                "favourites" =>$favorites,
                "ncompromise"=>$ncompromise,
                "family_members"=>$fmembers,
                "ftype"=>$familytype,
                "status"=>$status,
                "smoke"=>$smoking,
                "drink"=>$drinking,
                "language"=>$languages,
                "height"=>$height,
                "weight"=>$weight,
                "rashi"=>$rashi,
                "profession"=>$profession,
                "qualification"=>$qualification,
                "job_status"=>$jobstatus
                ));

           if($profile->save()){
		$vie->set("alert", "Data updated succefully");
		}       
	 }
    }

}
