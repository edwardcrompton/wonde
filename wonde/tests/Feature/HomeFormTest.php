<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Test class for the home form of the application.
 */
class HomeFormTest extends TestCase
{
    /**
     * Test that the submit button text exists on the home form.
     */
    public function testSubmitButtonTextExists(): void
    {
        $response = $this->get('/');
        $response->assertSee('View my classes');
    }
}
