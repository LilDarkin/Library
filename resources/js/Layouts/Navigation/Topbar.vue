<template>


    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="#" class="flex items-center mr-5 space-x-3 rtl:space-x-reverse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40">
                        <image href="../../../assets/logo.svg" width="40" height="40" />
                    </svg>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Library
                        System</span>
                </a>
                <button type="button" v-if="$page.props.user"
                    class="flex text-sm rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom" @click="toggleOptions">
                    <span class="sr-only">Open user menu</span>

                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40">
                        <image href="../../../assets/default-user.svg" width="40" height="40" />
                    </svg>
                    <div v-show="options"
                        class="z-50 absolute text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="user-dropdown" style="top: 70px">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ $page.props.user.name }}</span>
                            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{
                    $page.props.user.email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <Link :href="route('logout')" method="post" as="button"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4">
                                Log out
                                </Link>
                            </li>
                        </ul>
                    </div>
                </button>
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto" id="navbar-user">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <Link :href="route('home')" class="md:hover:text-blue-700 md:p-0"
                            :class="{ 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': $page.url === '/' }">
                        Home</Link>
                    </li>
                    <li>
                        <Link :href="route('pages.about')" class="md:hover:text-blue-700 md:p-0"
                            :class="{ 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': $page.url === '/about' }">
                        About</Link>
                    </li>
                    <li>
                        <Link :href="route('books')" class="md:hover:text-blue-700 md:p-0"
                            :class="{ 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': $page.url === '/books' }">
                        Books</Link>
                    </li>
                    <li>
                        <Link :href="route('borrowed-books')" class="md:hover:text-blue-700 md:p-0"
                            :class="{ 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': $page.url === '/borrowed-books' }">
                        Borrowed Books</Link>
                    </li>
                    <li v-show="$page.props.user.role === 0">
                        <Link :href="route('users')" class="md:hover:text-blue-700 md:p-0"
                            :class="{ 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': $page.url === '/users' }">
                        Users</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import axios from 'axios';

export default {
    data() {
        return {
            options: false,
        }
    },
    components: {
        Link
    },
    methods: {
        toggleOptions() {
            this.options = !this.options;
        },
        uploadFile(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('file', file);

            axios.post('/api/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    console.log('File uploaded:', response.data);
                })
                .catch(error => {
                    console.error('Error uploading file:', error);
                });
        }
    }
}
</script>
