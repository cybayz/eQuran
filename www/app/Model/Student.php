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
class Student extends Core\Model {
    
    /** @var array The register form inputs. */
    private static $_inputs = [
        "batch" => [
            "required" => true
        ],
        "course" => [
            "required" => true
        ],
        "mobile" => [
            "required" => true
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
            $studentObj = new Student();
            $studentID = $studentObj->addStudent([
                "firstname" => Utility\Input::post("firstname"),
                "lastname"  => Utility\Input::post("lastname"),
                "mobile"    => Utility\Input::post("mobile"),
                "address"   => Utility\Input::post("address"),
                "email"     => Utility\Input::post("email"),
                "courseid"  => Utility\Input::post("course"),
                "batchid"   => Utility\Input::post("batch"),
                "age"       => Utility\Input::post("age"),
                "teacherid" => Utility\Input::post("teacher")
            ]);
            //Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "student/studentlist");
            return $studentID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }


    public function addStudent($fields){
        if (!$batchID = $this->create("user", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $batchID;
    
    }
    
    public static function getBatchList(){
        $batchObj = new Batch();
        $data = $batchObj->getbatches();
        return $data;
    }
    
    public static function getStudentList(){
        $studentObj = new Student();
        $data = $studentObj->getstudents();
        return $data;
    
    }
    public static function getStudentById($studentId){
        $studentObj = new Student();
        $data = $studentObj->getstudentdetailsbyid($studentId);
        return $data;
    }

    public function getbatches(){
        return($this->getfromdb("batch"));
    }
    
    public function getstudents(){
        $remove_admin = [
            0 => "isadmin",
            1 => "=",
            2 => "0"
        ];
        return($this->getfromdb("user",$remove_admin));
    }

    public function getstudentdetailsbyid($studentId){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, u.email, u.juzz, u.createddate, c.coursename, b.batchname 
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                WHERE u.id = :studentId";
        $params = [":studentId" => $studentId];
        return($this->getfromdbusingselect($sql,$params));
    }

    public static function getBatchListByCourse($courseID){
        $batchObj = new Batch();
        $data = $batchObj->getbatchesbycourseid($courseID);
        return $data;
    }

    public function getbatchesbycourseid($courseID){
        $where = [
            0 => "courseid",
            1 => "=",
            2 => $courseID
        ];
        return($this->getfromdb("batch",$where));
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
