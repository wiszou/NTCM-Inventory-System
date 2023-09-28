<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suppliers and Brands</title>

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
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Suppliers
                    </h2>
                </div>
            </div>
        </div>

        <div class="flex flex-row">

            <!-- Add Suppliers -->
            <div class="flex flex-wrap space-x-0 space-y-2 md:space-x-2 md:space-y-0 mb-2 mr-1">
                <form id="supplier-form" class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                    @csrf
                    <h2 class="text-gray-900 text-md font-semibold pb-1 px-3">Add Suppliers</h2>
                    <div class="my-1"></div>
                    <div class="bg-ntccolor h-px mb-6"></div>

                    <div class="grid grid-cols-6 gap-6 px-2">

                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Supplier
                                Name:</label>
                            <input type="text" name="supplier-name" id="supplier-name" class="shadow-sm mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="Supplier Name" required>
                            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
                            </script>

                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Contact
                                Number:</label>
                            <div class="flex flex-row">

                                <input type="telephone" name="contact" id="contact" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 mr-6" placeholder="Contact Number" required>

                                <button type="submit" class="text-white w-32 bg-ntccolor hovers:bg-teal-800 focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-7 py-1 text-center">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Suppliers -->

            <!-- Add Brands to Suppliers -->
            <div class="flex flex-wrap md:space-y-0 mb-2 ml-1 w-1/2">
                <form id="supplier-to-brand" class="flex-1 bg-white p-4 shadow rounded-lg ">
                    @csrf
                    <h2 class="text-gray-900 text-md font-semibold pb-1 px-3">Add Brands to Suppliers</h2>
                    <div class="my-1"></div>
                    <div class="bg-ntccolor h-px mb-6"></div>

                    <div class="grid grid-cols-6 gap-6 px-2">

                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Select
                                Brands:</label>
                            <select data-te-select-init data-te-select-placeholder="Example placeholder" name="brand-list[]" id="checkResult" multiple>
                                <option selected hidden>Select Brand</option>
                                <option value=""></option>
                            </select>


                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Add to a
                                Supplier:</label>
                            <div class="flex flex-row">
                                <select data-te-select-init data-te-select-placeholder="Example placeholder" name="brand-list[]" id="checkResult" multiple>
                                    <option selected hidden>Select Supplier</option>
                                    <option value=""></option>
                                </select>

                                <button type="submit" class="text-white bg-ntccolor hovers:bg-teal-800 focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-7 py-2 text-center ml-3">Add</button>
                            </div>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
                        </script>

                    </div>
                </form>
            </div>
            <!-- End Suppliers -->
        </div>



        <!-- List of Suppliers -->
        <!--Card-->
        <div id='suppliers' class="p-8 lg:mt-0 rounded-lg shadow bg-white">
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead class="">
                    <tr>
                        <th data-priority="1">Item Code</th>
                        <th data-priority="2">Supplier Name</th>
                        <th data-priority="3">Contact Number</th>
                        <th data-priority="4">Action</th>
                    </tr>
                </thead>
                <tbody id="suppliers">
                    @foreach ($suppliers as $item)
                    <tr>
                        <td class="text-center">{{ $item->supplier_id }}</td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center">{{ $item->contact }}</td>
                        <td class="text-center">
                            <a href="#" data-supplier-id="{{ $item->supplier_id }}" class="supplier-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15" fill="currentcolor" viewBox="0 0 16 16">
                                    <path d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z">
                                    </path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--/Card-->


    </div>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.supplier-delete-link');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default click behavior
                const supplierId = this.getAttribute('data-supplier-id');

                // Create a custom confirmation dialog
                const confirmation = confirm(
                    `Are you sure you want to delete this supplier?\n\nClick "OK" to delete or "Cancel" to cancel.`
                );

                if (confirmation) {
                    fetch(`/remove-supplier/${supplierId}`, {
                            method: 'GET', // Change to 'POST' if necessary
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                // Handle success (e.g., show a success message)
                                alert('Supplier removed successfully.');
                                // You can also reload the page or update the UI as needed
                                location.reload();
                            } else {
                                // Handle errors (e.g., show an error message)
                                alert('Error: Unable to remove supplier.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('supplier-form');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = new FormData(form);

            fetch('/addSupplier', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Handle a successful response (e.g., show success message)
                        alert('Supplier added successfully.');
                        // You can also reset the form or redirect to another page
                        location.reload();
                    } else {
                        // Handle errors (e.g., show error message)
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>

</html>