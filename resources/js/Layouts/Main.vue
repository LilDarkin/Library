<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 min-h-screen">
                    <div v-if="message" class="text-blue-600 mb-4">
                        {{ message }}
                    </div>
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        message: String
    }
}
</script>