<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewsExerciseTest extends TestCase
{
    public function test_vistas(): void
    {
        /**
         * main page test.
         */
            $value = 'Pantalla principal';
            $response = $this->get('/');

            $pieceOfNavBar = 'Marca Personal FP';
            $response
                ->assertStatus(200)
                ->assertViewIs('home')
                ->assertSeeText($value, $escaped = true)
                ->assertSeeText($pieceOfNavBar, $escaped = true);

        /**
         * login test.
         */
            $value = 'Login usuario';
            $response = $this->get('/login');

            $response
            ->assertStatus(200)
            ->assertViewIs('auth.login')
            ->assertSeeText($value, $escaped = true);

        /**
         * logout test.
         */
            $value = 'Logout usuario';
            $response = $this->get('/logout');

            $response->assertStatus(200)->assertSeeText($value, $escaped = true);

        /**
         * proyectos index test.
         */
            $value = 'Listado proyectos';
            $response = $this->get('/tfcs');

            $response
            ->assertStatus(200)
            ->assertViewIs('tfcs.index')
            ->assertSeeText($value, $escaped = true);

        /**
         * proyectos show test.
         */
            $id = rand(1, 10);
            $value = "Vista detalle proyecto $id";
            $response = $this->get("/tfcs/show/$id");

            $response
            ->assertStatus(200)
            ->assertViewIs('tfcs.show')
            ->assertSeeText($value, $escaped = true);

            $response = $this->get("/tfcs/show/" . chr($id));
            $response->assertNotFound();

        /**
         * proyectos create test.
         */
            $value = 'Añadir proyecto';
            $response = $this->get('/tfcs/create');

            $response
            ->assertStatus(200)
            ->assertViewIs('tfcs.create')
            ->assertSeeText($value, $escaped = true);

        /**
         * proyectos edit test.
         */
            $id = rand(1, 10);
            $value = "Modificar proyecto $id";
            $response = $this->get("/tfcs/edit/$id");

            $response
            ->assertStatus(200)
            ->assertViewIs('tfcs.edit')
            ->assertSeeText($value, $escaped = true);

            $response = $this->get("/tfcs/edit/" . chr($id));
            $response->assertNotFound();

        /**
         * perfil test.
         */
            $id = rand(1, 10);
            $value = "Visualizar el currículo de $id";
            $response = $this->get("/perfil/$id");

            $response->assertStatus(200)->assertSeeText($value, $escaped = true);

            $value = "Visualizar el currículo propio";
            $response = $this->get("/perfil");

            $response->assertStatus(200)->assertSeeText($value, $escaped = true);

            $response = $this->get("/perfil/" . chr($id));
            $response->assertNotFound();
    }
}
