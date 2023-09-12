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
<aside
    class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
    <div>
        <div class="-mx-6 px-6 pt-4 pb-1 mt-2">
            <a href="#" title="home">
                <img src="assets/Logosidebar.png" class="w-full " alt="Inventory System">
            </a>
        </div>

        <!--SIDEBAR CATEGORIES-->
        <ul class="space-y-2 tracking-wide mt-8">
            <li>
                <a href="#" aria-label="dashboard"
                    class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600">
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                            class="fill-current text-gray-400 dark:fill-slate-600"></path>
                        <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                            class="fill-current text-gray-200 group-hover:text-cyan-300"></path>
                        <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                            class="fill-current group-hover:text-sky-300"></path>
                    </svg>
                    <span class="-mr-1">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                            clip-rule="evenodd" />
                        <path class="fill-current text-teal-600 group-hover:text-cyan-600"
                            d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                    </svg>
                    <span class="group-hover:text-teal-600 font-medium text-teal-600">Inventory</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd"
                            d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                            clip-rule="evenodd" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300"
                            d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Records</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                            d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300"
                            d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Suppliers</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300"
                            d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd"
                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="group-hover:text-gray-700">Custodian</span>
                </a>
            </li>
        </ul>
    </div>
    <!--END SIDEBAR CATEGORIES-->
    <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
        <button class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="group-hover:text-gray-700">Logout</span>
        </button>
    </div>
</aside>
<!--END SIDEBAR-->


<div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
    <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
        <!-- component -->
        <div class='bg-sky-300 w-screen h-screen flex justify-center items-start pt-32'>
            <div class='relative searchable-list'>
                <input type='text'
                    class='data-list peer w-30 h-10 rounded-sm bg-white cursor-pointer outline-none text-gray-700
            caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis '
                    spellcheck="false" placeholder="Select a fruit"></input>
                <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]"
                    viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path d="M0 256l512 512L1024 256z"></path>
                </svg>
                <ul class='absolute option-list overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
            left-0 max-w-[120%] min-w-[120%] bg-white rounded-sm   scale-0 opacity-0 
            transition-all 
            duration-200 origin-top-left'>
                </ul>

            </div>
        </div>
        <script>
        // see how to use at the end of the script
        const domParser = new DOMParser();
        const dataList = {
            el: document.querySelector('.data-list'),
            listEl: document.querySelector('.option-list'),
            arrow: document.querySelector(".searchable-list>svg"),
            currentValue: null,
            listOpened: false,
            optionTemplate: `
        <li
			class='data-option select-none break-words inline-block text-sm text-gray-500 bg-gray-100 odd:bg-gray-200 hover:bg-gray-300 hover:text-gray-700 transition-all duration-200 font-bold p-3 cursor-pointer max-w-full '>
				[[REPLACEMENT]]
        </li>
        `,
            optionElements: [],
            options: [],
            find(str) {
                for (let i = 0; i < dataList.options.length; i++) {
                    const option = dataList.options[i];
                    if (!option.toLowerCase().includes(str.toLowerCase())) {
                        dataList.optionElements[i].classList.remove('block');
                        dataList.optionElements[i].classList.add('hidden');
                    } else {
                        dataList.optionElements[i].classList.remove('hidden');
                        dataList.optionElements[i].classList.add('block');
                    }
                }
            },
            remove(value) {
                const foundIndex = dataList.options.findIndex(v => v === value);
                if (foundIndex !== -1) {
                    dataList.listEl.removeChild(dataList.optionElements[foundIndex])
                    dataList.optionElements.splice(foundIndex, 1);
                    dataList.options.splice(value, 1);
                }
            },
            append(value) {
                if (!value || typeof value === 'object' || typeof value === 'symbol' || typeof value === 'function')
                    return;
                value = value.toString().trim();
                if (value.length === 0) return;
                if (dataList.options.includes(value)) return;

                const html = dataList.optionTemplate.replace('[[REPLACEMENT]]', value);
                const targetEle = domParser.parseFromString(html, "text/html").querySelector('li');
                targetEle.innerHTML = targetEle.innerHTML.trim();
                dataList.listEl.appendChild(targetEle);
                dataList.optionElements.push(targetEle);
                dataList.options.push(value);

                if (!dataList.currentValue) dataList.setValue(value);

                targetEle.onmousedown = (e) => {
                    dataList.optionElements.forEach((el, index) => {
                        if (e.target === el) {
                            dataList.setValue(dataList.options[index]);
                            dataList.hideList();
                            return;
                        }
                    })
                }
            },
            setValue(value) {
                dataList.el.value = value;
                dataList.currentValue = value;
            },
            showList() {
                dataList.listOpened = true;
                dataList.listEl.classList.add('opacity-100');
                dataList.listEl.classList.add('scale-100');
                dataList.arrow.classList.add("rotate-0");
            },
            hideList() {
                dataList.listOpened = false;
                dataList.listEl.classList.remove('opacity-100');
                dataList.listEl.classList.remove('scale-100');
                dataList.arrow.classList.remove("rotate-0");
            },
            init() {
                dataList.arrow.onclick = () => {
                    dataList.listOpened ? dataList.hideList() : dataList.showList();
                }
                dataList.el.oninput = (e) => {
                    dataList.find(e.target.value);
                }
                dataList.el.onclick = (el) => {
                    dataList.showList();
                    for (let el of dataList.optionElements) {
                        el.classList.remove('hidden');
                    }
                }
                dataList.el.onblur = (e) => {
                    dataList.hideList();
                    dataList.setValue(dataList.currentValue);
                }
            }
        }

        // how to use
        dataList.init();
        // add items
        const data = ["Apple", "Apple", "Pear", "Avocado", "Pineapple", "Banana", "Peach",
            "Oraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaange", " ", "", null, undefined, [], {}, {
                a: 1
            }
        ];
        data.forEach(v => (dataList.append(v)));

        // remove item
        // dataList.remove("Peach");

        // get selected value
        // dataList.currentvalue;
        </script>
    </div>

    </body>

</html>