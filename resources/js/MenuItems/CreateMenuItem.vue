<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Menu Dish
            </h2>
        </template>

        <Main>
            <slot>
                <!-- {{ menusections }} -->
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuItemForm :rmmenusection="{}" :menusections="menusections" :data="{}" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import Main from "@/Pages/Projectbuilder/Main"
    import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
    import {computed} from "vue";
    import {usePage} from "@inertiajs/inertia-vue3";

    export default {
        name: "CreateItem",
        props: {
            page: Object
        },
        components: {
            MenuItemForm,
            AppLayout,
            Main
        },
        setup (props) {

            const allowed = computed(() => usePage().props.value.shared.allowed)
            const menusections = computed(() => usePage().props.value.shared.menusections)

            return { allowed, menusections }
        }
    }
</script>

<style scoped>

</style>
