<?php
session_start();


define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tickets');


define('URL', 'http://localhost/desktop/');

define('PASSWORD_KEY', 'password');


spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.cls.php';
});


// if(Cookie::exists(Settings::getSettingsValue('cookie', 'cookie_name')) && !Session::exists(Settings::getSettingsValue('sessions', 'session_name'))) {

// 	//var_dump('avui');exit;
//     $hash = Cookie::get(Settings::getSettingsValue('cookie', 'cookie_name'));
//     $hashCheck = DB::getInstance()->query("SELECT * FROM users_session WHERE Hash = '{$hash}'");

//     if($hashCheck->count()) {
//         $user = new User($hashCheck->first()->UserID);
//         $user->login();
//     }
// }