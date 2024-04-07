<template>

    <Head title="Borrowed Books" />
    <AppLayout>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex justify-between pb-4 bg-white dark:bg-gray-900">
                <div class="flex items-center mt-1">
                    <input type="text" id="table-search" v-model="searchQuery" @input="searchName"
                        class="block pt-2 pl-3 pr-3 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ml-1"
                        placeholder="Seach for Book Name / Borrower ID">
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Book Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Borrower ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="borrow in filteredBorrows" :key="borrow"
                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ borrow.book_name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ borrow.borrower_id }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <b>{{ borrow.status_name }}</b>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-between mx-auto w-1/2">
                                <button @click="viewBorrow(borrow.id)"
                                    class="mr-5 text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    View
                                </button>
                                <button @click="deleteBorrow(borrow.id)"
                                    class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- View Modal -->
        <div ref="add_modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <div
                                        class="cursor-default inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                        </svg>
                                        Borrow Book
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <div
                                            class="cursor-default ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                            View</div>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span
                                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{
                                                addData.title }}</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <button type="button" @click="cancelModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="m-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div>
                            <label for="title" class="block text-sm font-semibold leading-6 text-black">Title</label>
                            <div class="mt-2.5">
                                <input type="text" autocomplete="title" v-model="addData.title" readonly
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="author" class="block text-sm font-semibold leading-6 text-black">Author</label>
                            <div class="mt-2.5">
                                <input type="text" autocomplete="author" v-model="addData.author" readonly
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold leading-6 text-black">Status</label>
                            <select id="status" v-model="addData.status"
                                class="mt-[10px] block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                                <option :value="addData.status" selected hidden>{{ addData.status }}</option>
                                <option :hidden="permission !== true" value=PENDING>PENDING</option>
                                <option :hidden="permission !== true" value=BORROWED>BORROWED</option>
                                <option :hidden="permission !== true" value=RETURNED>RETURNED</option>
                                <option :hidden="permission !== true" value=OVERDUE>OVERDUE</option>
                                <option :hidden="permission !== true" value=LOST>LOST</option>
                                <option :hidden="permission !== true" value=DAMAGED>DAMAGED</option>
                                <option :hidden="permission !== true" value=MISSING>MISSING</option>
                            </select>
                        </div>
                        <div>
                            <label for="genre" class="block text-sm font-semibold leading-6 text-black">Genre</label>
                            <div class="mt-2.5">
                                <input type="text" autocomplete="genre" v-model="addData.genre" readonly
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="message"
                                class="block text-sm font-semibold leading-6 text-green-600">Description</label>
                            <div class="mt-2.5">
                                <textarea v-model="addData.description" rows="7" readonly
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="first-name" class="block text-sm font-semibold leading-6 text-black">Book
                                Cover</label>
                            <div class="mt-2.5 flex justify-center">
                                <div class="flex items-center justify-center w-full">
                                    <img :src="addData.image_path" class="w-64 h-64 mb-4 rounded-lg object-cover"
                                        :alt="addData.title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button @click="cancelModal()" type="button" :class="{ 'mr-5': permission === true }"
                            class="min-w-[9rem] py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Close
                        </button>
                        <button v-show="permission === true" type="button" @click="editBorrow(selectedID)"
                            class="text-white min-w-[9rem] bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3'
import AppLayout from '../../Layouts/App.vue'
import axios from 'axios';
import Swal from 'sweetalert2'

export default {
    data() {
        return {
            filteredBorrows: [],
            searchQuery: '',
            modal: null,
            addData: {
                title: '',
                author: '',
                genre: '',
                description: '',
                status: '',
                image_path: '',
            },
            selectedID: '',
        };
    },
    components: {
        Head,
        AppLayout,
    },
    props: {
        borrowed_books: Object,
        permission: Boolean,
    },
    setup(props) {
    },
    created() {
        this.filteredBorrows = this.borrowed_books;
    },
    methods: {
        editBorrow(id) {
            Swal.fire({
                title: "Do you want to save the changes?",
                showCancelButton: true,
                confirmButtonText: "Save",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(route('edit.borrowed-book', { id: id }), this.addData)
                        .then(response => {
                            Swal.fire("Saved!", response.data.message, "success").then(() => {
                                window.location.reload();
                            });
                        }).catch(error => {
                            Swal.fire('Something went wrong', error.message, "error");
                        });
                }
            });

        },
        deleteBorrow(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('delete.borrowed-book', { id: id }))
                        .then((response) => {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.data.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire('Something went wrong', error.message, "error");
                        });
                }
            });
        },
        viewBorrow(id) {
            this.selectedID = id
            this.addData = []
            axios.get(route('view.borrowed-book', id)).then(response => {
                this.addData = response.data;
                this.modal = new Modal(this.$refs.add_modal, options);
                this.modal.show();
            })
            const options = {
                placement: 'bottom-right',
                backdrop: 'static',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            };
        },
        cancelModal() {
            this.addData = [];
            this.modal.hide();
        },
        searchName() {
            if (!this.searchQuery) {
                this.filteredBorrows = this.borrowed_books;
                return;
            }

            this.filteredBorrows = this.borrowed_books.filter(borrow => {
                return (
                    (borrow.book_name && borrow.book_name.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                    (borrow.borrower && borrow.borrower.toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            });
        },
    },
};
</script>