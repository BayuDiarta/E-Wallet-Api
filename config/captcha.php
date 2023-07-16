<?php

return [
    /*
     * Atur API key yang dibutuhkan untuk mengakses API Google Recaptcha.
     * Dapatkan API key dengan mengakses halaman panel akun Anda.
     */
    'secret_key' => env('CAPTCHA_SECRET_KEY', '6LdaHnghAAAAADYnqx_bbSIBMhdjEBnHjs0dTlye'),

    'site_key' => env('CAPTCHA_SITE_KEY', ''),
];
