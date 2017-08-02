<?php

namespace Cronos\Http\Controllers;

class UserController extends Controller
{
    use \ChronosDependency\UserController;

	function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
}
