<?php
require 'app/autoload.php';
use app\resources\library\sessions\SessionHandler;
session_set_save_handler(new SessionHandler);
register_shutdown_function('session_write_close');
session_start();
include 'app/route.php';

    