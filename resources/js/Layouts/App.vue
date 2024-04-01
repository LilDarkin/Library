<template>
    <div class="min-h-screen bg-gray-100">
        <Topbar />

        <main>
            <Main :message="$page.props.flash.message">
                <slot />
            </Main>
        </main>
    </div>
</template>

<script>
import Topbar from './Navigation/Topbar.vue'
import Main from './Main.vue'
export default {
    components: {
        Topbar,
        Main,
    }
}
</script>
