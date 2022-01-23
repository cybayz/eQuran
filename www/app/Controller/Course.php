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
class Course extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function courselist() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $data = Model\Course::getCourseList();
        $this->View->render("course/courselist", [
            "title" => "Course List",
            "data" => $data->data(),
            "show_header" => true
        ]);
    }

    public function addcourse() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $this->View->render("course/addcourse", [
            "title"         =>  "Add Course",
            "show_header"   =>  true
        ]);
    }

    public function create() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Course::add()) {
            Utility\Redirect::to(APP_URL . "course/courselist");
        }
    }
    
    public function delete() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Course::deletecourse()) {
            Utility\Redirect::to(APP_URL . "course/courselist");
        }
    }

}
