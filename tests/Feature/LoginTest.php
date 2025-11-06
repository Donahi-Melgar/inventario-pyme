<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function la_pagina_de_login_carga_correctamente()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
