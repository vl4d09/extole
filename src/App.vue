<template>
  <div :class="{'dark': isDarkMode}" class="h-screen">
    <div class="flex h-full bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
      <!-- Left Menu -->
      <div class="w-64 bg-gray-800 text-white p-4">
        <h2 class="text-xl font-bold mb-4">Left Menu</h2>
        <ul>
          <li class="mb-2">Menu Item 1</li>
          <li class="mb-2">Menu Item 2</li>
          <li class="mb-2">Menu Item 3</li>
        </ul>
      </div>

      <!-- Chat Area -->
      <div class="flex-1 flex flex-col">
        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-4">
          <div v-for="(message, index) in messages" :key="index" 
               class="mb-4" :class="{'text-right': message.sender === 'user'}">
            <div class="inline-block p-2 rounded-lg" 
                 :class="message.sender === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black dark:bg-gray-700 dark:text-white'">
              {{ message.content }}
            </div>
          </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-gray-300 dark:border-gray-700">
          <div class="flex">
            <input v-model="newMessage" @keyup.enter="sendMessage" 
                   class="flex-1 border rounded-l-lg p-2 bg-white text-black dark:bg-gray-800 dark:text-white" 
                   placeholder="Type a message...">
            <button @click="sendMessage" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-r-lg">
              Send
            </button>
          </div>
        </div>
      </div>

      <!-- Right Menu -->
      <div class="w-64 bg-gray-200 text-black dark:bg-gray-800 dark:text-white p-4">
        <h2 class="text-xl font-bold mb-4">Right Menu</h2>
        <ul>
          <li class="mb-2">Option 1</li>
          <li class="mb-2">Option 2</li>
          <li class="mb-2">Option 3</li>
        </ul>
        <!-- Dark Mode Toggle -->
        <button @click="toggleDarkMode" 
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">
          {{ isDarkMode ? 'Light Mode' : 'Dark Mode' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [
        { sender: 'bot', content: 'Hello! How can I help you today?' },
        { sender: 'user', content: 'I have a question about Vue.js' },
        { sender: 'bot', content: 'Sure, I\'d be happy to help with Vue.js. What would you like to know?' }
      ],
      newMessage: '',
      isDarkMode: true
    }
  },
  methods: {
    sendMessage() {
      if (this.newMessage.trim()) {
        this.messages.push({ sender: 'user', content: this.newMessage });
        this.newMessage = '';
        this.getBotResponse();
      }
    },
    getBotResponse() {
      setTimeout(() => {
        this.messages.push({ sender: 'bot', content: 'This is a simulated response from the bot.' });
      }, 1000);
    },
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
    }
  }
}
</script>

<style scoped>
/* Add any additional styles here */
</style>