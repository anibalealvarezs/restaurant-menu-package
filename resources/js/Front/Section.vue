<template>
    <div class="clearfix">
        <div class="toggle-container">
            <div class="toggle-header">
                <div class="toggle-link toggle-open">{{ section.name }}</div>
            </div>
            <div class="toggle-content">
                <div class="pad_top20"></div>
                <Item v-for="item in section.menuitems" :item="item"></Item>
            </div>
        </div>
    </div>
</template>

<script>
import Item from '@/Pages/RestaurantMenu/Front/Item';

export default {
    name: "Section",
    props: {
        section: Object,
    },
    components: {
        Item
    }
}
</script>

<style scoped>

</style>
