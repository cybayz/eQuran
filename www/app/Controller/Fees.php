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
class Fees extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function paymentlist() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $data = Model\Fees::getPaymentList();
        $this->View->render("fees/paymentlist", [
            "title" => "Payment List",
            "data" => $data->data(),
            "show_header" => true
        ]);
    }
    
    public function paidstudents() {

        Utility\Auth::checkAuthenticated();
        $courses = Model\Course::getCourseList();
        $batch_data = Model\Batch::getBatchList();

        $studentdata = Model\Fees::getPaidStudentList();

        $this->View->render("fees/paidstudents", [
            "title"             =>  "Paid Students",
            "show_header"       =>  true,
            "course_data"       =>  $courses->data(),
            "batch_data"        =>  $batch_data->data(),
            "student_data"      =>  $studentdata->data(),
        ]);
    }

    public function pendingstudents() {

        Utility\Auth::checkAuthenticated();
        $courses = Model\Course::getCourseList();
        $batch_data = Model\Batch::getBatchList();

        $studentdata = Model\Fees::getPendingStudentList();

        $this->View->render("fees/pendingstudents", [
            "title"             =>  "Pending Students",
            "show_header"       =>  true,
            "course_data"       =>  $courses->data(),
            "batch_data"        =>  $batch_data->data(),
            "student_data"      =>  $studentdata->data(),
        ]);
    }

    public function addpayment() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        $courses = Model\Course::getCourseList();
        $teachers = Model\Teacher::getTeacherList();
        $batch_data = Model\Batch::getBatchList();
        $studentdata = Model\Fees::getStudentList();

        $this->View->render("fees/addpayment", [
            "title"         =>  "Add Payment",
            "show_header"   =>  true,
            "course_data"   =>  $courses->data(),
            "teachers_data" =>  $teachers->data(),
            "student_data"  =>  $studentdata->data(),
            "batch_data"    =>  $batch_data->data()
        ]);
    }

    public function createpayment() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        if (Model\Fees::add()) {
            Utility\Redirect::to(APP_URL . "fees/addpayment");
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
