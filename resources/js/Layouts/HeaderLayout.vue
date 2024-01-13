<script setup></script>

<template>
    <div>
        <nav class="bg-gray-800">
            <div class="px-16 sm:px-6 lg:px-16">
                <div class="relative flex h-16 items-center justify-between">
                    <div
                        class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start"
                    >
                        <Link href="/" class="flex flex-shrink-0 items-center">
                            <img
                                class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company"
                            />
                        </Link>
                        <div class="ml-6 flex items-center w-full">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <Link
                                    :href="route('tracks.create')"
                                    :class="{
                                        'bg-gray-900':
                                            $page.url === '/tracks/create',
                                    }"
                                    class="text-white rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700"
                                    aria-current="page"
                                    >Add a track</Link
                                >
                            </div>
                            <div class="flex space-x-4 ml-auto">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <Link
                                    v-if="!$page.props.auth.user"
                                    :href="route('register')"
                                    :class="{
                                        'bg-blue-900':
                                            $page.url === '/register',
                                    }"
                                    class="text-black rounded-md px-3 py-2 text-sm font-medium bg-white hover:bg-gray-300"
                                    aria-current="page"
                                    >Register</Link
                                >
                                <Link
                                    v-if="!$page.props.auth.user"
                                    :href="route('login')"
                                    :class="{
                                        'bg-blue-900': $page.url === '/login',
                                    }"
                                    class="text-white rounded-md px-3 py-2 text-sm font-medium bg-blue-700 hover:bg-blue-500"
                                    aria-current="page"
                                    >Login</Link
                                >
                                <Link
                                    v-if="$page.props.auth.user"
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    :class="{
                                        'bg-red-900': $page.url === '/logout',
                                    }"
                                    class="text-white rounded-md px-3 py-2 text-sm font-medium bg-red-700 hover:bg-red-500"
                                    aria-current="page"
                                    >Logout</Link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="px-16">
            <div class="flex justify-between items-center">
                <h4 class="text-4xl font-bold my-8">
                    <slot name="title"></slot>
                </h4>
                <div>
                    <slot name="action"></slot>
                </div>
            </div>
            <slot name="content"></slot>
        </div>
    </div>
</template>
