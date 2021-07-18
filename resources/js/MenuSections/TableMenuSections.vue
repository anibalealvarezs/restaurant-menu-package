<template>
    <Container>
        <slot>
            <Header>
                <slot>
                    <TrHead :fields="fields" :allowed="allowed" />
                </slot>
            </Header>
            <Body :id="model+'-table-rows'">
                <slot>
                    <TrBody v-for="menusection in menusections" :item="menusection" :fields="fields" :hiddenid="buildHiddenId" :allowed="allowed" :data-id="menusection.id" :data-group="menusection.menu.id" :data-pos="getRowPos(menusection)" @clicked-edit-item="onItemClicked" />
                </slot>
            </Body>
        </slot>
        <div v-if="existsFormButton" :id="buildHiddenId" class="infinite-hidden">
            <MenuSectionForm :rmmenu="rmmenu" :menus="menus" :data="data" :keyid="generateRandom" :key="itemFormKey" :defaults="defaults" :required="required" />
        </div>
    </Container>
</template>

<script>
import MenuSectionForm from "@/Pages/RestaurantMenu/MenuSections/MenuSectionForm"
import { TableFields as Table } from "Pub/js/Projectbuilder/projectbuilder"
import Sortable from "sortablejs"
import PbTable from "Pub/js/Projectbuilder/pbtable"

export default {
    extends: PbTable,
    name: "TableMenuSections",
    props: {
        menusections: Object,
        rmmenu: Array,
        menus: Array,
    },
    components: {
        MenuSectionForm,
    },
    mounted() {
        if (this.sort) {
            let that = this
            let sortingOptions = Object.assign(
                {},
                Table.getSortingOptions(),
                {
                    onSort: function (e) {
                        let data = {
                            sortlist: that.getTablePositions(e.item.dataset.group)
                        }
                        that.$inertia.post(
                            '/menusections/sort/'+e.item.dataset.group,
                            data,
                            {
                                preserveState: false
                            }
                        )
                    },
                }
            );

            Sortable.create(
                document.getElementById(this.model+'-table-rows'),
                sortingOptions
            )
        }
    },
    setup(props) {
        const allowed = props.allowed
        const table = new Table(props.showid, props.sort)
        table.customField(
            "name",
            "Section",
            {},
            {},
            {},
            {
                route: "menusections.show",
                id: "id",
            },
        )
        table.customField(
            "description",
            "Description",
        )
        table.customField(
            "menuitems",
            "Dishes",
            {
                key: "name",
                /* href: {
                    route: "menuitems.show",
                    id: "id",
                }, */
            },
            {},
            {},
            {},
            'multiple',
        )
        table.customField(
            "menu",
            "Menu",
            {
                key: "name",
            },
        )
        if (props.showpos) {
            table.customField(
                "position",
                "Position",
                {},
                {
                    centered: true,
                },
            )
        }
        table.customField(
            "status",
            "Status",
            {},
            {
                centered: true,
            },
            {},
            {},
            'single',
            true,
        )
        table.pushActions({
            "update": {
                text: 'Update',
                style: 'secondary',
                method: 'PUT',
                route: "menusections.edit",
                formitem: "menusection",
                altforuser: {},
                allowed: allowed.update,
            },
            "delete": {
                text: 'Delete',
                style: 'danger',
                method: 'DELETE',
                route: "menusections.destroy",
                formitem: "menusection",
                altforuser: {},
                allowed: allowed.delete,
            }
        })
        let fields = table.fields
        return { fields }
    },
}
</script>

<style scoped>

</style>
