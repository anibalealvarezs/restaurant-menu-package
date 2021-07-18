<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit: {{ rmmenusection.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuSectionForm :rmmenu="rmmenu" :menus="menus" :data="setItem" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import MenuSectionForm from "@/Pages/RestaurantMenu/MenuSections/MenuSectionForm"
    import {computed} from "vue"
    import {usePage} from "@inertiajs/inertia-vue3"
    import PbEdit from "Pub/js/Projectbuilder/pbedit"

    export default {
        extends: PbEdit,
        name: "EditMenuSection",
        props: {
            rmmenu: Object,
            rmmenusection: Object,
        },
        components: {
            MenuSectionForm,
        },
        computed: {
            setItem() {
                this.rmmenusection.item = this.rmmenusection.id
                return this.rmmenusection
            },
        },
        setup () {

            const allowed = computed(() => usePage().props.value.shared.allowed)
            const menus = computed(() => usePage().props.value.shared.menus)
            const defaults = computed(() => usePage().props.value.shared.defaults)
            const required = computed(() => usePage().props.value.shared.required)

            return { allowed, menus, defaults, required }
        }
    }
</script>

<style scoped>

</style>
