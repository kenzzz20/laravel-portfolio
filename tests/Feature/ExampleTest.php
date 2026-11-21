<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('the homepage presents the portfolio sections', function () {
    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertSee('Kenneth Malinao')
        ->assertSee('Full-Stack Web Developer')
        ->assertSee('View Projects')
        ->assertSee('Get in Touch')
        ->assertSee('Tech stack')
        ->assertSee('Laravel 12');
});
