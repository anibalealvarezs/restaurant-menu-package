<template>
    <div class="title-splider clearfix">
        <h4>
            <span class="left border_bottom">{{ item.name }}</span>
            <span class="right color price-usd"><span class="price-reference">Ref:</span> {{ item.price_total }}</span>
            <span class="right color price-bs">Bs {{ item.price_total_ex }}</span>
        </h4>
    </div>
    <p>
        <span class="item-gross"><span class="price-label">Bruto:</span> <strong>Bs {{ item.price_gross }}</strong></span>
        <span class="item-assignment"><span class="price-label">Servicio<span class="percent"> (10%)</span>:</span> <strong>Bs {{ item.commission }}</strong></span>
        <span class="item-tax"><span class="price-label">IVA<span class="percent"> (16%)</span>:</span> <strong>Bs {{ item.tax }}</strong></span>
    </p>
</template>

<script>
export default {
    name: "Item",
    props: {
        item: Object,
    },
}
</script>

<style scoped>

</style>
