<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>{!! file_get_contents(public_path('css/app.css')) !!}</style>
</head>
<body>
<div class="min-h-screen bg-gray-900 py-6 flex flex-col justify-center sm:py-12 p-20">
    <div class="relative py-3">
        <div
            class="absolute inset-0 bg-gradient-to-r {{ $post->gradient_colors }} transform skew-y-0 -rotate-5 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white sm:p-10">
            <div class="mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="pb-4 text-base space-y-4 leading-9">
                        <p class="font-display text-6xl font-bold">{{ $post->title }}</p>
                    </div>
                    <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7">
                        <div class="md:flex items-end">
                            <div>
                                <h1 class="text-lg font-display uppercase tracking-wider font-extrabold">
                                    <a href="/">My Blog</a>
                                </h1>
                                <p class="text-sm font-bold text-gray-600">
                                    <a href="/">
                                        Laravel
                                        <span class="text-gray-300">/</span>
                                        PHP
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
