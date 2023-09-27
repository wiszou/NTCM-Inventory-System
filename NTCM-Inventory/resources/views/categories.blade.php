
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    .w-16 {
    width: 20px; /* Adjust the width as needed */
    height: 20px; /* Adjust the height as needed */
}
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

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
                        Categories
                    </h2>
                </div>
            </div>
        </div>


        <!-- Categories -->
        <form id="category-form" class="flex-1 bg-white p-4 shadow rounded-lg">
            @csrf <h2 class="text-gray-700 text-md font-semibold pb-1 px-3">Add Brand</h2>
            <div class="my-1"></div>
            <div class="bg-ntccolor h-px mb-6"></div>

            <div class="px-2 flex justify-center">
                <div class="w-1/2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Category
                        Name:</label>
                    <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="Category Name" required>
                </div>
                <div class="w-1/2 px-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Stock Requirement:</label>
                    <input type="number" name="stock" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="Quantity" required>
                </div>

                <div class="w-24 px-2">
                    <label for="specs" class="block mb-2 text-sm font-medium text-gray-900 ">With Specs</label>
                    <input type="checkbox" name="specs" id="specs" value="1" class="w-16 mt-3">
                </div>
            </div>
            <div class="flex space-x-2">
                <div class=" w-full flex justify-end pt-4">
                    <button type="submit" class="text-white bg-ntccolor hovers:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-full text-sm px-7 py-2.5 text-center">Add</button>
                </div>
            </div>
        </form>


        <!-- List of Categories -->
        <div class="flex-1 bg-white p-4 shadow rounded-lg w-full mt-1">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Category Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @foreach ($category as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->category_name }}
                        </th>
                        <td class="px-6 py-4">
                            <a href="#" class="category-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500" data-category-id="{{ $item->category_id }}">
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
    </div>


    </div>




</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('category-form');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = new FormData(form);

            fetch('/addCategory', {
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
                        alert('Category added successfully.');
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.category-delete-link');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default click behavior
                const categoryId = this.getAttribute('data-category-id');

                // Create a custom confirmation dialog
                const confirmation = confirm(`Are you sure you want to delete this category?\n\nClick "OK" to delete or "Cancel" to cancel.`);

                if (confirmation) {
                    fetch(`/remove-category/${categoryId}`, {
                            method: 'GET', // Change to 'POST' if necessary
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                // Handle success (e.g., show a success message)
                                alert('Category removed successfully.');
                                // You can also reload the page or update the UI as needed
                                location.reload();
                            } else {
                                // Handle errors (e.g., show an error message)
                                alert('Error: Unable to remove category.');
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



</html>