<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                MenuItem: {{ rmmenuitem.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <h2>{{ rmmenuitem.id }}. {{ rmmenuitem.name }}</h2>
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import PbShow from "Pub/js/Projectbuilder/pbshow"

    export default {
        extends: PbShow,
        name: "ShowMenuItem",
        props: {
            rmmenuitem: Object,
        },
    }
</script>

<style scoped>

</style>
