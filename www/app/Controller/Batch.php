<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Index Controller:
 *
 * @author 
 * 
 * @since 1.0
 */
class Batch extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function batchlist() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $course_data = Model\Course::getCourseList();
        $batch_data = Model\Batch::getBatchList();
        $this->View->render("batch/batchlist", [
            "title" => "Batch List",
            "course_data" => $course_data->data(),
            "batch_data" => $batch_data->data(),
            "show_header" => true
        ]);
    }

    public function addbatch() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $courses = Model\Course::getCourseList();

        $this->View->render("batch/addbatch", [
            "title"         =>  "Add Batch",
            "show_header"   =>  true,
            "course_data"   =>  $courses->data()
        ]);
    }

    public function create() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Batch::add()) {
            Utility\Redirect::to(APP_URL . "course/batchlist");
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
