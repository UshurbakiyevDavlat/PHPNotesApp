<?php

use Core\Session;

return view('auth/registration/create', [
    'errors' => Session::get('errors'),
]);