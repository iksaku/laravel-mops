<?php

namespace iksaku\Laravel\Mops\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Alert extends Component
{
    const TYPE_DEFAULT = 'default';
    const TYPE_INFO = 'info';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';

    public bool $shouldRender = true;

    public ?string $key = null;
    public bool $closeable = true;

    public ?string $title = null;
    public ?string $message = null;

    public ?string $backgroundColor = null;
    public ?string $borderColor = null;
    public ?string $titleColor = null;
    public ?string $textColor = null;

    public function __construct(string $key = null, bool $closeable = true, string $type = null, string $title = null, string $message = null)
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

            // Try to grab alert type it from session data.
            $type = Str::of(session()->get("{$key}.type", 'default'))->lower()->ucfirst();
        }

        $this->closeable = $closeable;

        $this->title = $title;
        $this->message = $message;

        // Call alert type setup (this allows for better customization).
        if (!empty($type) && method_exists($this, $method = "setup{$type}Alert")) {
            $this->{$method}();
        } else {
            $this->setupDefaultAlert();
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

    protected function setupDefaultAlert(): void
    {
        $this->backgroundColor = 'bg-gray-100';
        $this->borderColor = 'border-gray-500';
        $this->titleColor = 'text-gray-800';
        $this->textColor = 'text-gray-700';
    }

    protected function setupInfoAlert(): void
    {
        $this->backgroundColor = 'bg-blue-100';
        $this->borderColor = 'border-blue-500';
        $this->titleColor = 'text-blue-800';
        $this->textColor = 'text-blue-700';
    }

    protected function setupSuccessAlert(): void
    {
        $this->backgroundColor = 'bg-green-100';
        $this->borderColor = 'border-green-500';
        $this->titleColor = 'text-green-800';
        $this->textColor = 'text-green-700';
    }

    protected function setupWarningAlert(): void
    {
        $this->backgroundColor = 'bg-yellow-100';
        $this->borderColor = 'border-yellow-500';
        $this->titleColor = 'text-yellow-800';
        $this->textColor = 'text-yellow-700';
    }

    protected function setupErrorAlert(): void
    {
        $this->backgroundColor = 'bg-red-100';
        $this->borderColor = 'border-red-500';
        $this->titleColor = 'text-red-800';
        $this->textColor = 'text-red-700';
    }
}