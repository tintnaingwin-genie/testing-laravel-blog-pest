@if($lastSeen)
<span class="-mt-3 mx-2 font-display text-xl">.</span>
<span>
    Last seen on {{ $lastSeen->format('Y-m-d H:i:s') }}
</span>
@endif
