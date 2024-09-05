<x-template>
    <?php
    function checkURI($uri)
    {
        if ($_SERVER['REQUEST_URI'] === $uri) {
            echo "bg-gray-900";
        }
    } ?>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />

        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">

                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">

                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/"
                                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 hover:text-white <?php checkURI("/") ?>"
                                aria-current="page">Main menu</a>
                            <a href="/quiz/display/display"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?php checkURI("/quiz/display/display") ?>">all
                                questions</a>
                            <!-- <a href="#"
                                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a> -->
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <?php

                    echo Cache::get("role");
                    ?>
                </div>
                <a href="/account/logout" class="bg-gray-600 rounded-md p-2"><button>logout</button></a>
            </div>
        </div>


        <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <div class=" text-white text-center align-text-top text-xl flex justify-center content-center">
                    Hello, welcome to the quiz!
                </div>


                <div class="mt-6 nav">
                    {{ $slot }}
                </div>


            </div>
        </div>
    </div>
</x-template>
