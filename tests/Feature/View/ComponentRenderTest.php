<?php

namespace Tests\Feature\View;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComponentRenderTest extends TestCase
{
    use RefreshDatabase;
    public function test_button_render(): void
    {
        $this->withoutVite();
        $contents = $this->blade('<x-button>Test</x-button>');

        $contents->assertSee('');
    }
}
