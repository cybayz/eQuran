<?php

namespace App\Core;

use App\Utility;

/**
 * Core Controller:
 *
 * @author Sadmi Siraj <cybayz@gmail.com>
 * @since 1.0
 */
class Controller {

    /** @var View An instance of the core view class. */
    protected $View = null;

    /**
     * Construct: Creates and stores a new instance of the core view class,
     * which can be accessed by any controller which extends this class.
     * @access public
     * @since 1.0
     */
    public function __construct() {

        // Initialize a session.
        Utility\Session::init();

        // Create a new instance of the core view class.
        $this->View = new View;
    }

}
