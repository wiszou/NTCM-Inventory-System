<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Items</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->


    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
    <!-- Styles -->
</head>

<style>
/*Overrides for Tailwind CSS */

/*Form fields*/
.dataTables_wrapper select,
.dataTables_wrapper .dataTables_filter input {
    color: #4a5568;
    /*text-gray-700*/
    padding-left: 1rem;
    /*pl-4*/
    padding-right: 1rem;
    /*pl-4*/
    padding-top: .5rem;
    /*pl-2*/
    padding-bottom: .5rem;
    /*pl-2*/
    line-height: 1.25;
    /*leading-tight*/
    border-width: 1px;
    /*border-2*/
    border-radius: .25rem;
    border-color: #4d4d4d;
    /*border-gray-200*/
    background-color: #ffffff;
    /*bg-gray-200*/
}

/*Row Hover*/
table.dataTable.hover tbody tr:hover,
table.dataTable.display tbody tr:hover {
    background-color: #4facb6;
    /*bg-indigo-100*/
    color: #ffffff;
    font-weight: 400;
}

/*Pagination Buttons*/
.dataTables_wrapper .dataTables_paginate .paginate_button {
    font-weight: 500;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    border: 1px solid transparent;
    /*border border-transparent*/
}

/*Pagination Buttons - Current selected */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    color: #5c5c5c !important;
    /*text-white*/
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    /*shadow*/
    font-weight: 200;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    background: #d6d6d6 !important;
    /*bg-indigo-500*/
    border: 1px solid transparent;
    /*border border-transparent*/
}

/*Pagination Buttons - Hover */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color: #ffffff;
    /*text-white*/
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    /*shadow*/
    font-weight: 400;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    background: #d6d6d6 !important;
    /*bg-indigo-500*/
    border: 1px;
    /*border border-transparent*/

}


/*Change colour of responsive icon*/
table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
    background-color: #4facb6 !important;
    /*bg-indigo-500*/
}


th {
    text-align: left;
    /* Align header text to the left */
}

td {
    text-align: left;
    /* Align cell text to the left */
}
</style>

