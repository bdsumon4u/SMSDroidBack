<template>
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <div class="mb-4 flex flex-wrap justify-between items-center gap-x-4 gap-y-2">
            <div class="flex-1">
                <div class="flex sm:flex-row flex-col">
                    <div class="flex flex-row sm:mb-0">

                        <slot name="top-left"></slot>

                    </div>
                </div>
            </div>
            <div class="shadow rounded-lg flex">
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <Icon name="search" :size="16" class="text-gray-500"></Icon>
                    </span>
                    <input name="search" v-model="form.search"
                           class="appearance-none rounded border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
                </div>
            </div>
        </div>
        <div class="mt-7 overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <THead :headings="headings">
                    <template v-if="'action' in $slots" v-slot:action>
                        <th
                            v-if="'action' in $slots"
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        </th>
                    </template>
                </THead>
                <TBody :records="collection.data" :headings="headings">
                    <template v-for="heading in headings" v-slot:[heading.key]="{record}">
                        <slot :name="heading.key" :record="record"></slot>
                    </template>
                    <template v-if="'action' in $slots" v-slot:action="{record}">
                        <slot name="action" :record="record"></slot>
                    </template>
                </TBody>
            </table>
        </div>
        <template v-if="collection.meta">
            <Pages :pagination="collection.meta"/>
        </template>
    </div>
</template>

<script>
import Pages from "./Pages";
import THead from "./THead";
import TBody from "./TBody";
import Icon from "../../../../../../../resources/js/Icon";

export default {
    name: "Table",
    props: {
        collection: Object,
        headings: Array,
        server: String,
    },
    components: {
        Pages,
        TBody,
        THead,
        Icon,
    },
    data() {
        return {
            form: {
                search: this.$page.props.search ?? '',
            }
        };
    },
}
</script>

<style scoped>
.checkbox:checked + .check-icon {
    display: flex;
}
</style>
