<?php
namespace Recaptcha\Controller\Component;

use Cake\Core\Configure;
use Cake\Controller\Component;
use Cake\Network\Http\Client;
use Recaptcha\Exception\EnableConfigurationException;

/**
 * Recaptcha component
 *
 * author: C181
 */
class RecaptchaComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->_enableConfig();
    }

    /**
     * Check if the configuration enable
     *
     * @throws EnableConfigurationException
     * @return void
     */
    protected function _enableConfig()
    {
        if (!Configure::read('reCaptcha.enable')) {
            $message = __d('Recaptcha', 'You can\'t enable reCaptcha is false, please enable configuration');
            throw new EnableConfigurationException($message);
        }
    }

    /**
     * verify recaptcha
     * @return bool
     */
    public function verify()
    {
        $controller = $this->_registry->getController();

        if (isset($controller->request->data['g-recaptcha-response'])) {
            $response = json_decode($this->api());
            if (isset($response->success)) {
                return $response->success;
            }
        }
        return false;
    }

    /**
     * Call reCAPTCHA API to verify
     *
     * @return string
     */
    protected function api()
    {
        $controller = $this->_registry->getController();

        return (new Client())->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => Configure::read('reCaptcha.secret'),
            'response' => $controller->request->data['g-recaptcha-response'],
            'remoteip' => $controller->request->clientIp()
        ])->getBody();
    }

}
