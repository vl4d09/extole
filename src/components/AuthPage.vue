<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900">
      <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Authentication</h1>
      <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-96">
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Email</label>
          <input type="email" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" placeholder="Email" />
        </div>
  
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Password</label>
          <input type="password" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" placeholder="Password" />
        </div>
  
        <div class="flex justify-between">
          <button @click="signUp" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Sign Up</button>
          <button @click="logIn" class="bg-green-500 text-white py-2 px-4 rounded-lg">Log In</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      logIn() {
        alert('Logged In (hardcoded)');
        this.$router.push('/');
      },
      signUp() {
        alert('Signed Up (hardcoded)');
        this.$router.push('/');
      }
    }
  }
  </script>
  