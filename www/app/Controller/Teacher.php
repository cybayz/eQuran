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
class Teacher extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function teacherlist() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $data = Model\Teacher::getTeacherList();
        $this->View->render("teacher/teacherlist", [
            "title" => "Teacher List",
            "data" => $data->data(),
            "show_header" => true
        ]);
    }

    public function addteacher() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $this->View->render("teacher/addteacher", [
            "title"         =>  "Add Teacher",
            "show_header"   =>  true
        ]);
    }

    public function create() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Teacher::add()) {
            Utility\Redirect::to(APP_URL . "teacher/teacherlist");
        }
    }
    
    public function studentsUnderTeacher($teacherId) {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $student_data = Model\Teacher::getStudentByTeacherId($teacherId);
        $this->View->render("teacher/studentsunderteacher", [
            "title" => "Students Under Teacher",
            "student_data" => $student_data->data(),
            "show_header" => true
        ]);
    }

    public function delete() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Teacher::deleteteacher()) {
            Utility\Redirect::to(APP_URL . "teacher/teacherlist");
        }
    }

}
