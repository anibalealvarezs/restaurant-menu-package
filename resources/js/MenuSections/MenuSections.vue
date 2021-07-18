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
                    <TableMenuSections :rmmenu="rmmenu" :menus="menus" :menusections="rmmenusections" :allowed="allowed" :sort="sort" :showpos="showpos" :showid="showid" :model="model" :defaults="defaults" :required="required" />
                </div>
            </slot>
            <div :id="buildHiddenId" class="infinite-hidden">
                <MenuSectionForm :rmmenu="rmmenu" :menus="menus" :data="{}" :defaults="defaults" :required="required" />
            </div>
        </Main>
    </AppLayout>
</template>

<script>
    import TableMenuSections from "@/Pages/RestaurantMenu/MenuSections/TableMenuSections"
    import MenuSectionForm from "@/Pages/RestaurantMenu/MenuSections/MenuSectionForm"
    import {computed} from "vue"
    import {usePage} from "@inertiajs/inertia-vue3"
    import NavLink from "@/Jetstream/NavLink"
    import PbIndex from "Pub/js/Projectbuilder/pbindex"

    export default {
        extends: PbIndex,
        name: "MenuSections",
        props: {
            rmmenu: Object,
            rmmenusections: Object,
        },
        components: {
            NavLink,
            TableMenuSections,
            MenuSectionForm
        },
        computed: {
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
        setup () {
            const allowed = computed(() => usePage().props.value.shared.allowed)
            const sort = computed(() => usePage().props.value.shared.sort)
            const showpos = computed(() => usePage().props.value.shared.showpos)
            const showid = computed(() => usePage().props.value.shared.showid)
            const model = computed(() => usePage().props.value.shared.model)
            const defaults = computed(() => usePage().props.value.shared.defaults)
            const required = computed(() => usePage().props.value.shared.required)
            const menus = computed(() => usePage().props.value.shared.menus)

            return { menus, allowed, sort, model, showpos, showid, defaults, required }
        }
    }
</script>
