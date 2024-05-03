<?php

use App\Core\Authenticator;

(new Authenticator())->logout();

redirect('/');