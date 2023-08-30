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
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">

        <div class="relative mt-2 ml-2">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-200"
                placeholder="Search for items">
        </div>

        <div class="mx-2">
            <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Item Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="py-3">
                            Edit
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="pl-6 py-4 font-normal text-gray-900 dark:text-white whitespace-nowrap">
                            LT-23-00001
                        </th>
                        <td class="px-6 py-4 text-gray-900">
                            Lenovo
                        </td>
                        <td class="px-6 py-4 text-gray-900">
                            T440
                        </td>
                        <td class="px-6 py-4 text-gray-900">
                            Laptop
                        </td>
                        <td class="px-6 py-4 text-gray-900">
                            1
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-500 text-gray-50 rounded-xl px-2 py-1">Deployed</span>
                        </td>
                        <td class="pr-8 py-4 text-middle">
                            <div>
                                <button onclick="openModal()"
                                    class='bg-red-500 text-white p-2 rounded-xl text-2xl font-bold'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/> </svg>
                                </button>
                            </div>

                            <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
                                style="background: rgba(0,0,0,.7);">
                                <div
                                    class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
                                    <div class="modal-content py-4 text-left px-6">
                                        <!--Title-->
                                        <div class="flex justify-between items-center pb-3">
                                            <p class="text-2xl text-gray-700 font-bold w-full text-center">Delete Item</p>
                                            <div class="modal-close cursor-pointer z-50">
                                            </div>
                                        </div>
                                        <!--Body-->
                                        <div class="mb-5 mt-3 text-center">
                                            <p>Are you sure you want to delete this item?
                                            </p>
                                        </div>
                                        <!--Footer-->
                                        <div class="flex justify-center pt-2">
                                            <button
                                                class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                                            <button
                                                class="focus:outline-none px-4 bg-red-500 p-3 ml-3 rounded-lg text-white hover:bg-red-700">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            const modal = document.querySelector('.main-modal');
                            const closeButton = document.querySelectorAll('.modal-close');

                            const modalClose = () => {
                                modal.classList.remove('fadeIn');
                                modal.classList.add('fadeOut');
                                setTimeout(() => {
                                    modal.style.display = 'none';
                                }, 500);
                            }

                            const openModal = () => {
                                modal.classList.remove('fadeOut');
                                modal.classList.add('fadeIn');
                                modal.style.display = 'flex';
                            }

                            for (let i = 0; i < closeButton.length; i++) {

                                const elements = closeButton[i];

                                elements.onclick = (e) => modalClose();

                                modal.style.display = 'none';

                                window.onclick = function(event) {
                                    if (event.target == modal) modalClose();
                                }
                            }
                            </script>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>