<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MainConfig extends BaseConfig
{
    public const SITE_NAME  = 'Nicolas Olagnon Portfolio';
    public const LOGIN_INVITE = ["invite", "invité", "Invite", "Invité"];
    public const PASSWORD_INVITE = '';
    public const KEY_COOKIE = '';
    public const DESTINATAIRE_EMAIL = "olagnon.n@gmail.com";

    public static $timeCookie = 3600 * 24 * 3;
}