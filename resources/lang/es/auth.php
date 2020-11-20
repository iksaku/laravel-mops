<?php

return [
    'account' => 'Cuenta',

    'login' => [
        'title' => 'Inicia sesión',
        'submit' => 'Iniciar sesión',
        'option' => 'O inicia sesión'
    ],

    'logout' => 'Cerrar sesión',

    'register' => [
        'title' => 'Crea una cuenta',
        'submit' => 'Registrar',
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
            'description' => 'Por favor ingresa tu contraseña para continuar'
        ],
        'forgot' => [
            'title' => 'Restablecer contraseña',
            'description' => 'Si has olvidado tu contraseña, podemos enviarte un correo al email con el que creaste tu cuenta.',
            'submit' => 'Envíame un correo',
            'option' => '¿Olvidaste tu contraseña?'
        ],
        'reset' => [
            'title' => 'Restablecer contraseña',
            'description' => 'Por favor ingresa el email asociado con tu cuenta y la nueva contraseña que deseas utilizar.',
            'submit' => 'Guardar Contraseña'
        ],
    ],

    'email' => [
        'verification' => [
            'title' => 'Verifica tu Email',
            'description' => 'Antes de continuar, por favor verifica tu email entrando al enlace que te hemos enviado por correo.',
            'submit' => 'Envíame otro correo de verificación',
            'sent' => '¡Un nuevo enlace de verificación ha sido enviado a tu correo!'
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