<body class="bg-gray-100 py-2">

    @include('components.sidebar')

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-teal-700">
                        Add Item
                    </h2>

                </div>
                <!--Card-->
                <form action="#" class="relative bg-white">
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Item
                                    Code</label>
                                <input type="text" name="first-name" id="first-name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Item Code" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Inventory
                                    ID</label>
                                <input type="text" name="last-name" id="last-name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Inventory ID" required="" disabled>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Item
                                    Name:</label>
                                <input type="text" name="email" id="email"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Item Name" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="phone-number"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                                <input type="text" name="phone-number" id="phone-number"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Category" required="">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="department"
                                    class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                <input type="text" name="department" id="department"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Brand" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="company" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                                <input type="text" name="company" id="company"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Model" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="current-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Price:</label>
                                <input type="Number" name="current-password" id="current-password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Price" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900">Serial
                                    Number:</label>
                                <input type="password" name="new-password" id="new-password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Serial" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="current-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Quantity</label>
                                <input type="Number" name="current-password" id="current-password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Quantity" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="current-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Remarks:</label>
                                <input type="Text" name="current-password" id="current-password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Remarks" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="current-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Supplier</label>
                                <input type="text" name="current-password" id="current-password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    placeholder="Supplier" required="" >
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="Status"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Status:</label>
                                <ul class="grid grid-cols-3 gap-x-5">
                                    <li class="">
                                        <input class="peer sr-only" type="radio" value="yes" name="answer" id="yes"
                                            checked />
                                        <label
                                            class="text-sm flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-50 transition-all duration-200 ease-in-out"
                                            for="yes">Spare</label>
                                    </li>
                                    <li class="">
                                        <input class="peer sr-only" type="radio" value="no" name="answer" id="no"
                                             />
                                        <label
                                            class="text-sm flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 transition-all duration-200 ease-in-out"
                                            for="no">Deployed</label>


                                    </li>

                                    <li class="">
                                        <input class="peer sr-only" type="radio" value="yesno" name="answer" id="yesno"
                                             />
                                        <label
                                            class="text-sm flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-orange-500 peer-checked:bg-orange-50 transition-all duration-200 ease-in-out "
                                            for="yesno">Borrowed</label>

                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class=" w-full">

                        </div>
                        <!-- Modal footer -->
                        <div class="flex space-x-2 border-t border-gray-200 rounded-b">
                            <div class=" w-full flex justify-end pt-4">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Add Item</button>


                            </div>
                        </div>
                </form>

            </div>
            <!--/container-->


            <div class="main-modal fixed w-full h-100 inset-0 z-50 flex justify-center items-center animated fadeIn faster"
                style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-3/6 rounded-xl z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold">Edit</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <div class="flex justify-center">
                            <div class="border pt-4 pb-0 rounded-lg w-full">
                                <form action="#" class="relative bg-white">
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="first-name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Item
                                                    Code</label>
                                                <input type="text" name="first-name" id="first-name"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="IT230001" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="last-name"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Inventory
                                                    ID</label>
                                                <input type="text" name="last-name" id="last-name"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="LT-0001" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Item
                                                    Name:</label>
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="Laptop" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone-number"
                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                                                <input type="text" name="phone-number" id="phone-number"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="Device" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="department"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                                <input type="text" name="department" id="department"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="Lenovo" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="company"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                                                <input type="text" name="company" id="company"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="X250" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="current-password"
                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Price:</label>
                                                <input type="Number" name="current-password" id="current-password"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="40,000" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="new-password"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Serial
                                                    Number:</label>
                                                <input type="password" name="new-password" id="new-password"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="4CE0460D0G" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="current-password"
                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Quantity</label>
                                                <input type="Number" name="current-password" id="current-password"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="20" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="current-password"
                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Remarks:</label>
                                                <input type="Text" name="current-password" id="current-password"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                                    placeholder="Returned by Ronald" required="">

                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center pt-5 space-x-2 border-t border-gray-200 rounded-b">

                                            <div class=" w-3/5">
                                                <ul class="grid w-full grid-cols-3 gap-x-5 pr-4">
                                                    <li class="">
                                                        <input class="peer sr-only" type="radio" value="yes"
                                                            name="answer" id="yes" checked />
                                                        <label
                                                            class="text-sm flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-50 transition-all duration-200 ease-in-out"
                                                            for="yes">Spare</label>
                                                    </li>
                                                    <li class="">
                                                        <input class="peer sr-only" type="radio" value="no"
                                                            name="answer" id="no" />
                                                        <label
                                                            class="text-sm flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 transition-all duration-200 ease-in-out"
                                                            for="no">Deployed</label>


                                                    </li>

                                                    <li class="">
                                                        <input class="peer sr-only" type="radio" value="yesno"
                                                            name="answer" id="yesno" />
                                                        <label
                                                            class="text-sm flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-orange-500 peer-checked:bg-orange-50 transition-all duration-200 ease-in-out "
                                                            for="yesno">Borrowed</label>

                                                    </li>
                                                </ul>
                                            </div>
                                            <div class=" w-2/5 flex justify-end">
                                                <button type="submit"
                                                    class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Update</button>
                                                <!--GANA LANG YUNG UPDATE BUTTON FOR STATUS SIGURO?-->
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Save</button>


                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

            <!--Datatables -->
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
            <script>
            $(document).ready(function() {

                var table = $('#example').DataTable({
                        responsive: true
                    })
                    .columns.adjust()
                    .responsive.recalc();
            });
            </script>


            <script>
            const modal = document.querySelector('.main-modal');
            const closeButton = document.querySelectorAll('.modal-close');

            const modalClose = () => {
                modal.classList.remove('fadeIn');
                modal.classList.add('fadeOut');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 0);
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


        </div>
    </div>
</body>


</html>