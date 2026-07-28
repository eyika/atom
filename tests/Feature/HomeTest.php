<?php

namespace Test\Feature;

use Test\TestCase;

/**
 * Example feature tests — they dispatch real requests through the application's routes
 * and middleware. Delete or adapt these for your own app.
 */
class HomeTest extends TestCase
{
    public function test_the_home_page_renders_the_view(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertBodyContains('Hello World');
    }

    public function test_a_named_route_reaches_the_controller(): void
    {
        $this->get('/name/Ada')
            ->assertOk()
            ->assertBodyContains('Hello Ada');
    }

    public function test_a_json_request_is_routed_to_the_api(): void
    {
        $this->getJson('/')
            ->assertOk()
            ->assertJsonFragment(['message' => 'hello world api']);
    }
}
