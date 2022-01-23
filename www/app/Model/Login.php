<?php

namespace App\Model;

use Exception;
use App\Utility;

/**
 * User Login Model:
 *
 * @author Sadmi Siraj <cybayz@gmail.com>
 * @since 1.0.2
 */
class Login {

    /** @var array The login form inputs. */
    private static $_inputs = [
        "username" => [
            "required" => true
        ],
        "password" => [
            "required" => true
        ]
    ];

        /**
     * Login: Validates the login form inputs, checks the user exists and that
     * the supplied password is correct - writing all necessary data into the
     * session if the login was successful. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     * @throws Exception
     */
    public static function login() {

        // Validate the login form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            Utility\Flash::info(Utility\Text::get("LOGIN_DETAILS_MISSING"));
            return false;
        }
        // Check if the user exists.
        $username = Utility\Input::post("username");
        if (!$User = User::getInstance($username)) {
            Utility\Flash::info(Utility\Text::get("LOGIN_USER_NOT_FOUND"));
            return false;
        }
        try {
            $data = $User->data();

            // Check if the provided password fits the hashed password in the
            // database.
            $password = Utility\Input::post("password");
            if (Utility\Hash::generate($password, 'SadmiSalt') !== $data->password) {
                Utility\Flash::info(Utility\Text::get("LOGIN_INVALID_PASSWORD"));
                return false;
            }
            
            // Write all necessary data into the session as the login has been
            // successful.
            Utility\Session::put(Utility\Config::get("SESSION_USER"), $data->id);
            return true;
        } catch (Exception $ex) {
            Utility\Flash::warning($ex->getMessage());
        }
        return false;
    }

    
    /**
     * Logout: Delete cookie and session. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function logout() {

        // Destroy all data registered to the session.
        Utility\Session::destroy();
        return true;
    }

}
