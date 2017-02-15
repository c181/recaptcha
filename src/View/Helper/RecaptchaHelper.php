<?php
namespace Recaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\View\View;

/**
 * Recaptcha helper
 *
 * author: C181
 */
class RecaptchaHelper extends Helper
{

    public $helpers = ['Html', 'Form'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Add reCaptcha script
     * @return void
     */
    public function addReCaptchaScript()
    {
        $this->Html->script('https://www.google.com/recaptcha/api.js', [
            'block' => 'script',
        ]);
    }

    /**
     * Add reCaptcha to the form
     * @return mixed
     */
    public function addReCaptcha()
    {
        if (!Configure::read('reCaptcha.key')) {
            return $this->Html->tag('p', __d('Recaptcha', 'reCaptcha is not configured! Please configure reCaptcha.key'));
        }
        $this->addReCaptchaScript();
        $this->Form->unlockField('g-recaptcha-response');

        return $this->Html->tag('div', '', [
            'class' => 'g-recaptcha',
            'data-sitekey' => Configure::read('reCaptcha.key'),
            'data-theme' => Configure::read('reChaptcha.theme'),
            'data-type' => Configure::read('reChaptcha.type'),
            'data-size' => Configure::read('reChaptcha.size'),
        ]);
    }

}
