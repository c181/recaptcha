<?php

/**
 * Configuration for Google reChaptcha
 *
 * author: C181
 */
use Cake\Core\Configure;

$config = [
    'reCaptcha' => [
        // Plugin enable
        'enable' => false,
        // Adding reCAPTCHA Site Key
        'key' => null,
        // Adding reCAPTCHA Secret Key
        'secret' => null,
        // Adding reCAPTCHA Theme (dark & light)
        'theme' => 'light',
        // Adding reCAPTCHA Type (audio & image)
        'type' => 'image',
        // Adding reCAPTCHA Size (compact & normal)
        'size' => 'normal',
     ]
];

return $config;