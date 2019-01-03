<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'confirmed'            => 'Pole :attribute i jego powtórzenie nie są równe.',
    'different'            => 'Pola :attribute i :other muszą być różne.',
    'is_registered_user'   => 'Nie ma takiego użytkownika.',
    'matches_current_password' => 'Niepoprawne obecne hasło.',
    'min'                  => [
        'numeric' => 'Pole :attribute musi wynosić co najmniej :min.',
        'file'    => 'Pole :attribute musi mieć co najmniej :min kilobajtów.',
        'string'  => 'Pole :attribute musi mieć co najmniej :min znaków.',
        'array'   => 'Pole :attribute musi mieć co najmniej :min pozycji.',
    ],
    'required'             => 'Pole :attribute jest wymagane.',
    'string'               => 'Pole :attribute musi być tekstowe.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'current-password' => '"Obecne hasło"',
        'new-password' => '"Nowe hasło"'
    ],
];
