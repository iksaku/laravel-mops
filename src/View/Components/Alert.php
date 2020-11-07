<?php

namespace iksaku\Laravel\Mops\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Illuminate\View\Component;

class Alert extends Component
{
    use Macroable;

    private bool $shouldRender = true;
    private ?string $key = null;

    public bool $closeable = true;

    public ?string $title = null;
    public ?string $message = null;

    public ?string $backgroundColor = null;
    public ?string $borderColor = null;
    public ?string $textColor = null;

    public function __construct(string $key = null, bool $closeable = true, string $type = 'default', string $title = null, string $message = null)
    {
        if (!empty($key)) {
            // Skip alert rendering if the provided key is not found in session.
            if (!session()->has($key)) {
                $this->shouldRender = false;
                return;
            }

            // Save the key for later use.
            $this->key = $key;

            // Assign session values to our alert.
            $title = session()->get("{$key}.title");
            $message = session()->get("{$key}.message");
            $type = session()->get("{$key}.type", $type);
            $closeable = session()->get("{$key}.closeable", $closeable);
        }

        $this->closeable = $closeable;

        $this->title = $title;
        $this->message = $message;

        $this->setupAlertPresets();

        try {
            $this->{self::methodFor($type)}();
        } catch (\BadMethodCallException $e) {
            throw new \BadMethodCallException(sprintf(
                'Unable to find alert configuration for type %s.', $type
            ));
        }
    }

    public function shouldRender(): bool
    {
        return $this->shouldRender;
    }

    public function render(): View
    {
        return view('mops::components.alert');
    }

    public static function methodFor(string $type): string
    {
        return (string) Str::of($type)
            ->lower()
            ->ucfirst()
            ->prepend('create')
            ->append('Alert');
    }

    protected function setupAlertPresets(): void
    {
        $presets = [
            'default' => function() {
                $this->backgroundColor = 'bg-gray-100';
                $this->borderColor = 'border-gray-500';
                $this->textColor = 'text-gray-900';
            },
            'info' => function() {
                $this->backgroundColor = 'bg-blue-100';
                $this->borderColor = 'border-blue-500';
                $this->textColor = 'text-blue-900';
            },
            'success' => function() {
                $this->backgroundColor = 'bg-green-100';
                $this->borderColor = 'border-green-500';
                $this->textColor = 'text-green-900';
            },
            'warning' => function() {
                $this->backgroundColor = 'bg-yellow-100';
                $this->borderColor = 'border-yellow-500';
                $this->textColor = 'text-yellow-900';
            },
            'error' => function() {
                $this->backgroundColor = 'bg-red-100';
                $this->borderColor = 'border-red-500';
                $this->textColor = 'text-red-900';
            }
        ];

        foreach ($presets as $type => $closure) {
            $methodName = self::methodFor($type);

            if (!self::hasMacro($methodName)) {
                self::macro($methodName, $closure);
            }
        }
    }
}