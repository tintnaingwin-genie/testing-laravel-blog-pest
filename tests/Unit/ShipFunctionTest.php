<?php

it('can determine if we should ship', function () {
    expect(ship("GB", "Valid"))->toBeFalse();
    expect(ship("GB", "Valid"))->toBeFalse();

    expect(ship("BE", "Invalid"))->toBeFalse();
    expect(ship("BE", "Valid"))->toBeTrue();
});
