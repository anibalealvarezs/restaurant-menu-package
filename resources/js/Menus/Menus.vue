<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menus
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between w-full">
                        <Button
                            v-if="allowed.create"
                            @click="loadForm"
                            type="button"
                        >
                            <slot>Create Menu</slot>
                        </Button>
                        <div id="breadcrumb"></div>
                    </div>
                    <TableMenus :menus="rmmenus" :allowed="allowed" :sort="sort" :showpos="showpos" :showid="showid" :model="model" />
                </div>
            </slot>
            <div :id="buildHiddenId" class="infinite-hidden">
                <MenuForm :data="{}" />
            </div>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import TableMenus from "@/Pages/RestaurantMenu/Menus/TableMenus"
    import Button from "@/Jetstream/Button"
    import Main from "@/Pages/Projectbuilder/Main"
    import {TableFields as Table} from "Pub/js/Projectbuilder/projectbuilder";
    import Swal from "sweetalert2";
    import MenuForm from "@/Pages/RestaurantMenu/Menus/MenuForm"
    import {computed} from "vue";
    import {usePage} from "@inertiajs/inertia-vue3";

    export default {
        name: "Menus",
        props: {
            rmmenus: Object
        },
        components: {
            Button,
            AppLayout,
            TableMenus,
            Main,
            MenuForm
        },
        data() {
            return {
                hiddenid: 0
            }
        },
        methods: {
            loadForm() {
                let swalMenu = Table.buildSwalLoadFormConfig({text: "Create", formitem: "menu"})
                swalMenu['didOpen'] = () => {
                    Table.appendToSwal(this.hiddenid)
                }
                swalMenu['willClose'] = () => {
                    Table.removeFromSwal(this.hiddenid)
                }
                Swal.fire(swalMenu);
            }
        },
        computed: {
            buildHiddenId() {
                this.hiddenid = Table.buildHiddenId()
                return this.hiddenid
            }
        },
        setup (props) {
            const allowed = computed(() => usePage().props.value.shared.allowed)
            const sort = computed(() => usePage().props.value.shared.sort)
            const showpos = computed(() => usePage().props.value.shared.showpos)
            const showid = computed(() => usePage().props.value.shared.showid)
            const model = computed(() => usePage().props.value.shared.model)

            return { allowed, sort, model, showpos, showid }
        }
    }
</script>
