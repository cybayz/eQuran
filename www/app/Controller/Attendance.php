<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Index Controller:
 *
 * @author Sadmi Siraj <cybayz@gmail.com>
 * @since 1.0
 */
class Attendance extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function marklist() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $markdata = Model\Mark::getMarkList();
        $studentdata = Model\Mark::getStudentMarkList();

        $this->View->render("mark/marklist", [
            "title" => "Mark List",
            "studentdata" => $studentdata->data(),
            "markdata"    => $markdata->data(),
            "show_header" => true
        ]);
    }

    public function addattendance() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $this->View->render("attendance/addattendance", [
            "title"         =>  "Add Attendance",
            "show_header"   =>  true
        ]);
    }
    
    public function monthlybatchattendance() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        $courses = Model\Course::getCourseList();
        $batch_data = Model\Batch::getBatchList();

        $studentdata = Model\Attendance::getStudentList();
        $attendancedata = Model\Attendance::getAttendanceList();

        $this->View->render("attendance/monthlybatchattendance", [
            "title"             =>  "Monthy Batch Attendance",
            "show_header"       =>  true,
            "course_data"       =>  $courses->data(),
            "batch_data"        =>  $batch_data->data(),
            "student_data"      =>  $studentdata->data(),
            "attendance_data"   =>  $attendancedata->data()
        ]);
    }

    public function create() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Attendance::add()) {
            Utility\Redirect::to(APP_URL . "attendance/addmarkssss");
        }
    }

    public function getbatchbycourseid(){
        $courses = Model\Batch::getBatchListByCourse($_POST['course_id']);
        $batches='<option value="0">Select Batch</option>';
        foreach ($courses->data() as $batch){
            $batches = $batches." <option value = '".$batch->id."'>".$batch->batchname."</option>";
        }
        echo $batches;
    }

}
