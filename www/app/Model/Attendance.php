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
class Attendance extends Core\Model {
    
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
            $studentIds = explode (",", Utility\Input::post("absentstudent")); 
            $attendanceObj = new Attendance();
            foreach($studentIds as $studentId){
                $attendanceID = $attendanceObj->addAttendance([
                    "studentid" => $studentId,
                    "status" => "0",
                    "date" => Utility\Input::post("date")
                ]);
            }
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "attendance/monthlybatchattendance");
            return $attendanceID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function addAttendance($fields){
        if (!$attendanceID = $this->create("attendance", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $attendanceID;
    
    }

    public static function getStudentList(){
        $attendanceObj = new Attendance();
        $filters = $_POST;
        $data = $attendanceObj->getstudents($filters);
        return $data;
    
    }

    public function getstudents($filters){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.courseid, u.batchid
                FROM user u  
                WHERE isadmin = 0 
                 ";

        $params = [];

        if(isset($filters['course'])&& $filters['course']>0){
            $sql = $sql." AND u.courseid = ".$filters['course']." ";
        }
        if(isset($filters['batch'])&& $filters['batch']>0){
            $sql = $sql." AND u.batchid = ".$filters['batch']." ";
        }

        $sql = $sql." GROUP BY u.id ";

        return($this->getfromdbusingselect($sql,$params));
    }
    
    public static function getAttendanceList(){
        $attendanceObj = new Attendance();
        $filters = $_POST;
        $data = $attendanceObj->getAttendance($filters);
        return $data;
    
    }

    public function getAttendance($filters){
        $sql = "SELECT a.id, a.studentid, a.date, a.status, DAY(a.date) as dateday  
                FROM attendance a
                WHERE a.id > 0
                 ";

        $params = [];

        if(isset($filters['month'])&& $filters['month']>0){
            $sql = $sql." AND a.date  BETWEEN '".$filters['month']."-01' AND '".$filters['month']."-31' "." ";
        }

        return($this->getfromdbusingselect($sql,$params));
    }
    
}
