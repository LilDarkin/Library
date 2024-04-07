<template>

    <Head title="Users" />

    <AppLayout>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex justify-between pb-4 bg-white dark:bg-gray-900">
                <div class="flex items-center mt-1">
                    <input type="text" id="table-search" v-model="searchQuery" @input="searchUsers"
                        class="block pt-2 pl-3 pr-3 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ml-1"
                        placeholder="Seach for Student / Employee ID">
                </div>
                <div class="flex items-center mt-1">
                    <button @click="add_user_modal()"
                        class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Add User
                    </button>
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Student / Employee ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Role
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
                    <tr v-for="user in filteredUsers" :key="user"
                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ user.student_no ?? user.emp_no }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ user.role_name }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full mr-2"
                                    :class="user.active == 'ACTIVE' ? 'bg-green-500' : 'bg-red-500'"></div>{{
                                        user.active }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-between">
                                <button @click="editUser(user)"
                                    class="text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Edit
                                </button>
                                <button @click="deleteUser(user.user_id)"
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

        <!-- ADD USER MODAL -->
        <div ref="add_modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
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
                                        User
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
                                            Add</div>
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
                                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">New
                                            User</span>
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
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Name" v-model="addData.name" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Email" v-model="addData.email" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select id="role" v-model="addData.role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option :value="1" selected hidden>STUDENT</option>
                                    <option value=1>STUDENT</option>
                                    <option value=3>LIBRARIAN</option>
                                    <option value=2>TEACHER</option>
                                </select>
                            </div>
                            <div v-show="addData.role == 3 ? false : true" class="col-span-2 sm:col-span-1">
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                                <select id="role" v-model="addData.department"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="BSIT" selected>BSIT</option>
                                    <option value=1>BSIS</option>
                                    <option value=2>BSCS</option>
                                </select>
                            </div>
                            <div v-show="addData.role == 1" class="col-span-2 sm:col-span-1">
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                                <select id="role" v-model="addData.year"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option :value="1" selected hidden>1</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="contact"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                                <input type="text" name="contact" id="contact"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Contact" v-model="addData.contact" required="">
                            </div>
                        </div>
                        <button type="button" @click="addUser()"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT USER MODAL -->
        <!-- Main modal -->
        <div ref="crudModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
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
                                        User
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
                                            Edit</div>
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
                                                selectedUser.student_no ?? selectedUser.emp_no }}</span>
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
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Name" v-model="formData.name" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Email" v-model="formData.email" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select id="role" v-model="formData.role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option :value="selectedUser.role" selected hidden>{{ selectedUser.role_name }}
                                    </option>
                                    <option value=1>STUDENT</option>
                                    <option value=3>LIBRARIAN</option>
                                    <option value=2>TEACHER</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" @click="updateUser(selectedUser.user_id)"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import Swal from 'sweetalert2'
import { Modal } from 'flowbite'
import AppLayout from '../../Layouts/App.vue'
import { Head } from '@inertiajs/inertia-vue3'
import axios from 'axios';

export default {
    components: {
        AppLayout,
        Head
    },
    data() {
        return {
            searchQuery: '',
            filteredUsers: [],
            selectedUser: [],
            modal: null,
            formData: {
                name: '',
                email: '',
                role: 0,
                user_no: '',
            },
            addData: {
                name: '',
                email: '',
                role: 1,
                department: '',
                year: '',
                contact: '',
            }
        };
    },
    props: {
        users: Array,
    },
    setup(props) {

    },
    created() {
        this.filteredUsers = this.users;
    },
    methods: {
        cancelModal() {
            this.selectedUser = [];
            this.modal.hide();
        },
        searchUsers() {
            if (!this.searchQuery) {
                this.filteredUsers = this.users;
                return;
            }
            this.filteredUsers = this.users.filter(user => {
                return (
                    (user.student_no && user.student_no.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                    (user.emp_no && user.emp_no.toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            });
        },
        addUser() {
            Swal.fire({
                title: "Do you want to add this user?",
                showCancelButton: true,
                confirmButtonText: "Add",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('add.user'), this.addData)
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
        add_user_modal() {
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
        editUser(user) {
            this.selectedUser = user
            this.formData = {
                name: user.name,
                email: user.email,
                role: user.role,
                user_no: user.student_no ?? user.emp_no,
            }
            const options = {
                placement: 'bottom-right',
                backdrop: 'static',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            };

            this.modal = new Modal(this.$refs.crudModal, options);
            this.modal.show();
        },
        updateUser(userID) {
            Swal.fire({
                title: "Do you want to save the changes?",
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(route('edit.user', { id: userID }), this.formData)
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
        deleteUser(userID) {
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
                    axios.delete(route('delete.user', { id: userID }))
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
        }
    }
}
</script>