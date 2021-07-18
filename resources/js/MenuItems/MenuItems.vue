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
                    <TableMenuItems :rmmenusection="rmmenusection" :menusections="menusections" :menuitems="rmmenuitems" :allowed="allowed" :sort="sort" :showpos="showpos" :showid="showid" :model="model" :defaults="defaults" :required="required" />
                </div>
            </slot>
            <div :id="buildHiddenId" class="infinite-hidden">
                <MenuItemForm :rmmenusection="rmmenusection" :menusections="menusections" :data="{}" :defaults="defaults" :required="required" />
            </div>
        </Main>
    </AppLayout>
</template>

<script>
    import TableMenuItems from "@/Pages/RestaurantMenu/MenuItems/TableMenuItems"
    import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
    import {computed} from "vue"
    import {usePage} from "@inertiajs/inertia-vue3"
    import NavLink from "@/Jetstream/NavLink"
    import PbIndex from "Pub/js/Projectbuilder/pbindex"

    export default {
        extends: PbIndex,
        props: {
            rmmenusection: Object,
            rmmenuitems: Object
        },
        components: {
            TableMenuItems,
            MenuItemForm,
            NavLink,
        },
        computed: {
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
        setup () {
            const allowed = computed(() => usePage().props.value.shared.allowed)
            const sort = computed(() => usePage().props.value.shared.sort)
            const showpos = computed(() => usePage().props.value.shared.showpos)
            const showid = computed(() => usePage().props.value.shared.showid)
            const model = computed(() => usePage().props.value.shared.model)
            const defaults = computed(() => usePage().props.value.shared.defaults)
            const required = computed(() => usePage().props.value.shared.required)
            const menusections = computed(() => usePage().props.value.shared.menusections)

            return { menusections, allowed, sort, model, showpos, showid, defaults, required }
        }
    }
</script>
