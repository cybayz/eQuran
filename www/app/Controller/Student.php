<?php

namespace App\Controller;

use App\Core;
use App\Core\Model as CoreModel;
use App\Model;
use App\Utility;
use App\Utility\Response;

/**
 * Index Controller:
 *
 * @author Sadmi Siraj <cybayz@gmail.com>
 * @since 1.0
 */
class Student extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function index() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
    }

    public function addstudent() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $courses = Model\Course::getCourseList();
        $teachers = Model\Teacher::getTeacherList();

        $this->View->render("student/addstudent", [
            "title"         =>  "Add Student",
            "show_header"   =>  true,
            "course_data"   =>  $courses->data(),
            "teachers_data" =>  $teachers->data()
        ]);
    }

    public function studentlist() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        $course_data = Model\Course::getCourseList();
        $batch_data = Model\Batch::getBatchList();
        $student_data = Model\Student::getStudentList();
        
        $this->View->render("student/studentlist", [
            "title" => "Student List",
            "batch_data" => $batch_data->data(),
            "course_data" => $course_data->data(),
            "student_data" => $student_data->data(),
            "show_header" => true
        ]);
    }
    
    public function details($studentId) {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        $student_data = Model\Student::getStudentById($studentId);
        $mark_data = Model\Student::getStudentMarkById($studentId);
        $attendance_data = Model\Student::getStudentAttendanceById($studentId);
        $total_absent = Model\Student::getTotalAbsent($studentId);
        
        $ismonthfiltered = isset($_POST['month'])?$_POST['month']:'';

        $this->View->render("student/studentdetail", [
            "title"             => "Student Detail",
            "student_data"      => $student_data->data(),
            "mark_data"         => $mark_data->data(),
            "attendance_data"   => $attendance_data->data(),
            "total_absent"      => $total_absent->data(),
            "ismonthfiltered"   => $ismonthfiltered,
            "show_header"       => true
        ]);
    }

    public function getbatchbycourseid(){
        $courses = Model\Batch::getBatchListByCourse($_POST['course_id']);
        $batches="";
        foreach ($courses->data() as $batch){
            $batches = $batches." <option value = '".$batch->id."'>".$batch->batchname."</option>";
        }
        echo $batches;
    }

    public function create() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Student::add()) {
            Utility\Redirect::to(APP_URL . "student/studentlist");
        }
    }

    public function delete() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Student::deletestudent()) {
            Utility\Redirect::to(APP_URL . "student/studentlist");
        }
    }

}
