<?php

use Illuminate\Support\Facades\Request;

if (! function_exists('isActiveKegiatan')) {
    function isActiveKegiatan()
    {
        return Request::is('kegiatanDosen');
    }
}

if (! function_exists('isActiveDashboard')) {
    function isActiveDashboard()
    {
        return Request::is('home');
    }
}

if (! function_exists('isActiveDosen')) {
    function isActiveDosen()
    {
        return Request::is('dosen');
    }
}

if (! function_exists('isActiveLogout')) {
    function isActiveLogout()
    {
        return Request::is('logout');
    }
}
