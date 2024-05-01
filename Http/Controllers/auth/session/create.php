<?php

use Core\Session;

return view('auth/session/create', [
    'errors' => Session::get('errors'),
]);