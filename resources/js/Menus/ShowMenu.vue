<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menu: {{ rmmenu.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <h2>{{ rmmenu.id }}. {{ rmmenu.name }}</h2>
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import Main from "@/Pages/Projectbuilder/Main"

    export default {
        name: "ShowMenu",
        props: {
            rmmenu: Object,
            page: Object
        },
        components: {
            AppLayout,
            Main
        }
    }
</script>

<style scoped>

</style>
