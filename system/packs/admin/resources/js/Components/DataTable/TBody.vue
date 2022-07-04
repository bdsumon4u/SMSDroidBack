<template>
    <tbody>
        <template v-for="record in records">
            <tr class="h-3"></tr>
            <tr tabindex="0" class="focus:outline-none h-14 border border-gray-100 rounded">
                <td v-if="false">
                    <div class="ml-5">
                        <div
                            class="bg-gray-200 rounded-sm w-5 h-5 flex flex-shrink-0 justify-center items-center relative">
                            <input placeholder="checkbox" type="checkbox"
                                   class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full"/>
                            <div class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                <svg class="icon icon-tabler icon-tabler-check"
                                     xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </td>
                <td v-for="heading in headings">
                    <slot :name="heading.key" :record="record">
                        <div class="flex items-center pl-5">
                            <p class="text-base leading-none text-gray-700 mr-2">{{ record[heading.key] }}</p>
                        </div>
                    </slot>
                </td>
                <td v-if="'action' in $slots">
                    <slot name="action" :record="record"></slot>
                </td>
            </tr>
        </template>
    </tbody>
</template>

<script>
export default {
    name: "TBody",
    props: {
        records: Array,
        headings: Array,
    },
}
</script>
