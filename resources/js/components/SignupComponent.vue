<template>
    <div class="container mx-auto">
        <div>
            <h2 class="font-bold text-2xl text-center mb-2">Create your account</h2>
        </div>
        <div class="w-full max-w-xs mx-auto">
            <form class="bg-white shadow-2xl rounded px-8 pt-6 pb-8 mb-4">
                <div class="pb-3">
                    <label class="block text-gray-700 text-sm mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="jon@example.com">
                </div>

                <div class="pb-3">
                    <label class="block text-gray-700 text-sm mb-2" for="username">Username</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="username">
                </div>

                <div class="mb-6">
                    <div class="flex justify-between">
                        <label class="block text-gray-700 text-sm mb-2" for="password">Password</label>
                    </div>

                    <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"  id="password" type="password" placeholder="confirm password">
                    <label class="block text-gray-700 text-sm mb-2" for="passwordConfirm">Confirm password</label>
                    <input
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="password">
                    <p class="text-red-500 text-xs italic">Please choose a password.</p>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class=" w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline "
                        type="button">
                        Sign Up
                    </button>
                </div>
            </form>
            <p class="text-center text-sm">Already Have an account? <a class="text-indigo-600 hover:text-indigo-800"
                    href="#">Login in</a></p>
        </div>
    </div>
</template>
