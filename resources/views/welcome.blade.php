<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Link shortener</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css','resources/js/app.js'])        
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="w-full mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g fill="none" fill-rule="evenodd"><path d="M18 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h5M15 3h6v6M10 14L20.2 3.8"/></g></svg>
                </div>

                <div class="mt-8 w-full">
                    <div class="flex justify-center gap-2 lg:gap-4 ">
                        <div class="w-full p-2 bg-gray-300 border border-spacing-1 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="w-full">
                                <form id="inputLinkForm" method="POST" enctype="multipart/form-data">
                                    <h2 class="my-2 text-lg font-semibold text-gray-900 dark:text-white text-center">Сокращатель ссылок</h2>
                                    <div class="w-full px-3" id="inputDiv">
                                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="url" placeholder="http://example.com/something/etc" name="inputLink" required>
                                        <p class="text-gray-700 text-xs italic">Вставьте любую ссылку</p>
                                    </div>
                                    <div class="text-center w-full mb-2 mt-3">
                                      <button class="p-2 m-2 rounded-md bg-gray-700 text-white place-self-center">Сократить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 w-full">
                    <div class="flex  justify-center gap-6 lg:gap-8 ">
                        <ol id="results" class="list-decimal grid md:grid-rows-5 md:grid-flow-col">
                            @foreach ($links as $link)
                                <li class="m-2 p-2 mx-5 text-blue-500 underline " value="{{$link->counter}}"><a href="{{$link->inputLink}}" target="_blank">{{$link->outputLink}}</a></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">
                            
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
