<template>
    <form @submit.prevent="submit" class="w-full max-w-lg">
        <!-- {{ rmmenusection }} -->
        <div class="flex flex-wrap -mx-3 mb-6">
            <!-- name -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-name-' + keyid">
                    Name
                </label>
                <input
                    v-model="form.name"
                    :id="'grid-name-' + keyid"
                    name="name"
                    type="text"
                    placeholder="Name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    readonly="readonly"
                    @mouseover="disableReadonly"
                >
            </div>
            <!-- description -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-description-' + keyid">
                    Description
                </label>
                <input
                    v-model="form.description"
                    :id="'grid-description-' + keyid"
                    name="description"
                    type="text"
                    placeholder="Description"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    readonly="readonly"
                    @mouseover="disableReadonly"
                >
            </div>
            <!-- price -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-price-' + keyid">
                    Price
                </label>
                <input
                    v-model="form.price"
                    :id="'grid-price-' + keyid"
                    name="price"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    readonly="readonly"
                    @mouseover="disableReadonly"
                >
            </div>
            <!-- status -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-status-' + keyid">
                    Status
                </label>
                <select
                    v-model="form.status"
                    :id="'grid-status-' + keyid"
                    name="status"
                    class="appearance-none w-full md:w-1/1 px-4 py-3 mb-3 block rounded bg-gray-200 text-gray-700 border border-gray-200 overflow-hidden leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Select status"
                >
                    <option value="1">
                        Enabled
                    </option>
                    <option value="0">
                        Disabled
                    </option>
                </select>
            </div>
            <!-- menu section -->
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-menusection-placeholder-' + keyid">
                    Menu Section
                </label>
                <div class="bg-gray-200">
                    <JetDropdownLink
                        v-if="form.menusection"
                        :href="route('menusections.show', form.menusection)"
                        :id="'grid-menusection-placeholder-' + keyid"
                    >
                        <!-- HREF CONTENT -->
                        <span
                            class="inline-flex items-center"
                        >
                            {{ form.menusection_name }}
                            <!-- <svg class="h-4 w-4"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg> -->
                        </span>
                    </JetDropdownLink>
                </div>
                <input
                    v-if="form.menusection"
                    v-model="form.menusection_name"
                    :id="'grid-menusection-name-' + keyid"
                    name="menusection"
                    type="hidden"
                >
                <input
                    v-if="form.menusection"
                    v-model="form.menusection"
                    :id="'grid-menusection-' + keyid"
                    name="menusection"
                    type="hidden"
                >
                <select
                    v-else
                    v-model="form.menusection"
                    :id="'grid-menusection-' + keyid"
                    name="menusection"
                    class="appearance-none w-full md:w-1/1 px-4 py-3 mb-3 block rounded bg-gray-200 text-gray-700 border border-gray-200 overflow-hidden leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Select menu section"
                >
                    <option v-for="menusection in menusections" :value="menusection.id">
                        {{ menusection.name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2 items-center justify-between">
            <!-- submit -->
            <div class="w-full px-3">
                <Button type="submit" :disabled="form.processing">{{ buttontext }}</Button>
            </div>
        </div>
    </form>
</template>

<script>
import JetDropdownLink from '@/Jetstream/DropdownLink'
import Button from "@/Jetstream/Button"
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Swal from "sweetalert2"

export default {
    name: "MenuItemForm",
    props: {
        data: Object,
        keyid: String,
        rmmenusection: Object,
        menusections: Object,
    },
    components: {
        Button,
        JetDropdownLink,
    },
    data() {
        return {
            buttontext: (this.data.item ? "Save" : "Create")
        }
    },
    methods: {
        disableReadonly(event) {
            document.getElementById(event.target.id).readOnly = false
        }
    },
    computed: {
        readonly() {
            return this.data.hasOwnProperty('item')
        }
    },
    setup (props) {
        const form = reactive({
            name: props.data.name,
            description: props.data.description,
            status: props.data.status,
            position: props.data.position,
            price: props.data.price,
            menusection: (props.rmmenusection ? props.rmmenusection.id : 0),
            menusection_name: (props.rmmenusection ? props.rmmenusection.name : ''),
        })

        function submit() {
            if (props.data.hasOwnProperty('item')) {
                Inertia.put("/menuitems/"+ props.data.item, form, {
                    preserveScroll: true,
                    onSuccess: () => Swal.close()
                })
            } else {
                Inertia.post("/menuitems", form, {
                    preserveScroll: true,
                    onSuccess: () => Swal.close()
                })
            }
        }

        return { form, submit }
    }
}
</script>

<style scoped>

</style>
