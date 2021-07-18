<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit: {{ rmmenu.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <MenuForm :data="setItem" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import MenuForm from "@/Pages/RestaurantMenu/Menus/MenuForm"
    import PbEdit from "Pub/js/Projectbuilder/pbedit"

    export default {
        extends: PbEdit,
        name: "EditMenu",
        props: {
            rmmenu: Object,
        },
        components: {
            MenuForm,
        },
        computed: {
            setItem() {
                this.rmmenu.item = this.rmmenu.id
                return this.rmmenu
            },
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
