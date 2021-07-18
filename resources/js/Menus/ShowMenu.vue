<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menu: {{ rmmenu.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <h2>{{ rmmenu.id }}. {{ rmmenu.name }}</h2>
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
    import PbShow from "Pub/js/Projectbuilder/pbshow"

    export default {
        extends: PbShow,
        name: "ShowMenu",
        props: {
            rmmenu: Object,
        },
    }
</script>

<style scoped>

</style>
