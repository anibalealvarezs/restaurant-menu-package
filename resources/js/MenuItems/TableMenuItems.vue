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
                    <TrBody v-for="menuitem in menuitems" :item="menuitem" :fields="fields" :hiddenid="buildHiddenId" :allowed="allowed" :data-id="menuitem.id" :data-group="menuitem.menusection.id" :data-pos="getRowPos(menuitem)" @clicked-edit-item="onItemClicked" />
                </slot>
            </Body>
        </slot>
        <div v-if="existsFormButton" :id="buildHiddenId" class="infinite-hidden">
            <MenuItemForm :rmmenusection="rmmenusection" :menusections="menusections" :data="data" :keyid="generateRandom" :key="itemFormKey" :defaults="defaults" :required="required" />
        </div>
    </Container>
</template>

<script>
import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
import { TableFields as Table } from "Pub/js/Projectbuilder/projectbuilder"
import Sortable from "sortablejs"
import PbTable from "Pub/js/Projectbuilder/pbtable"

export default {
    extends: PbTable,
    name: "TableMenuItems",
    props: {
        menuitems: Object,
        rmmenusection: Array,
        menusections: Array,
    },
    components: {
        MenuItemForm,
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
                            '/menuitems/sort/'+e.item.dataset.group,
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
            "Dish"
        )
        table.customField(
            "description",
            "Description",
        )
        table.customField(
            "price",
            "Price",
        )
        table.customField(
            "menusection",
            "Section",
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
                    width: "w-12",
                },
            )
        }
        table.customField(
            "status",
            "Status",
            {},
            {
                centered: true,
                width: "w-12",
            },
            {},
            {},
            'single',
            true,
        )
        table.pushActions({
            "update": {
                text: 'Edit',
                style: 'secondary',
                method: 'PUT',
                route: "menuitems.edit",
                formitem: "menuitem",
                altforuser: {},
                allowed: allowed.update,
            },
            "delete": {
                text: 'Delete',
                style: 'danger',
                method: 'DELETE',
                route: "menuitems.destroy",
                formitem: "menuitem",
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
