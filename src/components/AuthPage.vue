<template>
  <div :class="{ 'dark': isDarkMode }" class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900">
    <!-- Logo Section -->
    <div class="absolute top-4 left-4">
      <img src="@/assets/logo.png" alt="Logo" class="h-20" />
    </div>
    
    <!-- Authentication Content -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-96 mt-16">
      <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">
        {{ isSignUp ? 'Sign Up' : 'Log In' }}
      </h1>
      
      <!-- Conditional Form Display -->
      <div v-if="isSignUp">
        <!-- Sign Up Form -->
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Email</label>
          <input 
            type="email" 
            v-model="email" 
            class="w-full p-2 border rounded-lg bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100" 
            placeholder="Email" 
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Password</label>
          <input 
            type="password" 
            v-model="password" 
            class="w-full p-2 border rounded-lg bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100" 
            placeholder="Password" 
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Confirm Password</label>
          <input 
            type="password" 
            v-model="confirmPassword" 
            class="w-full p-2 border rounded-lg bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100" 
            placeholder="Confirm Password" 
          />
        </div>
      </div>
      
      <!-- Login Form -->
      <div v-else>
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Email</label>
          <input 
            type="email" 
            v-model="email" 
            class="w-full p-2 border rounded-lg bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100" 
            placeholder="Email" 
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 dark:text-gray-300">Password</label>
          <input 
            type="password" 
            v-model="password" 
            class="w-full p-2 border rounded-lg bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100" 
            placeholder="Password" 
          />
        </div>
      </div>

      <div class="flex flex-col items-center">
        <button @click="handleAuth" class="bg-blue-500 text-white py-2 px-4 rounded-lg w-full mb-2">
          {{ isSignUp ? 'Sign Up' : 'Log In' }}
        </button>
        <button @click="toggleForm" class="text-blue-500 underline w-full">
          {{ isSignUp ? 'Already have an account?' : 'Need an account?' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isDarkMode: false, // Update this based on your dark mode logic
      isSignUp: false,   // Determines whether to show Sign Up or Log In form
      email: '',
      password: '',
      confirmPassword: ''
    };
  },
  methods: {
    handleAuth() {
      if (this.isSignUp) {
        if (this.password !== this.confirmPassword) {
          alert('Passwords do not match');
          return;
        }
        alert('Signed Up (hardcoded)');
      } else {
        alert('Logged In (hardcoded)');
      }
      this.$router.push('/home').catch(err => {
        console.error('Navigation error:', err);
      }); // Navigate to /home after login or sign up
    },
    toggleForm() {
      this.isSignUp = !this.isSignUp; // Toggle between Sign Up and Log In
    }
  }
}
</script>

<style scoped>
/* Ensure dark mode styles are applied correctly */
html, body {
  transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
