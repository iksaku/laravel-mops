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
            'description' => <<<desc
We can help you recover your password. <br>
Please provide the email associated to your <br>
account and we will send you a reset link.
desc,
            'option' => 'Forgot your Password?',
            'action' => 'Send me a Reset Link'
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