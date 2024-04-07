<template>

    <Head title="Books" />
    <AppLayout>

        <!-- Search -->
        <div class="mx-auto w-1/2 flex justify-between text-center">
            <div class="relative" :class="{ 'w-full': permission !== true }">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" v-model="searchTerm" @input="searchBooks"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 py-2.5 pr-2.5 "
                    placeholder="Search book name..." required />
            </div>
            <button v-show="permission === true" @click="add_book_modal()"
                class="px-4 py-2 w-15 h-10 bg-blue-500 text-white rounded-lg focus:outline-none">
                Add Book
            </button>
        </div>
        <!-- End of Search -->

        <!-- Main Content -->
        <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
            <div class="mb-4 border-b border-gray-200 ">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                    <li class="me-2" role="presentation">
                        <button @click="changeTab('all-genre')"
                            :class="{ 'text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 ': activeTab === 'all-genre', 'text-gray-900 border border-white hover:border-gray-200  bg-white': activeTab !== 'all-genre' }"
                            class="focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 "
                            id="student-styled-tab" type="button" role="tab" aria-controls="all-genre"
                            aria-selected="false">All Genre</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button @click="changeTab('thriller')"
                            :class="{ 'text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 ': activeTab === 'thriller', 'text-gray-900 border border-white hover:border-gray-200  bg-white': activeTab !== 'thriller' }"
                            class="focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 "
                            type="button" role="tab" aria-controls="thriller" aria-selected="false">Thriller</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button @click="changeTab('fiction')"
                            :class="{ 'text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 ': activeTab === 'fiction', 'text-gray-900 border border-white hover:border-gray-200  bg-white': activeTab !== 'fiction' }"
                            class="focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 "
                            type="button" role="tab" aria-controls="fiction" aria-selected="false">Fiction</button>
                    </li>
                </ul>
            </div>
        </div>

        <div id="default-styled-tab-content">
            <div v-show="activeTab === 'all-genre'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="all-genre"
                role="tabpanel" aria-labelledby="all-genre-tab">
                <h3
                    class="text-3xl select-none text-center font-bold text-blue-700 py-2 px-4 rounded-md shadow-md border border-blue-700 hover:shadow-lg transition duration-300">
                    All Genre
                </h3>
                <div class="grid mt-5 grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="book in filteredBooks" :key="book" class="flex flex-col items-center">
                        <h3 class="select-none mb-2 text-lg font-semibold text-gray-900">{{ book.title }}</h3>
                        <img class="w-64 h-64 rounded-lg transition-transform duration-300 transform hover:scale-110 cursor-pointer"
                            @click="viewBook(book)" :src="book.image_path" alt="">
                    </div>
                </div>
            </div>
            <div v-show="activeTab === 'thriller'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="thriller"
                role="tabpanel" aria-labelledby="thriller-tab">
                <h3
                    class="text-3xl select-none text-center font-bold text-blue-700 py-2 px-4 rounded-md shadow-md border border-blue-700 hover:shadow-lg transition duration-300">
                    Thriller
                </h3>
                <div class="grid mt-5 grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="book in filteredBooks" :key="book" class="flex flex-col items-center">
                        <h3 class="select-none mb-2 text-lg font-semibold text-gray-900">{{ book.title }}</h3>
                        <img class="w-64 h-64 rounded-lg transition-transform duration-300 transform hover:scale-110 cursor-pointer"
                            @click="viewBook(book)" :src="book.image_path" alt="">
                    </div>
                </div>
            </div>
            <div v-show="activeTab === 'fiction'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="fiction"
                role="tabpanel" aria-labelledby="fiction-tab">
                <h3
                    class="text-3xl select-none text-center font-bold text-blue-700 py-2 px-4 rounded-md shadow-md border border-blue-700 hover:shadow-lg transition duration-300">
                    Fiction
                </h3>
                <div class="grid mt-5 grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="book in filteredBooks" :key="book" class="flex flex-col items-center">
                        <h3 class="select-none mb-2 text-lg font-semibold text-gray-900">{{ book.title }}</h3>
                        <img class="w-64 h-64 rounded-lg transition-transform duration-300 transform hover:scale-110 cursor-pointer"
                            @click="viewBook(book)" :src="book.image_path" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Start of Add/Edit/Delete Book Modal -->
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
                                        Book
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
                                            {{ action }}</div>
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
                                            action_status}}</span>
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
                                <input type="text" autocomplete="title" v-model="addData.title" required
                                    :readonly="permission !== true" :class="{ 'select-none': permission !== true }"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="author" class="block text-sm font-semibold leading-6 text-black">Author</label>
                            <div class="mt-2.5">
                                <input type="text" autocomplete="author" v-model="addData.author" required
                                    :readonly="permission !== true" :class="{ 'select-none': permission !== true }"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="genre" class="block text-sm font-semibold leading-6 text-black">Genre</label>
                            <select id="genre" v-model="addData.genre" required
                                :class="{ 'select-none': permission !== true }"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="thriller" selected hidden>Thriller</option>
                                <option value='thriller' :hidden="permission !== true">Thriller</option>
                                <option value='fiction' :hidden="permission !== true">Fiction</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message"
                                class="block text-sm font-semibold leading-6 text-green-600">Description</label>
                            <div class="mt-2.5">
                                <textarea v-model="addData.description" rows="7" required
                                    :readonly="permission !== true" :class="{ 'select-none': permission !== true }"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="first-name" class="block text-sm font-semibold leading-6 text-black">Book
                                Cover</label>
                            <div class="mt-2.5 flex justify-center">
                                <div class="flex items-center justify-center w-full">
                                    <img v-show="addData.image_path !== null && permission !== true"
                                        :src="addData.image_path" class="w-64 h-64 mb-4 rounded-lg object-cover"
                                        alt="Selected Image">
                                    <label v-show="permission === true" for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-30 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <!-- Display the selected image -->
                                            <img v-show="addData.image_path !== null" :src="addData.image_path"
                                                class="w-32 h-32 mb-4 rounded-lg object-cover" alt="Selected Image">
                                            <svg v-show="addData.image_path === null"
                                                class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (MAX. 2048MB)
                                            </p>
                                        </div>
                                        <input id="dropzone-file" accept="image/*" @change="uploadFile" type="file"
                                            class="hidden" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex justify-between items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button v-show="action !== 'View' || permission !== true" @click="cancelModal()" type="button"
                            class="min-w-[9rem] py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Cancel
                        </button>
                        <button v-show="action === 'View' && permission === true" type="button" @click="deleteBook()"
                            class="text-white min-w-[9rem] bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Delete
                        </button>
                        <button v-show="action === 'View'" type="button" @click="borrowBook()"
                            class="text-white min-w-[9rem] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Borrow
                        </button>
                        <button v-show="action === 'View' && permission === true" type="button" @click="editBook()"
                            class="text-white min-w-[9rem] bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </button>
                        <button v-show="action !== 'View' && permission === true" type="button" @click="addBook()"
                            class="text-white min-w-[9rem] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Add Book Modal -->
    </AppLayout>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3'
