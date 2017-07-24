<?php

namespace Cronos\Http\Controllers;

class ClientController extends Controller
{
    use \ChronosDependency\ClientController;

    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
}
