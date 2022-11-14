<?php
namespace UNL\Templates\Auth;

class AuthCAS implements AuthInterface
{
  public function __construct($version, $hostname, $port, $uri, $siteURL, $cert = NULL, $sessionName = NULL) {
    if (!\phpCAS::isInitialized()) {
      if (!empty($sessionName)) {
        session_name($sessionName);
      }
      \phpCAS::client($version, $hostname, $port, $uri, $siteURL);
      if (!empty($cert)) {
        \phpCAS::setCasServerCACert($cert);
      } else {
        \phpCAS::setNoCasServerValidation();
      }
      \phpCAS::handleLogoutRequests();
    }
  }

  public function getAuthType() {
    return static::AUTH_TYPE_CAS;
  }

  public function login() {
    \phpCAS::forceAuthentication();
  }

  public function logout() {
    \phpCAS::logout();
  }

  public function checkAuthentication() {
    return \phpCAS::checkAuthentication();
  }

  public function isAuthenticated() {
    return \phpCAS::isAuthenticated();
  }

  public function getUser() {
    return $this->isAuthenticated() ? \phpCAS::getAttributes() : NULL;
  }

  public function getUserId() {
    return $this->isAuthenticated() ? \phpCAS::getUser() : NULL;
  }

  public function getUserDisplayName() {
    $user = $this->getUser();
    return is_array($user) && array_key_exists('displayName', $user) ? $user['displayName'] : $this->getUserID();
  }

}
