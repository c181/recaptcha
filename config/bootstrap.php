<?php
/**
 * Bootstrap CakePHP Configuration.
 * User: C181
 */

use Cake\Core\Configure;

Configure::load('Recaptcha.recaptcha');
if (!Configure::read('reCaptcha.enable') && is_null(Configure::read('reCaptcha.key')) && is_null(Configure::read('reCaptcha.secret'))) {
    Configure::load('recaptcha');
}