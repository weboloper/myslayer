<?php


namespace Components\Library\Facebook;

use Phalcon\Config;
use Phalcon\DI\Injectable;
use Guzzle\Http\Client as HttpClient;
use League\OAuth2\Client\Provider\Facebook;
/**
 * Class OAuth
 *
 * @package Phosphorum\Facebook
 */
class Auth extends Injectable
{
    protected $endPointAuthorize = 'https://graph.facebook.com/v2.3/oauth/access_token';
    protected $redirectUriAuthorize;
    protected $clientId;
    protected $clientSecret;


    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {   
        $this->redirectUriAuthorize = $config->redirectUri;
        $this->clientId             = $config->clientId;
        $this->clientSecret         = $config->clientSecret;
    }
    /**
     * It will return uid, token and information user to save database
     *
     * @return array
     */
    public function authorize()
    {
        $this->view->disable();
        $provider = new Facebook(
            [
            'clientId'      => $this->clientId,
            'clientSecret'  => $this->clientSecret,
            'redirectUri'   => $this->redirectUriAuthorize,
            ]
        );
        $code      = $this->request->getQuery('code');
        $state     = $this->request->getQuery('state');
        if (!isset($code)) {
            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $this->session->set('oauth2state', $provider->state);
            return $this->response->redirect($authUrl);
            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($state) || ($state !== $this->session->get('oauth2state'))) {
            $this->session->remove('oauth2state');
            exit('Invalid state');
        } else {
            // Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken(
                'authorization_code',
                [
                'code' => $code
                ]
            );
            $uid = $provider->getUserUid($token);
            $userDetails = $provider->getUserDetails($token);
            return array($uid, $token, $userDetails);
        }
    }
}