<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <!-- Tailwind Elements CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />

    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
    <!-- Styles -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body class="bg-gray-100 py-2">
    @include('components.sidebar')


    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full mb-1">

                <div class="p-8 my-1 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Employee
                    </h2>
                </div>
            </div>
        </div>

        <div class="w-full mb-2">
            <!--Card-->
            <form id="item-form" class="relative rounded-md bg-white" method="post">

                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-3">
                            <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                Name:</label>
                            <input type="text" name="item-serial" id="item-serial"
                                class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                placeholder="4CE0460D0G" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="supplier-name"
                                class="block mb-2 text-sm font-medium text-gray-900">Department:</label>
                            <select data-te-select-init data-te-select-filter="true" name="supplier-name"
                                id="supplier-name" class="shadow-sm w-full p-2.5  editable-input"
                                onchange="toggleCategorySelector()">
                                <option selected hidden value="none">Select your option</option>

                                <option value=""></option>

                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="item-model"
                                class="block mb-2 text-sm font-medium text-gray-900">Position:</label>
                            <input type="text" name="model" id="item-model"
                                class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                placeholder="X250" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-3 flex justify-end items-center mt-5 mr-2">
                            <button type="submit"
                                class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Add
                                Employee</button>
                        </div>



                    </div>

            </form>

        </div>
    </div>


    <!--Card-->
    <div id='suppliers' class="p-8 lg:mt-0 rounded-lg shadow bg-white ">
        <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead class="">
                <tr>
                    <th data-priority="1">Employee Name</th>
                    <th data-priority="2">Department</th>
                    <th data-priority="3">Position</th>
                    <th data-priority="3">Action</th>
                </tr>
            </thead>
            <tbody id="suppliers">

                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td></td>
                    <td class="text-center items-center flex justify-center">
                        <button data-item-id=""
                            class="mr-1 btn btn-primary rounded-3xl text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium text-sm p-1.5 text-center inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="edit" class="w-5"
                                fill="currentcolor">
                                <path
                                    d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z">
                                </path>
                            </svg></button>
                        <label
                            class=" text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium rounded-full text-sm p-1 mr-1 text-center inline-flex items-center cursor-pointer"
                            onclick="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="eye" width="24"
                                fill="currentColor">
                                <path
                                    d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z">
                                </path>
                            </svg>
                        </label>
                        <a href="#" data-brand-id=""
                            class="brand-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2   text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-4" fill="currentcolor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z">
                                </path>
                            </svg>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <!--/Card-->


    </div>
    <!-- Tailwind Elements Script -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

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

</body>


</html>