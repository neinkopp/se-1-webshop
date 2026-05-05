<?php

namespace Tests\Feature\View;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('product', [
            //
        ]);

        $contents->assertSee('');
    }
}
