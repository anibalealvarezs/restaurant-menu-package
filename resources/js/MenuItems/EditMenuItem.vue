<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit: {{ rmmenuitem.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuItemForm :rmmenusection="rmmenusection" :menusections="menusections" :data="setItem" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
    import {computed} from "vue"
    import {usePage} from "@inertiajs/inertia-vue3"
    import PbEdit from "Pub/js/Projectbuilder/pbedit"

    export default {
        extends: PbEdit,
        name: "EditMenuItem",
        props: {
            rmmenusection: Object,
            rmmenuitem: Object,
        },
        components: {
            MenuItemForm,
        },
        computed: {
            setItem() {
                this.rmmenuitem.item = this.rmmenuitem.id
                return this.rmmenuitem
            },
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
