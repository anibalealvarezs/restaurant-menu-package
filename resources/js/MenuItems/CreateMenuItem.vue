<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Menu Dish
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuItemForm :rmmenusection="{}" :menusections="menusections" :data="{}" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
    import {computed} from "vue"
    import {usePage} from "@inertiajs/inertia-vue3"
    import PbCreate from "Pub/js/Projectbuilder/pbcreate"

    export default {
        extends: PbCreate,
        name: "CreateItem",
        components: {
            MenuItemForm,
        },
        setup () {

            const allowed = computed(() => usePage().props.value.shared.allowed)
            const menusections = computed(() => usePage().props.value.shared.menusections)
            const defaults = computed(() => usePage().props.value.shared.defaults)
            const required = computed(() => usePage().props.value.shared.required)

            return { allowed, menusections, defaults, required }
        }
    }
</script>

<style scoped>

</style>
