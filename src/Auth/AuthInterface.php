<?php
namespace UNL\Templates\Auth;

interface AuthInterface
{
    const AUTH_TYPE_CAS = 'AUTH_TYPE_CAS';
    const AUTH_TYPE_MOD_SHIB = 'AUTH_TYPE_MOD_SHIB';

    public function getAuthType();
    public function login();
    public function logout();
    public function isAuthenticated();
    public function checkAuthentication();
    public function getUser();
    public function getUserId();
    public function getUserDisplayName();
}