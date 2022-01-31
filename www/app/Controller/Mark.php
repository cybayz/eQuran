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
class Mark extends Core\Controller {

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

        $studentdata = Model\Student::getStudentList();
        $this->View->render("course/courselist", [
            "title" => "Course List",
            "studentdata" => $studentdata->data(),
            "show_header" => true
        ]);
    }

    public function addmark() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $this->View->render("mark/addmark", [
            "title"         =>  "Add Mark",
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
    
}
