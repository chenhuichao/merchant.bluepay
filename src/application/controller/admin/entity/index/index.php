<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

LoaderSvc::loadSmarty()->display('entity/index.tpl');
