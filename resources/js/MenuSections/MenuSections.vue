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
                            <slot>Create Menu Section</slot>
                        </Button>
                        <div id="breadcrumb">
                            <NavLink
                                :href="route('menus.index')"
                                type="button"
                            >
                                <slot>Back to menus list</slot>
                            </NavLink>
                        </div>
                    </div>
                    <TableMenuSections :rmmenu="rmmenu" :menus="menus" :menusections="rmmenusections" :allowed="allowed" :sort="sort" :showpos="showpos" :showid="showid" :model="model" />
                </div>
            </slot>
            <div :id="buildHiddenId" class="infinite-hidden">
                <MenuSectionForm :rmmenu="rmmenu" :menus="menus" :data="{}" />
            </div>
        </Main>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Pages/Projectbuilder/AppLayout'
    import TableMenuSections from "@/Pages/RestaurantMenu/MenuSections/TableMenuSections"
    import Button from "@/Jetstream/Button"
    import Main from "@/Pages/Projectbuilder/Main"
    import {TableFields as Table} from "Pub/js/Projectbuilder/projectbuilder";
    import Swal from "sweetalert2";
    import MenuSectionForm from "@/Pages/RestaurantMenu/MenuSections/MenuSectionForm"
    import {computed} from "vue";
    import {usePage} from "@inertiajs/inertia-vue3";
    import NavLink from "@/Jetstream/NavLink";

    export default {
        name: "MenuSections",
        props: {
            rmmenu: Object,
            rmmenusections: Object,
        },
        components: {
            NavLink,
            Button,
            AppLayout,
            TableMenuSections,
            Main,
            MenuSectionForm
        },
        data() {
            return {
                hiddenid: 0
            }
        },
        methods: {
            loadForm() {
                let swalMenu = Table.buildSwalLoadFormConfig({text: "Create", formitem: "menusection"})
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
                /*  title = "Menu Sections" */
                let title = "";
                if (this.rmmenu) {
                    /* title += " for " + this.rmmenu.name */
                    title = this.rmmenu.name
                }
                return title
            },
            getCreationTitle() {
                let title = "Create Menu Section"
                /* if (this.rmmenu) {
                    title += " for " + this.rmmenu.name
                } */
                return title
            },
        },
        setup (props) {

            const allowed = computed(() => usePage().props.value.shared.allowed)
            const menus = computed(() => usePage().props.value.shared.menus)
            const sort = computed(() => usePage().props.value.shared.sort)
            const showpos = computed(() => usePage().props.value.shared.showpos)
            const showid = computed(() => usePage().props.value.shared.showid)
            const model = computed(() => usePage().props.value.shared.model)

            return { allowed, menus, sort, model, showpos, showid }
        }
    }
</script>
