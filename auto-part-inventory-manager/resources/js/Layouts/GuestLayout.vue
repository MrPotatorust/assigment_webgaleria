<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const isOpen = ref(false);
</script>

<template>
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-xl font-semibold text-gray-900"
                        >Inventory</a
                    >
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-4">
                    <Link
                        :href="route('login')"
                        class="px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md transition"
                    >
                        Login
                    </Link>
                    <Link
                        :href="route('register')"
                        class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md transition"
                    >
                        Register
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex md:hidden">
                    <button
                        @click="isOpen = !isOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                v-if="!isOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"
                            />
                            <path
                                v-if="isOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div v-if="isOpen" class="md:hidden bg-white border-t border-gray-200">
            <div class="px-4 py-3 space-y-2">
                <Link
                    :href="route('login')"
                    class="block px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md transition"
                >
                    Login
                </Link>
                <Link
                    :href="route('register')"
                    class="block px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md transition"
                >
                    Register
                </Link>
            </div>
        </div>
    </nav>
    <slot />
</template>
