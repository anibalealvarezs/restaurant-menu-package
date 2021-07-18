<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Menu Section
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuSectionForm :rmmenu="{}" :menus="menus" :data="{}" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import MenuSectionForm from "@/Pages/RestaurantMenu/MenuSections/MenuSectionForm"
    import {computed} from "vue"
    import {usePage} from "@inertiajs/inertia-vue3"
    import PbCreate from "Pub/js/Projectbuilder/pbcreate"

    export default {
        extends: PbCreate,
        name: "CreateSection",
        components: {
            MenuSectionForm,
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
