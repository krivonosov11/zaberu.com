<?php

class Config
{

    // config local DateBase
     public static $host = '127.0.0.1';
     public static $dbname = 'ct_db';
     public static $user = 'root';
     public static $password = '';
     public static $url = 'http://local.cargos-trans';

    // config production DataBae
//   public static $host = '127.0.0.1';
//   public static $dbname = 'gt_db';
//   public static $user = 'starov00_db';
//   public static $password = 'e7pU2HfZ';
//   public static $url = 'https://cargos-trans.com';

    public static $errorReporting = -1;
    public static $ajax_include = true; // include test ajax query

    public static $v_cache_styles_and_js = 48;
}
