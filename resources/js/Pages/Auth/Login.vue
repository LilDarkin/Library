<template>

    <Head title="Log in" />
    <AuthLayout>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                <li class="me-2" role="presentation">
                    <button @click="changeTab('student-login')"
                        :class="{ 'text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500': activeTab === 'student-login', 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': activeTab !== 'student-login' }"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="student-styled-tab" type="button"
                        role="tab" aria-controls="student-login" aria-selected="false">Student</button>
                </li>
                <li class="me-2" role="presentation">
                    <button @click="changeTab('employee-login')"
                        :class="{ 'text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500': activeTab === 'employee-login', 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': activeTab !== 'employee-login' }"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="employee-styled-tab" type="button"
                        role="tab" aria-controls="employee-login" aria-selected="false">Employee</button>
                </li>
            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div v-show="activeTab === 'student-login'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                id="student-login" role="tabpanel" aria-labelledby="student-tab">

                <form @submit.prevent="studentLoginForm.post(route('login.post'))">
                    <div>
                        <label for="student_no" class="block font-medium text-sm text-gray-700">
                            Student No
                        </label>
                        <input v-model="studentLoginForm.student_no" id="student_no" type="text"
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required autofocus autocomplete="username" />
                        <div v-if="errors.student_no" class="text-red-600">
                            {{ errors.student_no }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700">
                            Password
                        </label>
                        <input v-model="studentLoginForm.password" id="password" type="password"
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" v-model="studentLoginForm.remember"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4">
                            Log in
                        </button>
                    </div>
                </form>

            </div>
            <div v-show="activeTab === 'employee-login'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                id="employee-login" role="tabpanel" aria-labelledby="employee-tab">

                <form @submit.prevent="employeeLoginForm.post(route('login.post'))">
                    <div>
                        <div>
                            <label for="emp_no" class="block font-medium text-sm text-gray-700">
                                Employee No
                            </label>
                            <input v-model="employeeLoginForm.emp_no" id="emp_no" type="text"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required autofocus autocomplete="username" />
                            <div v-if="errors.emp_no" class="text-red-600">
                                {{ errors.emp_no }}
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">
                                Password
                            </label>
                            <input v-model="employeeLoginForm.password" id="password" type="password"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" v-model="employeeLoginForm.remember"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end mt-4">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4">
                                Log in
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/Auth";
import { Head, useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AuthLayout,
        Head,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            activeTab: 'student-login'
        };
    },
    methods: {
        changeTab(tabId) {
            this.activeTab = tabId;
        }
    },
    setup() {
        const employeeLoginForm = useForm({
            emp_no: "",
            password: "",
            remember: false,
        });
        const studentLoginForm = useForm({
            student_no: "",
            password: "",
            remember: false,
        });
        return { employeeLoginForm, studentLoginForm };
    },
};
</script>
