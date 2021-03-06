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

    public static function updatestudentjuzz() {

        try {

            $studentObj = new Student();
            $id         = Utility\Input::post("studentid");
            $studentID  = $studentObj->updateJuzz([
                "juzz"  => Utility\Input::post("juzz")
            ],$id);
            //Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "student/updatejuzz"); 
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

    public function updateJuzz($fields,$id){
        if (!$this->update("user", $fields, $id)) {
            throw new Exception(Utility\Text::get("USER_UPDATE_EXCEPTION"));
        }  
        return true; 
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

    public static function getStudentMarkById($studentId){
        $studentObj = new Student();
        $data = $studentObj->getstudentmarkdetailsbyid($studentId);
        return $data;
    }

    public static function getStudentAttendanceById($studentId){
        $studentObj = new Student();
        $filters = $_POST;
        $month = '';
        if(isset($filters['month'])&&$filters['month']>0){
            $month= " AND a.date  BETWEEN '".$filters['month']."-01' AND '".$filters['month']."-31' "." ";
        }
        $data = $studentObj->getstudentattendancedetailsbyid($studentId, $month);
        return $data;
    }
    public static function getTotalAbsent($studentId){
        $studentObj = new Student();
        $data = $studentObj->getTotalAbsentById($studentId);
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
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, t.name as teachername, 
                u.email, u.juzz, u.createddate, c.coursename, b.batchname, u.age, u.createddate 
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                LEFT JOIN teacher t ON t.id = u.teacherid 
                WHERE u.id = :studentId";
        $params = [":studentId" => $studentId];
        return($this->getfromdbusingselect($sql,$params));
    }

    public function getstudentmarkdetailsbyid($studentId){
        $sql = "SELECT u.id, m.mark, m.juzz
                FROM user u  
                INNER JOIN mark m 
                ON m.studentid=u.id 
                WHERE u.id = :studentId 
                ORDER BY m.juzz ";
        $params = [":studentId" => $studentId];
        return($this->getfromdbusingselect($sql,$params));
    }

    public function getstudentattendancedetailsbyid($studentId, $month){
        $sql = "SELECT u.id, a.status, a.date, DAY(a.date) as dateday   
                FROM user u  
                INNER JOIN attendance a 
                ON a.studentid=u.id 
                WHERE u.id = :studentId ";
                
        $sql= $sql.$month;
        $sql= $sql." ORDER BY a.date DESC ";
        $params = [":studentId" => $studentId];
        return($this->getfromdbusingselect($sql,$params));
    }
    
    public function getTotalAbsentById($studentId){
        $sql = "SELECT COUNT(id) AS totalabsent  
                FROM attendance 
                WHERE studentid= :studentId 
                AND status=0 ";
                
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

    public static function deletestudent() {

        try {
            $studentObj = new Student();
            $studentID = $studentObj->deletefromdb([
                0 => "id",
                1 => "=",
                2 => Utility\Input::post("deletionId")
            ]);
            //Utility\Flash::success(Utility\Text::get("COURSE_DELETED"));
            Utility\Redirect::to(APP_URL . "student/studentlist");
            return $studentID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function deletefromdb($where){
        if (!$userID = $this->delete("student", $where)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
    
    }
}
