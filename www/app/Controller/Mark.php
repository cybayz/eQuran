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

        $markdata = Model\Mark::getMarkList();
        $studentdata = Model\Mark::getStudentMarkList();

        $this->View->render("mark/marklist", [
            "title" => "Mark List",
            "studentdata" => $studentdata->data(),
            "markdata"    => $markdata->data(),
            "show_header" => true
        ]);
    }

    public function addmark() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $courses = Model\Course::getCourseList();
        $teachers = Model\Teacher::getTeacherList();
        $batch_data = Model\Batch::getBatchList();

        $studentdata = Model\Mark::getStudentList();

        $this->View->render("mark/addmark", [
            "title"         =>  "Add Mark",
            "show_header"   =>  true,
            "course_data"   =>  $courses->data(),
            "teachers_data" =>  $teachers->data(),
            "student_data"  =>  $studentdata->data(),
            "batch_data"    =>  $batch_data->data()
        ]);
    }

    public function createmark() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Mark::add()) {
            Utility\Redirect::to(APP_URL . "mark/addmarkssss");
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

    public function getstudentsmark(){
        $mark = Model\Mark::getstudentsmarkbyid($_POST['id']);
    }
    
}
