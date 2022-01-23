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
class Dashboard extends Core\Controller {

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
        $this->View->render("dashboard/index", [
            "title"         =>  "Home",
            "show_header"   =>  true
        ]);
    }

}
