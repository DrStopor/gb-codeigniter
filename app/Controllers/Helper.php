<?php

namespace App\Controllers;

class Helper
{
    public static function getSortButtons($param, $order): array
    {
        $param = $param ?? 'id';
        $order = $order ?? 'asc';

        $htmlId = 'Cортировать по id: ';
        $htmlDate = 'Cортировать по дате: ';
        if ($param === 'id') {
            if ($order === 'desc') {
                $htmlId .= '<a href="' . site_url('/id/asc') . '">возрастание</a> | убывание';
            } else {
                $htmlId .= 'возрастание | <a href="' . site_url('/id/desc') . '">убывание</a>';
            }
        } else {
            $htmlId .= '<a href="' . site_url('/id/asc') . '">возрастание</a> | <a href="' . site_url('/id/desc') . '">убывание</a>';
        }

        if ($param === 'date') {
            if ($order === 'desc') {
                $htmlDate .= '<a href="' . site_url('/date/asc') . '">возрастание</a> | убывание';
            } else {
                $htmlDate .= 'возрастание | <a href="' . site_url('/date/desc') . '">убывание</a>';
            }
        } else {
            $htmlDate .= '<a href="' . site_url('/date/asc') . '">возрастание</a> | <a href="' . site_url('/date/desc') . '">убывание</a>';
        }
        return array($htmlId, $htmlDate);
    }
}