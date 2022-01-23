<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Login Controller:
 *
 * @author Sadmi Siraj <cybayz@gmail.com>
 * @since 1.0.2
 */
class Login extends Core\Controller {

    /**
     * Index: Renders the login view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example login/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkUnauthenticated("dashboard");

        // Set any dependencies, data and render the view.
        $this->View->render("login/index", [
            "title"         =>  "Login",
            "show_header"   =>  false
        ]);
    }

    /**
     * Login: Processes a login request. NOTE: This controller can only be
     * accessed by unauthenticated users!
     * @access public
     * @example login/userlogin
     * @return void
     * @since 1.0.2
     */
    public function login() {

        // successful or back to the login controller if not.
        if (Model\Login::login()) {
            Utility\Redirect::to(APP_URL."dashboard");
        }
        Utility\Redirect::to(APP_URL . "login");
    }


    /**
     * Logout: Processes a logout request. NOTE: This controller can only be
     * accessed by authenticated users!
     * @access public
     * @example login/logout
     * @return void
     * @since 1.0.2
     */
    public function logout() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        // Process the logout request, redirecting to the login controller if
        // successful or to the default controller if not.
        if (Model\Login::logout()) {
            Utility\Redirect::to(APP_URL . "login");
        }
        Utility\Redirect::to(APP_URL);
    }

}
