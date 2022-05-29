<?php

namespace App\Http\Livewire;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Ramsey\Uuid\Uuid;

class VoteButton extends Component
{
    public BlogPost $post;

    public ?string $likerUuid = null;

    public bool $isLiked = false;

    public function mount()
    {
        $this->isLiked = $this->post->isLikedBy(request()->cookie('liker_id'));

        if (! $this->likerUuid) {
            $this->likerUuid = Cookie::get('liker_id') ?? Uuid::uuid4();

            Cookie::queue('liker_id', $this->likerUuid, 60 * 365 * 10);
        }
    }

    public function render()
    {
        return view('livewire.vote-button');
    }

    public function like()
    {
        if ($this->post->isLikedBy($this->likerUuid)) {
            $this->post->removeLikeBy($this->likerUuid);
            $this->isLiked = false;
        } else {
            $this->post->addLikeBy($this->likerUuid);
            $this->isLiked = true;
        }
    }
}
