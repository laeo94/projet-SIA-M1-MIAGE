<?php

namespace Pw\Auth;

interface AuthenticatorInterface {

    /**
     * @param $identity
     * @return boolean Returns true if the identity exists.
     */
    public function existIdentity($identity);

    /**
     * @param $identity
     * @param $credential
     * @return mixed true if credentials are ok, roles if ok and can determine the role, false if not ok
     */
    public function authenticate($identity, $credential);

    /**
     * Logout

     *
     */
    public function clear();
}
