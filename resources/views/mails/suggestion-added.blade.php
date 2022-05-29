@component('mail::message')
# A new suggestion was added:

- {{ $title }}
- [{{ $url }}]({{ $url }})

@component('mail::button', ['url' => action([\App\Http\Controllers\ExternalPostAdminController::class, 'index'])])
Show suggestion
@endcomponent
@endcomponent
