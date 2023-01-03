<?php


namespace App\Admin;


use Illuminate\Support\Facades\Request;

class Helpers
{
    public static function sectionListRoute($alias, $parameters = []): string
    {
        $query = $parameters ? '?' . http_build_query($parameters) : '';
        return Request::root() . '/' . config('sleeping_owl.url_prefix') . "/$alias$query";
    }

    public static function sectionCreateRoute($alias, $parameters = []): string
    {
        $query = $parameters ? '?' . http_build_query($parameters) : '';
        return Request::root() . '/' . config('sleeping_owl.url_prefix') . "/$alias$query/create";
    }

    public static function sectionEditRoute($id, $alias, $parameters = []): string
    {
        $query = $parameters ? '?' . http_build_query($parameters) : '';
        return Request::root() . '/' . config('sleeping_owl.url_prefix')
            . "/$alias"
            . "/$id"
            . '/edit'
            . "/$query";
    }
}
