<template>
  <div
    id="app"
    :class="{ dark: isDarkMode }"
    class="flex justify-center items-center h-screen bg-gray-100 dark:bg-gray-900"
  >
    <div
      class="relative flex flex-col max-w-4xl w-full h-full bg-white dark:bg-gray-800 shadow-lg rounded-lg"
    >
      <header
        class="p-4 bg-blue-600 dark:bg-gray-800 text-white rounded-t-lg flex items-center justify-between"
      >
        <!-- Centered Logo -->
        <div class="flex-grow flex">
          <img src="@/assets/logo.png" alt="Logo" class="h-12" />
        </div>
        <!-- Dark Mode Toggle Button -->
        <button
          @click="toggleDarkMode"
          class="px-4 py-2 bg-gray-700 dark:bg-gray-500 text-white rounded-lg focus:outline-none"
        >
          {{ isDarkMode ? "Light Mode" : "Dark Mode" }}
        </button>
      </header>

      <main class="flex-grow overflow-y-auto dark:bg-gray-900 dark:text-white">
        <ChatComponent />
      </main>

      <footer
        class="p-4 bg-gray-800 dark:bg-gray-700 text-white text-center rounded-b-lg"
      >
        © 2024 Extole. All rights reserved.
      </footer>
    </div>
  </div>
</template>

<script>
import ChatComponent from "./components/ChatComponent.vue";

export default {
  components: {
    ChatComponent,
  },
  data() {
    return {
      isDarkMode: true, // Set dark mode as the default
    };
  },
  created() {
    this.applyDarkMode();
  },
  methods: {
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
      this.applyDarkMode();
    },
    applyDarkMode() {
      document.documentElement.classList.toggle("dark", this.isDarkMode);
    },
  },
};
</script>

<style scoped>
/* Additional styles can be added here */
</style>