import AppLayout from '../../Layouts/App.vue'
import Swal from 'sweetalert2'
import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            activeTab: 'all-genre',
            filteredBooks: [],
            searchTerm: '',
            addData: {
                title: '',
                author: '',
                genre: '',
                description: '',
                image_path: '',
            },
            selectedBook: [],
            action: '',
            action_status: '',
        };
    },
    components: {
        Head,
        AppLayout,
    },
    props: {
        books: Array,
        permission: Boolean,
        user: Object,
    },
    setup() {
    },
    created() {
        this.filteredBooks = this.books
    },
    methods: {
        borrowBook() {
            console.log(this.selectedBook[0].id)
            const data = {
                book_id: this.selectedBook[0].id,
                user_id: this.user.student_no ?? this.user.emp_no,
            }

            Swal.fire({
                title: "Do you want to borrow this book?",
                showCancelButton: true,
                confirmButtonText: "Borrow",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('add.borrowed-book'), data)
                        .then(response => {
                        Swal.fire("Yehey!", response.data.message, "success").then(() => {
                            window.location.reload();
                        });
                    })
                        .catch(error => {
                            Swal.fire('Something went wrong', error.message, "error");
                        });
                }
            });
        },
        deleteBook() {
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
                    axios.delete(route('delete.book', { id: this.selectedBook[0].id }))
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
        editBook() {
            Swal.fire({
                title: "Do you want to save the changes?",
                showCancelButton: true,
                confirmButtonText: "Save",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(route('edit.book', { id: this.selectedBook[0].id }), this.addData)
                        .then(response => {
                            Swal.fire("Saved!", response.data.message, "success").then(() => {
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire('Something went wrong', error.message, "error");
                        });
                }
            });
        },
        viewBook(book) {
            this.selectedBook = [book]
            this.action = 'View'
            this.action_status = this.selectedBook[0].title
            this.addData = {
                title: this.selectedBook[0].title,
                author: this.selectedBook[0].author,
                genre: this.selectedBook[0].genre,
                description: this.selectedBook[0].description,
                image_path: this.selectedBook[0].image_path,
            };
            const options = {
                placement: 'bottom-right',
                backdrop: 'static',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            };

            this.modal = new Modal(this.$refs.add_modal, options);
            this.modal.show();
        },
        addBook() {
            const formData = new FormData();
            formData.append('image_path', this.addData.image_path);
            formData.append('title', this.addData.title);
            formData.append('author', this.addData.author);
            formData.append('genre', this.addData.genre);
            formData.append('description', this.addData.description);

            Swal.fire({
                title: "Do you want to add this book?",
                showCancelButton: true,
                confirmButtonText: "Add",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('add.book'), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(response => {
                        Swal.fire("Added!", response.data.message, "success").then(() => {
                            window.location.reload();
                        });
                    })
                        .catch(error => {
                            Swal.fire('Something went wrong', error.message, "error");
                        });
                }
            });
        },
        getImageUrl(file) {
            if (window.URL && window.URL.createObjectURL) {
                return window.URL.createObjectURL(file);
            } else {
                console.error('URL.createObjectURL is not supported in this environment.');
                return '';
            }
        },
        add_book_modal() {
            this.selectedBook = null;
            this.addData = [];
            this.addData.image_path = null;
            this.action = 'Add'
            this.action_status = 'New Book'
            const options = {
                placement: 'bottom-right',
                backdrop: 'static',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            };

            this.modal = new Modal(this.$refs.add_modal, options);
            this.modal.show();
        },
        cancelModal() {
            this.selectedUser = [];
            this.modal.hide();
        },
        changeTab(tabId) {
            this.searchTerm = '';

            this.activeTab = tabId;
            if (tabId !== 'all-genre') {
                this.filteredBooks = this.books.filter(book => book.genre === tabId);
            } else {
                this.filteredBooks = this.books;
            }
        },
        searchBooks() {
            if (this.activeTab === 'all-genre') {
                this.filteredBooks = this.books;
            } else {
                this.filteredBooks = this.books.filter(book => book.genre === this.activeTab);
            }
            this.filterBooks();
        },
        filterBooks() {
            const searchTerm = this.searchTerm.toLowerCase();
            this.filteredBooks = this.filteredBooks.filter(book => book.title.toLowerCase().includes(searchTerm));
        },
        uploadFile(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('file', file);
            axios.post(route('upload.book.image'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.addData.image_path = response.data.path;
                })
                .catch(error => {
                    console.error('Error uploading file:', error);
                });
        }
    }
};
</script>