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
class Fees extends Core\Model {

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
            $feesObj = new Fees();
            $feesID = $feesObj->addFees([
                "studentid"     => Utility\Input::post("studentid"),
                "courseid"      => Utility\Input::post("courseid"),
                "batchid"       => Utility\Input::post("batchid"),
                "amount"        => Utility\Input::post("amount"),
                "month"         => Utility\Input::post("month")."-01"
            ]);
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "fees/addpayment");
            return $feesID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function addFees($fields){

        if (!$feesID = $this->create("fees", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $feesID;
    
    }
    
    public static function getStudentList(){
        $feesObj = new Fees();
        $filters = $_POST;
        $data = $feesObj->getstudents($filters);
        return $data;
    
    }

    public function getstudents($filters){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, u.email, 
                 u.juzz, u.createddate, c.coursename, b.batchname, t.name, u.courseid, u.batchid, u.teacherid   
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                LEFT JOIN teacher t ON t.id=u.teacherid 
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

    public static function getPaidStudentList(){
        $feesObj = new Fees();
        $filters = $_POST;
        $data = $feesObj->getpaidstudents($filters);
        return $data;
    
    }

    public function getpaidstudents($filters){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, u.email, 
                 u.juzz, u.createddate, c.coursename, b.batchname, u.courseid, u.batchid, 
                 f.amount, f.month, f.paymentdate    
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                INNER JOIN fees f ON f.studentid=u.id 
                WHERE u.isadmin = 0 
                 ";

        $params = [];

        if(isset($filters['course'])&& $filters['course']>0){
            $sql = $sql." AND c.id = ".$filters['course']." ";
        }
        if(isset($filters['batch'])&& $filters['batch']>0){
            $sql = $sql." AND b.id = ".$filters['batch']." ";
        }
        if(isset($filters['month'])&& $filters['month']>0){
            $sql = $sql." AND f.month  BETWEEN '".$filters['month']."-01' AND '".$filters['month']."-31' "." ";
        }
        
        $sql =$sql." GROUP BY u.id ";

        return($this->getfromdbusingselect($sql,$params));
    }

    public static function getPaymentList(){
        $feesObj = new Fees();
        $filters = $_POST;
        $data = $feesObj->getpayents($filters);
        return $data;
    
    }

    public function getpayents($filters){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.mobile, u.address, u.email, 
                 u.juzz, u.createddate, c.coursename, b.batchname, t.name, u.courseid, 
                 u.batchid, u.teacherid, f.paymentdate, f.amount, f.month     
                FROM user u  
                LEFT JOIN course c ON c.id = u.courseid 
                LEFT JOIN batch b ON b.id = u.batchid 
                LEFT JOIN teacher t ON t.id=u.teacherid 
                LEFT JOIN fees f on f.studentid=u.id  
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

}
