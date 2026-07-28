<?php

namespace Test;

use Eyika\Atom\Framework\Support\Testing\TestCase as IntegrationTestCase;

/**
 * Base test case for the application. Extend this for feature tests that dispatch
 * requests through the real routing/middleware pipeline (get/post/postJson → TestResponse).
 * For database-backed tests, extend Eyika\Atom\Framework\Support\Testing\DatabaseTestCase.
 */
abstract class TestCase extends IntegrationTestCase
{
    //
}
