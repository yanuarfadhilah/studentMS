<nav class="fixed top-0 z-50 w-full  border-b bg-gray-800 border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                    aria-controls="logo-sidebar" type="button"
                    class="inline-flex items-center p-2 text-sm rounded-lg sm:hidden focus:outline-none focus:ring-2  text-gray-400 hover:bg-gray-700 focus:ring-gray-600">
                    <span class="sr-only"></span>
                    <i class="fas fa-grip-horizontal"> </i>
                </button>
                <a href="{{route('dashboard')}}" class="flex ml-2 md:mr-24">
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Student MS</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <img class="w-8 h-8 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none divide-y rounded shadow bg-gray-700 divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-white " role="none">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm font-medium text-white truncate" role="none">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{route('logout')}}"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-100 hover:text-black"
                                    role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full  border-r sm:translate-x-0 bg-gray-800 border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('dashboard')}}"
                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 hover:text-black">
                    <i class="fas fa-dashboard"> </i>
                    <span class="ml-3">Dashboard </span>
                </a>
            </li>
            <li>
                <a href="{{route('user.index')}}"
                    class="flex items-center p-2 text-white rounded-lg  hover:bg-gray-100 hover:text-black">
                    <i class="fas fa-user"> </i>
                    <span class="flex-1 ml-3 whitespace-nowrap">User</span>
                </a>
            </li>
            <li>
                <a href="{{route('student.index')}}"
                    class="flex items-center p-2 text-white rounded-lg  hover:bg-gray-100 hover:text-black">
                    <i class="fas fa-children"> </i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Student</span>
                </a>
            </li>
            <li>
                <a href="{{route('class.index')}}"
                    class="flex items-center p-2 text-white rounded-lg  hover:bg-gray-100 hover:text-black">
                    <i class="fas fa-school"> </i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Class</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
