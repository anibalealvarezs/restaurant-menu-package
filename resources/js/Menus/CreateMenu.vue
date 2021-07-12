<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Menu
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuForm :data="{}" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import Main from "@/Pages/Projectbuilder/Main"
    import MenuForm from "@/Pages/RestaurantMenu/Menus/MenuForm"

    export default {
        name: "CreateMenu",
        props: {
            page: Object
        },
        components: {
            MenuForm,
            AppLayout,
            Main
        }
    }
</script>

<style scoped>

</style>
