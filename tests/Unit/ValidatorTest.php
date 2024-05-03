<?php

use App\Core\Validator;

it('validates string request data', function () {
    expect(Validator::string('loko loko'))->toBeArray()
        ->and(Validator::string('loko loko', 100))->toBeString()
        ->and(Validator::string(''))->toBeString();
});

it('validates email request data', function () {
    expect(Validator::email('dushurbakiev@gmail.com'))->toBeTrue()
        ->and(Validator::email('dava'))->toBeFalse();
});