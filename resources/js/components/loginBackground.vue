<template>
  <div
    style="transform:rotate(-15deg) skew(-15deg) scale(1.1)"
    class="fixed top-0 left-0 right-0 bottom-0 mt-32 -z-1"
  >
    <div
      style="transform:translateY(-50%); height: 84.5rem"
      class="bg-gray-100 absolute top-0 left-0 right-0 -z-1"
    ></div>
    <div class="flex flex-row">
      <div class="p-24 w-4/5"></div>
      <div class="bg-blue-300 p-12 p w-1/5"></div>
    </div>

    <div class="flex flex-row">
      <div class="p-12 w-3/4"></div>
      <div class="bg-indigo-700 p-12 w-1/4"></div>
    </div>
    <div class="flex flex-row">
      <div class="p-12 w-1/6"></div>
      <div class="border p-12 w-1/6"></div>
      <div class="p-12 w-5/6"></div>
      <div class="bg-gray-200 p-12 w-1/6"></div>
    </div>
    <div class="flex flex-row">
      <div class="p-12 w-full"></div>
      <div class="border p-12 w-1/6"></div>
      <div class="p-12 w-1/6"></div>
    </div>
    <div class="flex flex-row">
      <div class="bg-indigo-900 p-12 w-1/6"></div>
      <div class="p-12 w-5/6"></div>
    </div>
    <div class="flex flex-row">
      <div class="bg-indigo-600 p-12 w-1/4"></div>
      <div class="p-12 w-3/4"></div>
      <div class="p-12 w-1/4"></div>
    </div>
    <div class="flex flex-row">
      <div class="p-12 w-1/5"></div>
      <div class="bg-gray-200 p-12 w-1/5"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "login-background"
};
</script>