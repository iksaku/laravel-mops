<?php

return [
    'account' => 'Cuenta',

    'login' => [
        'title' => 'Inicia sesión',
        'action' => 'Iniciar sesión',
        'option' => 'O inicia sesión'
    ],

    'logout' => 'Cerrar sesión',

    'register' => [
        'title' => 'Crea una cuenta',
        'action' => 'Registrar',
        'option' => 'O registrate'
    ],

    '2fa' => [
        'title' => 'Factor de segunda autenticación',
        'description' => [
            'otp' => 'Por favor ingresa tu contraseña de uso único',
            'recovery-code' => 'Por favor ingresa uno de tus códigos de recuperación'
        ],
        'options' => [
            'otp' => 'O utiliza tu contraseña de uso único',
            'recovery-code' => 'O utiliza un código de recuperación'
        ]
    ],

    'password' => [
        'confirm' => [
            'title' => 'Confirma tu Identidad',
            'description' => 'Por favor ingresa tu Contraseña para continuar'
        ],
        'forgot' => [
            'title' => 'Restablece tu contraseña',
            'description' => 'Si has olvidado tu contraseña, podemos enviarte un correo al email con el que creaste tu cuenta.',
            'option' => '¿Olvidaste tu contraseña?',
            'action' => 'Envíame un correo'
        ]
    ],

    'fields' => [
        'name' => 'Nombre',
        'email' => 'Email',
        'password' => 'Contraseña',
        'password-confirmation' => 'Confirma tu contraseña',
        'remember' => 'Recuerdame',

        'otp' => 'Contraseña de uso único',
        'recovery-code' => 'Código de recuperación'
    ]
];