<?php

namespace Routes\Enums;
enum AuthRoutes: string
{
    case HOME = 'home';
    case ADMIN = 'admin';
    case LOGIN = 'login';
    case LOGOUT = 'logout';
}
