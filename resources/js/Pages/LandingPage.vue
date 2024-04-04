<template>

    <Head title="Home" />
    <AppLayout>
        <div
            class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-b from-purple-600 to-indigo-600">
            <div class="text-center">
                <h1 class="text-white text-6xl font-bold mb-8">Welcome to Your Awesome Website</h1>
                <p class="text-white text-xl mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#"
                    class="bg-white text-purple-600 py-3 px-8 rounded-full text-lg font-semibold hover:bg-purple-100 transition duration-300 ease-in-out">Get
                    Started</a>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3'
import AppLayout from '../Layouts/App.vue'
export default {
    data() {
        return {

        };
    },
    components: {
        Head,
        AppLayout,
    },
    props: {
        user: Object,
    },
    setup(props) {

    }
};
</script>