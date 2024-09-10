<template>
  <div class="flex flex-col h-full">
    <!-- Chat Messages -->
    <div class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-900">
      <div class="flex-1 overflow-y-auto p-4">
        <div v-for="(message, index) in messages" :key="index"
             class="mb-4" :class="{'text-right': message.sender === 'user'}">
          <div class="inline-block p-2 rounded-lg"
               :class="message.sender === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black dark:bg-gray-700 dark:text-white'">
            {{ message.content }}
            <div v-if="message.file" class="mt-2 text-sm">
              <span class="font-bold">Attached file:</span> {{ message.file.name }}
            </div>
          </div>
        </div>
      </div>

      <!-- Input Area -->
      <div class="p-4 border-t border-gray-300 dark:border-gray-700">
        <div class="flex">
          <input v-model="newMessage" @keyup.enter="sendMessage"
                 class="flex-1 border rounded-l-lg p-2 bg-white text-black dark:bg-gray-800 dark:text-white"
                 placeholder="Type a message...">
          <label for="file-upload" class="cursor-pointer bg-gray-300 hover:bg-gray-400 text-black dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white px-4 py-2 flex items-center justify-center">
            📎
          </label>
          <input id="file-upload" type="file" @change="handleFileUpload" class="hidden" accept=".pdf,.doc,.docx,.txt">
          <button @click="sendMessage"
                  class="bg-blue-500 text-white px-4 py-2 rounded-r-lg">
            Send
          </button>
        </div>
        <div v-if="selectedFile" class="mt-2 text-sm text-gray-600 dark:text-gray-400">
          Selected file: {{ selectedFile.name }}
        </div>
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
      selectedFile: null
    };
  },
  methods: {
    sendMessage() {
      if (this.newMessage.trim() || this.selectedFile) {
        const message = {
          sender: 'user',
          content: this.newMessage.trim(),
          file: this.selectedFile
        };
        this.messages.push(message);
        this.newMessage = '';
        this.selectedFile = null;
        this.getBotResponse();
      }
    },
    getBotResponse() {
      setTimeout(() => {
        this.messages.push({
          sender: 'bot',
          content: 'I\'ve received your message. If you uploaded a file, I would process it here.'
        });
      }, 1000);
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.selectedFile = file;
      }
    }
  }
};
</script>

<style scoped>
/* Additional custom styles, if needed */
</style>
