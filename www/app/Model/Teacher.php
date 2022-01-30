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
class Teacher extends Core\Model {
    
    /** @var array The register form inputs. */
    private static $_inputs = [
        
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
            $teacherObj = new Teacher();
            $teacherID = $teacherObj->addTeacher([
                "name" => Utility\Input::post("teachername"),
                "qualification" => Utility\Input::post("qualification"),
                "mobile" => Utility\Input::post("mobile")
            ]);
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "teacher/teacherlist");
            return $teacherID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function addTeacher($fields){
        if (!$teacherID = $this->create("teacher", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $teacherID;
    
    }
    
    public static function getTeacherList(){
        $teacherObj = new Teacher();
        $data = $teacherObj->getteachers();
        return $data;
    }

    public function getteachers(){
        return($this->getfromdb("teacher"));
    }

    public static function getStudentByTeacherId($studentId){
        $teacherObj = new Teacher();
        $data = $teacherObj->getstudentdetailsbyid($studentId);
        return $data;
    }

    public function getstudentdetailsbyid($teacherID){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, u.email, u.juzz, u.createddate, c.coursename, b.batchname, t.name 
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                LEFT JOIN teacher t ON t.id = u.teacherid 
                WHERE u.teacherid = :teacherId";
        $params = [":teacherId" => $teacherID];
        return($this->getfromdbusingselect($sql,$params));
    }

    
}
