<?php

namespace iksaku\Laravel\Mops\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Action extends Component
{
    const TYPE_DEFAULT = 'default';
    const TYPE_INFO = 'info';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';

    public bool $shouldRender = false;

    public string $key;
    public bool $closeable = true;

    public ?string $title;
    public ?string $message;

    public string $backgroundColor;
    public string $titleColor;
    public string $textColor;

    public function __construct(string $key = null)
    {
        if (empty($key) || !session()->has($key)) {
            return;
        }

        $this->key = $key;

        $this->title = session()->get("{$key}.title");
        $this->message = session()->get("{$key}.message");

        $type = Str::of(session()->get("{$key}.type", 'default'))->lower()->ucfirst();
        if (method_exists($this, $method = "setup{$type}Alert")) {
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
        $this->titleColor = 'text-gray-800';
        $this->textColor = 'text-gray-700';
    }

    protected function setupInfoAlert(): void
    {
        $this->backgroundColor = 'bg-blue-100';
        $this->titleColor = 'text-blue-800';
        $this->textColor = 'text-blue-700';
    }

    protected function setupSuccessAlert(): void
    {
        $this->backgroundColor = 'bg-green-100';
        $this->titleColor = 'text-green-800';
        $this->textColor = 'text-green-700';
    }

    protected function setupWarningAlert(): void
    {
        $this->backgroundColor = 'bg-yellow-100';
        $this->titleColor = 'text-yellow-800';
        $this->textColor = 'text-yellow-700';
    }

    protected function setupErrorAlert(): void
    {
        $this->backgroundColor = 'bg-red-100';
        $this->titleColor = 'text-red-800';
        $this->textColor = 'text-red-700';
    }
}