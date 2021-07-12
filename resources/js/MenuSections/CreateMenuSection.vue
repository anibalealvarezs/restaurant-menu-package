<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Menu Section
            </h2>
        </template>

        <Main>
            <slot>
                <!-- {{ menus }} -->
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuSectionForm :rmmenu="{}" :menus="menus" :data="{}" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import Main from "@/Pages/Projectbuilder/Main"
    import MenuSectionForm from "@/Pages/RestaurantMenu/MenuSections/MenuSectionForm"
    import {computed} from "vue";
    import {usePage} from "@inertiajs/inertia-vue3";

    export default {
        name: "CreateSection",
        props: {
            page: Object
        },
        components: {
            MenuSectionForm,
            AppLayout,
            Main
        },
        setup (props) {

            const allowed = computed(() => usePage().props.value.shared.allowed)
            const menus = computed(() => usePage().props.value.shared.menus)

            return { allowed, menus }
        }
    }
</script>

<style scoped>

</style>
