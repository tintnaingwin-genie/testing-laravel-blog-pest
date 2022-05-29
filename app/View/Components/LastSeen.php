<?php

namespace App\View\Components;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class LastSeen extends Component
{
    public BlogPost $post;

    private ?Carbon $lastSeen;

    public function __construct(BlogPost $post)
    {
        $this->post = $post;

        $this->lastSeen = Carbon::make(request()->cookie("last_seen_{$this->post->slug}"));

        Cookie::queue("last_seen_{$this->post->slug}", now()->toDateTimeString());
    }

    public function render()
    {
        return view('components.last-seen', [
            'lastSeen' => $this->lastSeen,
        ]);
    }
}
