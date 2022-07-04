<template>
    <thead class="bg-gray-100">
    <tr tabindex="0" class="focus:outline-none border border-gray-100 rounded">
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
        <th
            scope="col"
            v-for="heading in headings"
            class="px-6 py-3 text-left text-md font-bold text-gray-500 capitalize tracking-wider">
            <div class="flex cursor-pointer">
                {{ heading.label }}
                <div v-show="false" class="grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                        <path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                        <path fill="none" d="M0 0h24v24H0z"/><path d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z"/>
                    </svg>
                </div>
            </div>
        </th>
        <slot name="action"></slot>
    </tr>
    </thead>
</template>

<script>
export default {
    name: "THead",
    props: ['headings', 'order'],
}
</script>
