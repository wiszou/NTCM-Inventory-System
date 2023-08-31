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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-200"
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
                <tbody id="inventoryTableBody">

                    <!-- This is where the JavaScript will populate the table rows -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Function to fetch and update inventory data
        function updateInventoryTable() {
            $.ajax({
                url: '/get-updated-inventory',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const inventory = response.inventory;
                    const tableBody = $('#inventoryTableBody');
                    tableBody.empty(); // Clear the existing table rows

                    // Loop through the inventory data and populate the table
                    inventory.forEach(function(item) {
                        // Handle the item status in JavaScript
                        let statusText = '';
                        let statusClass = '';

                        if (item.item_status == 0) {
                            statusText = 'On Stock';
                            statusClass = 'bg-green-500';
                        } else if (item.item_status == 1) {
                            statusText = 'Borrowed';
                            statusClass = 'bg-orange-500';
                        } else if (item.item_status == 2) {
                            statusText = 'Deployed';
                            statusClass = 'bg-blue-500';
                        }

                        const newRow = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-${item.item_id}" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-${item.item_id}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="pl-6 py-4 font-normal text-gray-900 dark:text-white whitespace-nowrap">
                                ${item.item_id}
                            </th>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.brand}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.model}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.category}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.current_quantity}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                <span class="${statusClass} text-gray-50 rounded-xl px-2 py-1">${statusText}</span>
                            </td>
                            <td class="pr-8 py-4 text-middle">

                            </td>
                        </tr>
                    `;

                        tableBody.append(newRow);
                    });
                }
            });
        }

        // Initial update when the page loads
        updateInventoryTable();

        // Set an interval to periodically update the inventory
        setInterval(updateInventoryTable, 5000); // Update every 5 seconds (adjust as needed)
    });
    </script>
</body>

</html>