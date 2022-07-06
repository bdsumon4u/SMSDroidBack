<script setup>
import {ref} from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import DialogModal from '@/Jetstream/DialogModal.vue';

const props = defineProps({
    token: String|null,
});

const showModal = ref(!!props.token)

const closeModal = () => {
    showModal.value = false;
}

const statuses = [
    'Pending',
    'Scheduled',
    'Queued',
    'Sent',
    'Delivered',
    'Failed',
    'Received',
]
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <DialogModal :show="showModal" @close="closeModal">
                    <template #title>
                        <div class="-mx-6 px-6 pb-3 border-b flex items-center gap-x-4 justify-between">
                            <h4 class="font-bold">Add New Device</h4>
                            <div class="cursor-pointer" @click="closeModal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </template>
                    <template #content>
                        <div class="px-4 mb-4">
                            <h4 class="font-bold mb-2">You can follow below steps to add your Android phone in the system.</h4>

                            <ol class="list-decimal font-semibold text-sm">
                                <li class="mb-2">Download the latest version of Android app from <a href="">here</a>. It is better if
                                    you download it directly into your phone.
                                </li>
                                <li class="mb-2">Install it on your phone. If you don't know how to install the apps not available on
                                    Play Store then you can follow
                                    <a href="">this</a> guide.
                                </li>
                                <li class="mb-2">Open the app after the installation, you will be asked to give bunch of permissions.
                                    Just click Allow or Yes on all prompts you receive and you will be presented with
                                    login window. Touch the "SIGN IN USING QR CODE" button to scan the QR code shown
                                    below.
                                    <div class="flex justify-center mt-2" v-html="props.token"></div>
                                </li>
                                <li class="mb-2">Congratulations, You successfully added your Android phone in to the system. Now
                                    just open the Sender page using navigation menu and start sending messages.
                                </li>
                            </ol>
                        </div>
                    </template>
                </DialogModal>
                <div class="px-4 grid gap-4 grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Pending</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Scheduled</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Queued</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Sent</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Delivered</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Failed</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 hidden md:block rounded-full absolute opacity-50 top-0 right-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="text-center">
                                <dt class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                                    5,749
                                </dt>
                                <dd class="text-gray-500 font-semibold">
                                    <span>Received</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-1 border-t flex justify-center">
                            <span class="text-sm font-bold">More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
