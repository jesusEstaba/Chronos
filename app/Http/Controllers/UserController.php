<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Repo\User;
use Auth;

class UserController extends Controller
{
    use \ChronosDependency\UserController;

	function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
}
