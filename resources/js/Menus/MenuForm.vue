<template>
    <form @submit.prevent="submit" class="w-full max-w-lg">
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
import Button from "@/Jetstream/Button"
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Swal from "sweetalert2"

export default {
    name: "MenuForm",
    props: {
        data: Object,
        keyid: String
    },
    components: {
        Button
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
        })

        function submit() {
            if (props.data.hasOwnProperty('item')) {
                Inertia.put("/menus/"+ props.data.item, form, {
                    preserveScroll: true,
                    onSuccess: () => Swal.close()
                })
            } else {
                Inertia.post("/menus", form, {
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
