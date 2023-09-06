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

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-teal-700">
                        Inventory Logs
                    </h2>
                </div>


                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Logs
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Item Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Custodian
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Borrowed - Laptop Lenovo X250
                                </th>
                                <td class="px-6 py-4">
                                    IT230001
                                </td>
                                <td class="px-6 py-4">
                                    Kai Sotto
                                </td>
                                <td class="px-6 py-4">
                                    2h ago
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</body>

</html>