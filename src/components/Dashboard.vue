<template>
  <div :class="{ dark: isDarkMode }" class="flex flex-col h-screen">
    <!-- Conditionally Render Header and Footer -->
    <header v-if="!isAuthPage" class="bg-white dark:bg-gray-800 shadow-md p-4 relative">
      <div class="flex items-center justify-between">
        <!-- Logo on the left -->
        <img src="@/assets/logo1.png" alt="Logo" class="h-16" />

        <!-- Dark Mode Toggle and Authentication Button -->
        <div class="flex items-center space-x-4">
          <!-- Light/Dark Mode Toggle -->
          <div>
            <label class="inline-flex items-center cursor-pointer">
              <span class="mr-2 text-gray-900 dark:text-gray-100">{{ isDarkMode ? "Light Mode" : "Dark Mode" }}</span>
              <input
                type="checkbox"
                @change="toggleDarkMode"
                class="hidden"
                :checked="isDarkMode"
              />
              <span class="w-12 h-6 flex items-center bg-gray-300 dark:bg-gray-600 rounded-full p-1">
                <span
                  class="w-4 h-4 bg-white rounded-full shadow transform transition-transform"
                  :class="isDarkMode ? 'translate-x-6' : 'translate-x-0'"
                ></span>
              </span>
            </label>
          </div>

          <!-- Authentication Button -->
          <button
            @click="goToAuth"
            class="px-4 py-2 bg-red-500 text-white rounded-lg"
          >
            Log Out
          </button>
        </div>
      </div>
    </header>

    <!-- Main Layout -->
    <div v-if="!isAuthPage" class="flex flex-1">
      <!-- Left Menu -->
      <div class="w-1/10 bg-gray-200 text-black dark:bg-gray-800 dark:text-white p-4">
        <h2 class="text-xl font-bold mb-4">Left Menu</h2>
        <ul>
          <li class="mb-2">Button 1</li>
          <li class="mb-2">Button 2</li>
          <li class="mb-2">Button 3</li>
        </ul>
      </div>

      <!-- Center (empty for now) -->
      <div class="flex-1 bg-gray-100 dark:bg-gray-900"></div>

      <!-- Right Menu (Chat Area) -->
      <div class="w-1/4 bg-gray-200 text-black dark:bg-gray-800 dark:text-white p-4">
        <ChatComponent />
      </div>
    </div>

    <!-- Footer -->
    <footer v-if="!isAuthPage" class="bg-gray-200 dark:bg-gray-800 p-4 text-center">
      <p class="text-sm text-gray-600 dark:text-gray-400">
         © {{ new Date().getFullYear() }} Extole. All rights reserved.
      </p>
    </footer>
  </div>
</template>

<script>
import ChatComponent from "./ChatComponent.vue";

export default {
  name: "App",
  components: {
    ChatComponent,
  },
  data() {
    return {
      isDarkMode: false,
      isLoggedIn: true,
    };
  },
  computed: {
    isAuthPage() {
      return this.$route.path === "/auth";
    },
  },
  methods: {
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
    },
    async goToAuth() {
      this.isLoggedIn = false; // Log out
      this.$router.push("/auth"); // Navigate to the auth page
    },
  },
};
</script>
