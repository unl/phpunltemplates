<?php
namespace UNL\Templates\Auth;

class AuthModShib implements AuthInterface
{
  private $shibLoginURL;
  private $shibLogoutURL;
  private $appBaseURL;
  private $userAttributes = array();

  public function __construct($settings, $sessionName = NULL) {
    if (!empty($settings)) {

      if (session_status() === PHP_SESSION_NONE) {
        if (!empty($sessionName)) {
          session_name($sessionName);
        }
        session_start();
      }

      if (!isset($settings['shibLoginURL'])) {
        throw new \Exception('the loginURL must be set for auth_shib');
      }
      $this->shibLoginURL = $settings['shibLoginURL'];

      if (!isset($settings['shibLogoutURL'])) {
        throw new \Exception('the logoutURL must be set for auth_shib');
      }
      $this->shibLogoutURL = $settings['shibLogoutURL'];

      if (!isset($settings['appBaseURL'])) {
        throw new \Exception('the baseURL must be set for application');
      }
      $this->appBaseURL = $settings['appBaseURL'];

      if (isset($settings['userAttributes']) && is_array($settings['userAttributes'])) {
        $this->userAttributes = $settings['userAttributes'];
      }

      return;
    }
    throw new \Exception('Missing mod_shib settings', 500);
  }

  public function getAuthType() {
    return static::AUTH_TYPE_MOD_SHIB;
  }

  public function login() {
    if (!$this->isAuthenticated()) {
      header("Location: " . $this->shibLoginURL . '?target=' . urlencode($this->appBaseURL));
      exit();
    }
  }

  public function logout() {
    header("Location: " . $this->shibLogoutURL);
    exit();
  }

  public function checkAuthentication() {
    return $this->isAuthenticated();
  }

  public function isAuthenticated() {
    return isset($_SERVER['REMOTE_USER']) && !empty($_SERVER['REMOTE_USER']);
  }

  public function getUser() {
    if (!$this->isAuthenticated()) {
      return NULL;
    }

    $user = array(
      'uid' => $this->getUserId(),
      'idp_id' => $_SERVER['REMOTE_USER']
    );

    foreach ($this->userAttributes as $userAttribute) {
      if (array_key_exists($userAttribute, $_SERVER)) {
        $user[$userAttribute] = $_SERVER[$userAttribute];
      }
    }
    return $user;
  }

  public function getUserId() {
    if ($this->isAuthenticated()) {
      $parts = explode('@', $_SERVER['REMOTE_USER']);
      return $parts[0];
    }
  }

  public function getUserDisplayName() {
    $user = $this->getUser();
    return is_array($user) && array_key_exists('displayName', $user) ? $user['displayName'] : $this->getUserID();
  }
}
