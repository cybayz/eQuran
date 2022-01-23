<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * User Model:
 *
 * @author Sadmi Siraj <cybayz@gmail.com>
 * @since 1.0.2
 */
class Course extends Core\Model {
    
    /** @var array The register form inputs. */
    private static $_inputs = [
        "coursename" => [
            "required" => true
        ],
        "courseduration" => [
            "required" => true
        ],
        "coursedescription" => [
            "required" => false
        ],
    ];

    /**
     * Register: Validates the register form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function add() {

        // Validate the register form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }
        try {
            $courseObj = new Course();
            $courseID = $courseObj->addCourse([
                "coursename" => Utility\Input::post("coursename"),
                "courseduration" => Utility\Input::post("courseduration"),
                "coursedescription" => Utility\Input::post("coursedescription")
            ]);
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "course/courselist");
            return $courseID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function addCourse($fields){
        if (!$courseID = $this->create("course", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $courseID;
    
    }
    
    public static function getCourseList(){
        $courseObj = new Course();
        $data = $courseObj->getcourses();
        return $data;
    }

    public function getcourses(){
        return($this->getfromdb("course"));
    }

    public static function deletecourse() {

        try {
            $courseObj = new Course();
            $courseID = $courseObj->deletefromdb([
                0 => "id",
                1 => "=",
                2 => Utility\Input::post("deletionId")
            ]);
            //Utility\Flash::success(Utility\Text::get("COURSE_DELETED"));
            Utility\Redirect::to(APP_URL . "course/courselist");
            return $courseID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function deletefromdb($where){
        if (!$userID = $this->delete("course", $where)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
    
    }
}
