<template>
    <form @submit.prevent="submit" class="w-full max-w-lg">
        <!-- {{ rmmenu }} -->
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
                    readonly="true"
                    :required="isRequired('name')"
                    @mouseover="disableReadonly"
                    @focus="disableReadonly"
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
                    readonly="true"
                    :required="isRequired('description')"
                    @mouseover="disableReadonly"
                    @focus="disableReadonly"
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
                    :required="isRequired('status')"
                >
                    <option value="1">
                        Enabled
                    </option>
                    <option value="0">
                        Disabled
                    </option>
                </select>
            </div>
            <!-- menu -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-menu-placeholder-' + keyid">
                    Menu
                </label>
                <div class="bg-gray-200">
                    <JetDropdownLink
                        v-if="form.menu"
                        :href="route('menus.show', form.menu)"
                        :id="'grid-menu-placeholder-' + keyid"
                    >
                        <!-- HREF CONTENT -->
                        <span
                            class="inline-flex items-center"
                        >
                            {{ form.menu_name }}
                            <!-- <svg class="h-4 w-4"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg> -->
                        </span>
                    </JetDropdownLink>
                    <input
                        v-if="form.menu"
                        v-model="form.menu_name"
                        :id="'grid-menu-name-' + keyid"
                        name="menu"
                        type="hidden"
                        :required="isRequired('menu')"
                    >
                    <input
                        v-if="form.menu"
                        v-model="form.menu"
                        :id="'grid-menu-' + keyid"
                        name="menu"
                        type="hidden"
                        :required="isRequired('menu')"
                    >
                    <select
                        v-else
                        v-model="form.menu"
                        :id="'grid-menu-' + keyid"
                        name="menu"
                        class="appearance-none w-full md:w-1/1 px-4 py-3 mb-3 block rounded bg-gray-200 text-gray-700 border border-gray-200 overflow-hidden leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        placeholder="Select menu"
                        :required="isRequired('menu')"
                    >
                        <option v-for="menu in menus" :value="menu.id">
                            {{ menu.name }}
                        </option>
                    </select>
                </div>
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
import { Inertia } from '@inertiajs/inertia'
import Swal from "sweetalert2"
import {reactive} from 'vue'
import PbForm from "Pub/js/Projectbuilder/pbform"

export default {
    extends: PbForm,
    name: "MenuSectionForm",
    props: {
        rmmenu: Object,
        menus: Object,
    },
    components: {
        JetDropdownLink,
    },
    setup (props) {
        const form = reactive({
            name: props.data.name,
            description: props.data.description,
            status: (props.data.status ? props.data.status : (props.defaults.hasOwnProperty('status') ? props.defaults.status : 1)),
            position: props.data.position,
            menu: (props.rmmenu ? props.rmmenu.id : 0),
            menu_name: (props.rmmenu ? props.rmmenu.name : ''),
        })

        function submit() {
            if (props.data.hasOwnProperty('item')) {
                Inertia.put("/menusections/"+ props.data.item, form, {
                    preserveScroll: true,
                    onSuccess: () => Swal.close()
                })
            } else {
                Inertia.post("/menusections", form, {
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
