<?php

namespace Adldap\Tests;

use Adldap\Query\Grammar;
use Adldap\Query\Builder;
use Adldap\Schemas\Schema;
use Mockery;

class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    /*
     * Set up the test environment.
     */
    public function setUp()
    {
        // Set constants for testing without LDAP support
        if (!defined('LDAP_OPT_PROTOCOL_VERSION')) {
            define('LDAP_OPT_PROTOCOL_VERSION', 3);
        }

        if (!defined('LDAP_OPT_REFERRALS')) {
            define('LDAP_OPT_REFERRALS', 0);
        }

        if (!array_key_exists('REMOTE_USER', $_SERVER)) {
            $_SERVER['REMOTE_USER'] = 'true';
        }

        if (!array_key_exists('KRB5CCNAME', $_SERVER)) {
            $_SERVER['KRB5CCNAME'] = 'true';
        }
    }

    /**
     * Mocks a the specified class.
     *
     * @param mixed $class
     *
     * @return Mockery\MockInterface
     */
    protected function mock($class)
    {
        return Mockery::mock($class);
    }

    /**
     * Returns a new Builder instance.
     *
     * @param null $connection
     *
     * @return Builder
     */
    protected function newBuilder($connection = null)
    {
        if(is_null($connection)) $connection = $this->newConnectionMock();

        return new Builder($connection, new Grammar(), Schema::get());
    }

    /**
     * Returns a new connection mock.
     *
     * @return Mockery\MockInterface
     */
    protected function newConnectionMock()
    {
        return $this->mock('Adldap\Contracts\Connections\ConnectionInterface');
    }
}
