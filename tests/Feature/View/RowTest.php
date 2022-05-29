<?php

it('can render a row', function () {
    test()->blade('<x-row header />')
        ->assertSee('sticky')
        ->assertSee('bg-gray');

    test()->blade('<x-row />')
        ->assertDontSee('sticky')
        ->assertSee('bg-white');
});
