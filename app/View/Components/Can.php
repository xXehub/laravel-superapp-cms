<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Gate;

class Can extends Component
{
    public $permission;
    public $role;

    /**
     * Create a new component instance.
     */
    public function __construct($permission = null, $role = null)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    /**
     * Determine if the component should be rendered.
     */
    public function shouldRender(): bool
    {
        if ($this->permission) {
            return Gate::allows($this->permission);
        }

        if ($this->role) {
            return auth()->user()?->hasRole($this->role) ?? false;
        }

        return true;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.can');
    }
}
