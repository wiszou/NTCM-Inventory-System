<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <!-- Styles -->
</head>

<!--SIDEBAR-->
<aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
    <div>
        <div class="-mx-6 px-6 pt-4 pb-1 mt-2">
            <a href="#" title="home">
                <img src="assets/Logosidebar.png" class="w-full " alt="Inventory System">
            </a>
        </div>

        <!--SIDEBAR CATEGORIES-->
        <ul class="space-y-2 tracking-wide mt-8">
            <li>
                <a href="#" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-teal-600">
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-teal-400 dark:fill-slate-600"></path>
                        <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current text-teal-200 group-hover:text-teal-300"></path>
                        <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current group-hover:text-sky-300"></path>
                    </svg>
                    <span class="-mr-1 font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Inventory</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Records</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Suppliers</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    <span class="group-hover:text-gray-700">Custodian</span>
                </a>
            </li>
        </ul>
    </div>
    <!--END SIDEBAR CATEGORIES-->
    <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
        <a class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group" href="{{ route('logout') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="group-hover:text-gray-700">Logout</span>
        </a>
    </div>
</aside>
<!--END SIDEBAR-->


<div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
    <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
        <div class="px-6 flex items-center justify-between space-x-4 2xl:container">

            <!--search bar -->
            <div hidden class="md:block w-80">
                <div class="relative flex items-center text-gray-400">
                    <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                        <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 fill-current" viewBox="0 0 35.997 36.004">
                            <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z">
                            </path>
                        </svg>
                    </span>
                    <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here" class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-gray-300">
                </div>
            </div>
            <button class="w-12 h-16 -mr-2 border-r lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <!--/search bar -->

            <!--notification-->
            <div class="flex space-x-4">
                <button aria-label="search" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200 md:hidden">
                    <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 mx-auto fill-current text-gray-600" viewBox="0 0 35.997 36.004">
                        <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z">
                        </path>
                    </svg>
                </button>
                <button aria-label="notification" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                </button>
                <button aria-label="person" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                </button>

            </div>
        </div>
    </div>
    <!--End notification-->


    <body class="bg-gray-100 py-2">

        <div class="grid grid-rows-3 grid-flow-col">

            <div class="col-span-2">
                <!--1ST CONTAINER-->
                <div class="mx-4 my-4 h-50 pt-4 pb-7 px-6 rounded-xl border border-gray-200 bg-white shadow-sm">

                    <p class="font-medium text-md pb-3 text-gray-800">Spare Overview</p>
                    <!--PROGRESS BAR1-->
                    <div class="flex flex-row ">
                        <div class="flex w-1/2 pl-10 py-1">
                            <p class="font-medium text-gray-700">Laptop</p>
                        </div>
                        <div class="w-full pt-2 pr-10">
                            <span id="ProgressLabel" class="sr-only">Loading</span>
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50" class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-teal-600 text-center text-[10px]/4" style="width: 50%">
                                    <span class="font-bold text-white">13</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--END PROGRESS BAR1-->

                    <!--PROGRESS BAR2-->
                    <div class="flex flex-row ">
                        <div class="flex w-1/2 pl-10 py-1">
                            <p class="font-medium text-gray-700">Monitor</p>
                        </div>
                        <div class="w-full pt-2 pr-10">
                            <span id="ProgressLabel" class="sr-only">Loading</span>
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50" class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-teal-600 text-center text-[10px]/4" style="width: 90%">
                                    <span class="font-bold text-white">5</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--END PROGRESS BAR2-->

                    <!--PROGRESS BAR3-->
                    <div class="flex flex-row ">
                        <div class="flex w-1/2 pl-10 py-1">
                            <p class="font-medium text-gray-700">Mouse</p>
                        </div>
                        <div class="w-full pt-2 pr-10">
                            <span id="ProgressLabel" class="sr-only">Loading</span>
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50" class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-teal-600 text-center text-[10px]/4" style="width: 80%">
                                    <span class="font-bold text-white">25</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--END PROGRESS BAR3-->

                    <!--PROGRESS BAR4-->
                    <div class="flex flex-row ">
                        <div class="flex w-1/2 pl-10 py-1">
                            <p class="font-medium text-gray-700">Projector</p>
                        </div>
                        <div class="w-full pt-2 pr-10">
                            <span id="ProgressLabel" class="sr-only">Loading</span>
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50" class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-red-700 text-center text-[10px]/4" style="width: 30%">
                                    <span class="font-bold text-white"> 2</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--END PROGRESS BAR4-->
                </div>
                <!--END 1ST CONTAINER-->
            </div>

            <div class="row-span-2 col-span-2">
                <!--3RD CONTAINTER-->
                <div class="mx-4 h-50 pt-4 pb-7 px-6 rounded-xl border border-gray-200 bg-white shadow-sm">
                    <p class="font-medium text-md pb-3 text-gray-800">Recent Item Logs</p>
                    <div class="shadow rounded-lg">
                        <table class="min-w-full">
                            <thead class="sticky top-0">
                                <tr>
                                    <th class="pl-4 w-1/5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Item Name
                                    </th>
                                    <th class="px-4 w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 ">
                                        Item ID
                                    </th>
                                    <th class="w-1/4 py-2 border-b-2  border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Log Description
                                    </th>
                                    <th class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-4 w-12 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <p class="text-gray-900">
                                                Lenovo
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 w-10 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">LT-002</p>
                                    </td>
                                    <td class="w-1/4 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Deployed at Bridge A
                                        </p>
                                    </td>
                                    <td class="w-1/5 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            07/02/2023
                                        </p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <!--END 3RD CONTAINER-->
            </div>

            <div class="row-span-3">
                <!--2ND CONTAINTER-->
                <div class="my-4 mr-4 py-3 px-6 rounded-xl border border-gray-200 bg-white shadow-sm">
                    <p class="font-medium text-md pb-3 text-gray-800">Temporary Lend Items</p>
                    <div class="py-2 pb-8 lex flex-col my-2">
                        <div class="-mx-3 md:flex justify-center">
                            <div class="px-3 md:mb-0">
                                <label class="font-medium text-sm pb-3 text-gray-800 mb-3" for="grid-first-name">
                                    Item ID
                                </label>
                                <input class="appearance-none block w-48 bg-grey-lighter text-grey-darker border border-red rounded py-2 px-4 mb-3" id="grid-first-name" type="text" placeholder="Item ID">
                            </div>
                            <div class="px-3 mb-6 md:mb-0">
                                <label class="font-medium text-sm pb-3 text-gray-800 mb-4" for="grid-last-name">
                                    Holder's Name
                                </label>
                                <input class="appearance-none block w-48 bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4" id="grid-last-name" type="text" placeholder="Holder's Name">
                            </div>
                            <div class="px-3 mb-6 md:mb-0">
                                <button class="bg-teal-500 hover:bg-teal-700 text-white font-regular mr-2 py-2 px-4 rounded-md mt-6">
                                    Add
                                </button>
                            </div>
                        </div>
                        <div class="bg-gray-100 rounded-lg mx-3 py-2">
                            <span class="ml-5 font-medium text-md text-gray-600">Laptop - Lenovo - Thinkpad X250 - LT-2
                            </span>
                        </div>
                        <!--Table-->
                        <table class="mx-3 mt-6 shadow-sm rounded-sm">
                            <thead class="sticky top-0">
                                <tr>
                                    <th class="pl-4 w-1/4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Item Name
                                    </th>
                                    <th class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 ">
                                        Item ID
                                    </th>
                                    <th class="w-1/4 py-2 border-b-2  border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Name
                                    </th>
                                    <th class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Date/Time
                                    </th>
                                    <th class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-4 w-12 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <p class="text-gray-900">
                                                Lenovo
                                            </p>
                                        </div>
                                    </td>
                                    <td class="w-10 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">LT-002</p>
                                    </td>
                                    <td class="w-1/4 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Kyle Dela Pena
                                        </p>
                                    </td>
                                    <td class="w-1/5 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            07/02/2023<br>12:00:00
                                        </p>
                                    </td>
                                    <td class="w-1/5 py-2 border-b border-gray-200 bg-white text-sm">
                                        <button class="bg-teal-500 hover:bg-teal-700 text-white font-regular mr-2 py-2 px-4 rounded">
                                            Returned
                                        </button>

                                        </p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <!--END 2ND CONTAINER-->
            </div>

        </div>



    </body>

</html>