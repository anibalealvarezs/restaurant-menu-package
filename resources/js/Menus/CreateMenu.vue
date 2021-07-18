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
                    <MenuForm :data="{}" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import MenuForm from "@/Pages/RestaurantMenu/Menus/MenuForm"
    import PbCreate from "Pub/js/Projectbuilder/pbcreate"

    export default {
        extends: PbCreate,
        name: "CreateMenu",
        components: {
            MenuForm,
        },
        setup () {
            const defaults = computed(() => usePage().props.value.shared.defaults)
            const required = computed(() => usePage().props.value.shared.required)

            return { defaults, required }
        }
    }
</script>

<style scoped>

</style>
