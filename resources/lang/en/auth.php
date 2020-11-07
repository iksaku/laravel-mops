<?php

return [
    'account' => 'Account',

    'login' => [
        'title' => 'Login to your Account',
        'action' => 'Login',
        'option' => 'Or login to your account'
    ],

    'logout' => 'Logout',

    'register' => [
        'title' => 'Create an Account',
        'action' => 'Register',
        'option' => 'Or create an account'
    ],

    '2fa' => [
        'title' => 'Two Factor Challenge',
        'description' => [
            'otp' => 'Please enter your One Time Password',
            'recovery-code' => 'Please provide one of your Recovery Codes'
        ],
        'options' => [
            'otp' => 'Or use your One Time Password',
            'recovery-code' => 'Use a Recovery Code instead'
        ]
    ],

    'password' => [
        'confirm' => [
            'title' => 'Confirm your Identity',
            'description' => 'Please enter your Password to continue'
        ],
        'forgot' => [
            'title' => 'Recover my Password',
            'description' => 'If you forgot your password, we can send you a recovery link to the email associated to your account.',
            'action' => 'Send me a Recovery Link',
            'option' => 'Forgot your Password?'
        ],
        'reset' => [
            'title' => 'Recover my Password',
            'description' => 'Please provide the email address associated with your account and your new password to continue.',
            'action' => 'Save Password'
        ],
    ],

    'email' => [
        'verification' => [
            'title' => 'Email Verification',
            'description' => 'Before continuing, please verify your email address by clicking the link we sent you.',
            'action' => 'Send me another verification email',
            'sent' => 'A new verification link has been sent to your email!'
        ]
    ],

    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password-confirmation' => 'Confirm your Password',
        'remember' => 'Remember',

        'otp' => 'One Time Password',
        'recovery-code' => 'Recovery Code'
    ]
];