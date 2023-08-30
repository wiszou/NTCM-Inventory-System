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




<body class="bg-gray-100 py-2">

    @include('components.sidebar')
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">

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
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50"
                                class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-teal-600 text-center text-[10px]/4"
                                    style="width: 50%">
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
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50"
                                class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-teal-600 text-center text-[10px]/4"
                                    style="width: 90%">
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
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50"
                                class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-teal-600 text-center text-[10px]/4"
                                    style="width: 80%">
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
                            <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="50"
                                class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-red-700 text-center text-[10px]/4"
                                    style="width: 30%">
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
                                    <th
                                        class="pl-4 w-1/5 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Item Name
                                    </th>
                                    <th
                                        class="px-4 w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 ">
                                        Item ID
                                    </th>
                                    <th
                                        class="w-1/4 py-2 border-b-2  border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Log Description
                                    </th>
                                    <th
                                        class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
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
                                <input
                                    class="appearance-none block w-48 bg-grey-lighter text-grey-darker border border-red rounded py-2 px-4 mb-3"
                                    id="grid-first-name" type="text" placeholder="Item ID">
                            </div>
                            <div class="px-3 mb-6 md:mb-0">
                                <label class="font-medium text-sm pb-3 text-gray-800 mb-4" for="grid-last-name">
                                    Holder's Name
                                </label>
                                <input
                                    class="appearance-none block w-48 bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4"
                                    id="grid-last-name" type="text" placeholder="Holder's Name">
                            </div>
                            <div class="px-3 mb-6 md:mb-0">
                                <button
                                    class="bg-teal-500 hover:bg-teal-700 text-white font-regular mr-2 py-2 px-4 rounded-md mt-6">
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
                                    <th
                                        class="pl-4 w-1/4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Item Name
                                    </th>
                                    <th
                                        class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 ">
                                        Item ID
                                    </th>
                                    <th
                                        class="w-1/4 py-2 border-b-2  border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Name
                                    </th>
                                    <th
                                        class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">
                                        Date/Time
                                    </th>
                                    <th
                                        class="w-1/5 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600">

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
                                        <button
                                            class="bg-teal-500 hover:bg-teal-700 text-white font-regular mr-2 py-2 px-4 rounded">
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