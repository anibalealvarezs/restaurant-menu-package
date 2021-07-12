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
            <MenuItemForm :rmmenusection="rmmenusection" :menusections="menusections" :data="data" :keyid="generateRandom" :key="itemFormKey" />
        </div>
    </Container>
</template>

<script>
import Container from "@/Pages/Projectbuilder/Tables/Container"
import Header from "@/Pages/Projectbuilder/Tables/Header"
import Body from "@/Pages/Projectbuilder/Tables/Body"
import TrHead from "@/Pages/Projectbuilder/Tables/TrHead"
import TrBody from "@/Pages/Projectbuilder/Tables/TrBody"
import MenuItemForm from "@/Pages/RestaurantMenu/MenuItems/MenuItemForm"
import { TableFields as Table } from "Pub/js/Projectbuilder/projectbuilder"
import Sortable from "sortablejs";

export default {
    name: "TableMenuItems",
    props: {
        menuitems: Object,
        allowed: Array,
        rmmenusection: Array,
        menusections: Array,
        model: String,
        sort: Boolean,
        showpos: Boolean,
        showid: Boolean,
    },
    components: {
        MenuItemForm,
        TrBody,
        TrHead,
        Container,
        Header,
        Body
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
                route: "menuitems.edit",
                formitem: "menuitem",
                altforuser: {}
            },
            "delete": {
                text: 'Delete',
                style: 'danger',
                method: 'DELETE',
                route: "menuitems.destroy",
                formitem: "menuitem",
                altforuser: {}
            }
        })
        let fields = table.fields
        return { fields }
    },
    data() {
        return {
            data: {},
            itemFormKey: 0
        }
    },
    methods: {
        onItemClicked(value) {
            let result = Table.onItemClicked(value, this.data, this.itemFormKey)
            this.data = result.data
            this.itemFormKey = result.key
        },
        getRowPos(el) {
            return Table.getRowPos(this.sort, el)
        },
        getTablePositions(group) {
            let sort = [];
            document.querySelectorAll('#'+this.model+'-table-rows tr').forEach(function(value){
                if (value.dataset.group == group) {
                    sort.push(value.dataset.id)
                }
            })
            return sort
        },
    },
    computed: {
        existsFormButton() {
            return Table.existsFormButton(this.fields.actions.buttons)
        },
        buildHiddenId() {
            return Table.buildHiddenId()
        },
        generateRandom() {
            return Table.generateRandom()
        }
    }
}
</script>

<style scoped>

</style>
