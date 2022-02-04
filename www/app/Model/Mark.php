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
class Mark extends Core\Model {

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
            $markObj = new Mark();
            $markID = $markObj->addMark([
                "studentid" => Utility\Input::post("studentid"),
                "courseid"  => Utility\Input::post("courseid"),
                "batchid"   => Utility\Input::post("batchid"),
                "mark"      => Utility\Input::post("mark"),
                "juzz"      => Utility\Input::post("juzz")
            ]);
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "mark/addmark");
            return $markID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function addMark($fields){

        if (!$courseID = $this->create("mark", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $courseID;
    
    }
    
    public static function getStudentList(){
        $markObj = new Mark();
        $filters = $_POST;
        $data = $markObj->getstudents($filters);
        return $data;
    
    }

    public function getstudents($filters){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, u.email, max(m.mark) as mark, 
                 u.juzz, u.createddate, c.coursename, b.batchname, t.name, u.courseid, u.batchid, u.teacherid   
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                LEFT JOIN teacher t ON t.id=u.teacherid 
                LEFT JOIN mark m ON u.id=m.studentid AND m.juzz=(u.juzz-1) 
                WHERE isadmin = 0 
                 ";

        $params = [];

        if(isset($filters['course'])&& $filters['course']>0){
            $sql = $sql." AND c.id = ".$filters['course']." ";
        }
        if(isset($filters['batch'])&& $filters['batch']>0){
            $sql = $sql." AND b.id = ".$filters['batch']." ";
        }
        if(isset($filters['teacher'])&& $filters['teacher']>0){
            $sql = $sql." AND t.id = ".$filters['teacher']." ";
        }

        $sql =$sql." GROUP BY u.id ";

        return($this->getfromdbusingselect($sql,$params));
    }
    
    
    public static function getMarkList(){
        $markObj = new Mark();
        $data = $markObj->getMarksList();
        return $data;
    
    }

    public function getMarksList(){
        $sql = "SELECT m.studentid, m.mark, m.juzz   
                FROM mark m 
                ORDER BY m.juzz ";

        $params = [];

        return($this->getfromdbusingselect($sql,$params));
    }
    
    public static function getStudentMarkList(){
        $markObj = new Mark();
        $data = $markObj->getStudentsMarkList();
        return $data;
    
    }

    public function getStudentsMarkList(){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile    
                FROM user u  
                INNER JOIN mark m ON u.id = m.studentid 
                WHERE u.isadmin = 0 
                GROUP BY u.id ";

        $params = [];

        return($this->getfromdbusingselect($sql,$params));
    }

    public static function getstudentsmarkbyid($ID){
        $markObj = new Mark();
        $data = $markObj->getstudentmarksbyid($ID);
        return $data;
    }

    public function getstudentmarksbyid($ID){
        $where = [
            0 => "studentid",
            1 => "=",
            2 => $ID
        ];
        return($this->getfromdb("mark",$where));
    }
}
