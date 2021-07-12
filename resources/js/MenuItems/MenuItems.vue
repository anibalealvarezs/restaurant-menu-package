<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ getTitle }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between w-full">
                        <Button
                            @click="loadForm"
                            type="button"
                        >
                            <slot>{{ getCreationTitle }}</slot>
                        </Button>
                        <div class="space-x-6" id="breadcrumb">
                            <NavLink
                                :href="route('menus.index')"
                                type="button"
                            >
                                <slot>Back to menus list</slot>
                            </NavLink>
                            <NavLink
                                :href="route('menus.show', rmmenusection.menu.id)"
                                type="button"
                            >
                                <slot>Back to {{ rmmenusection.menu.name }}</slot>
                            </NavLink>
                        </div>
                    </div>
                    <TableMenuItems :rmmenusection="rmmenusection" :menusections="menusections" :menuitems="rmmenuitems" :allowed="allowed" :sort="sort" :showpos="showpos" :showid="showid" :model="model" />
                </div>
            </slot>
            <div :id="buildHiddenId" class="infinite-hidden">
                <MenuItemForm :rmmenusection="rmmenusection" :menusections="menusections" :data="{}" />
            </div>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import TableMenuItems from "@/Pages/RestaurantMenu/MenuItems/TableMenuItems"
    import Button from "@/Jetstream/Button"
    import Main from "@/Pages/Projectbuilder/Main"
    import {TableFields as Table} from "Pub/js/Projectbuilder/projectbuilder";
    import Swal from "sweetalert2";
    import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
    import {computed} from "vue";
    import {usePage} from "@inertiajs/inertia-vue3";
    import NavLink from "@/Jetstream/NavLink";

    export default {
        name: "MenuItems",
        props: {
            rmmenusection: Object,
            rmmenuitems: Object
        },
        components: {
            Button,
            AppLayout,
            TableMenuItems,
            Main,
            MenuItemForm,
            NavLink,
        },
        data() {
            return {
                hiddenid: 0
            }
        },
        methods: {
            loadForm() {
                let swalMenu = Table.buildSwalLoadFormConfig({text: "Create", formitem: "menuitem"})
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
            },
            getTitle() {
                let title = "Section"
                if (this.rmmenusection) {
                    title += ": " + this.rmmenusection.name
                }
                return title
            },
            getCreationTitle() {
                let title = "Create Dish"
                /* if (this.rmmenusection) {
                    title += " for " + this.rmmenusection.name
                } */
                return title
            },
        },
        setup (props) {

            const allowed = computed(() => usePage().props.value.shared.allowed)
            const menusections = computed(() => usePage().props.value.shared.menusections)
            const sort = computed(() => usePage().props.value.shared.sort)
            const showpos = computed(() => usePage().props.value.shared.showpos)
            const showid = computed(() => usePage().props.value.shared.showid)
            const model = computed(() => usePage().props.value.shared.model)

            return { allowed, menusections, sort, model, showpos, showid }
        }
    }
</script>
