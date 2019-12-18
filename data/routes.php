<?php
self::add('^(?P<controller>galleries)/?(?P<action>[a-z-]+)/?(?P<param>[a-z-]+)?$', []);
self::add('^(?P<controller>archdiocese)/?(?P<action>[a-z-]+)/?(?P<param>[a-z-]+)?$', []);
self::add('^(?P<controller>all)/?(?P<action>[a-z-]+)/?(?P<param>[a-z-]+)?$', []);
self::add('^$', ['controller' => 'Main']);
self::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
