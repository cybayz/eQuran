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
class Batch extends Core\Model {
    
    /** @var array The register form inputs. */
    private static $_inputs = [
        "batchname" => [
            "required" => true
        ],
        "course" => [
            "required" => true
        ],
        "batchdescription" => [
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
            $batchObj = new Batch();
            $batchID = $batchObj->addBatch([
                "batchname" => Utility\Input::post("batchname"),
                "courseid" => Utility\Input::post("course"),
                "batchdescription" => Utility\Input::post("batchdescription")
            ]);
            //Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            Utility\Redirect::to(APP_URL . "batch/batchlist");
            return $batchID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
            return false;
        }
    }

    public function addBatch($fields){
        if (!$batchID = $this->create("batch", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $batchID;
    
    }
    
    public static function getBatchList(){
        $batchObj = new Batch();
        $data = $batchObj->getbatches();
        return $data;
    }

    public function getbatches(){
        return($this->getfromdb("batch"));
    }

    public static function getBatchListByCourse($courseID){
        $courseObj = new Batch();
        $data = $courseObj->getbatchesbycourseid($courseID);
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
