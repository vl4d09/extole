<template>
  <div class="flex flex-col h-full max-h-screen">
    <!-- Chat Messages Container -->
    <div ref="chatContainer" class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-900 overflow-y-auto p-4 overflow-x-hidden">
      <!-- Chat Messages -->
      <div v-for="(message, index) in messages" :key="index"
           class="flex items-start mb-4"
           :class="{'justify-end': message.sender === 'user', 'justify-start': message.sender === 'bot'}">
        <div v-if="message.sender === 'bot'" class="w-6 h-6 bg-gray-300 dark:bg-gray-600 rounded-md flex items-center justify-center mr-2">
          <!-- Bot Icon -->
          🤖
        </div>
        <div v-if="message.sender === 'user'" class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center ml-2 mr-1">
          <!-- User Icon -->
          👤
        </div>
        <div class="inline-block p-2 rounded-lg max-w-full break-words"
             :class="message.sender === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black dark:bg-gray-700 dark:text-white'">
          {{ message.content }}
          <div v-if="message.file" class="mt-2 text-sm">
            <span class="font-bold">Attached file:</span> {{ message.file.name }}
          </div>
        </div>
      </div>
    </div>

    <!-- Input Area (aligned properly) -->
    <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700">
      <div class="flex items-center space-x-2">
        <input v-model="newMessage" @keyup.enter="sendMessage"
               class="flex-1 border rounded-lg p-2 bg-white text-black dark:bg-gray-800 dark:text-white"
               placeholder="Type a message...">
        <label for="file-upload" class="cursor-pointer bg-gray-300 hover:bg-gray-400 text-black dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white px-4 py-2 flex items-center justify-center">
          📎
        </label>
        <input id="file-upload" type="file" @change="handleFileUpload" class="hidden" accept=".pdf,.doc,.docx,.txt">
        <button @click="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
          Send
        </button>
      </div>
      <div v-if="selectedFile" class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        Selected file: {{ selectedFile.name }}
      </div>
    </div>
  </div>
</template>

<script>
import { ref, nextTick } from 'vue';

export default {
  data() {
    return {
      messages: [
        { sender: 'bot', content: 'Hello! How can I help you today?' },
        { sender: 'user', content: 'I have a question about Vue.js' },
        { sender: 'bot', content: 'Sure, I\'d be happy to help with Vue.js. What would you like to know?' }
      ],
      newMessage: '',
      selectedFile: null,
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
        this.scrollToBottom();
        this.getBotResponse();
      }
    },
    getBotResponse() {
      setTimeout(() => {
        this.messages.push({
          sender: 'bot',
          content: 'I\'ve received your message. If you uploaded a file, I would process it here.'
        });
        this.scrollToBottom();
      }, 1000);
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.selectedFile = file;
      }
    },
    scrollToBottom() {
      nextTick(() => {
        const chatContainer = this.$refs.chatContainer;
        chatContainer.scrollTop = chatContainer.scrollHeight;
      });
    }
  },
  mounted() {
    this.scrollToBottom();
  }
};
</script>

<style scoped>
html, body {
  height: 100%;
  margin: 0;
  overflow: hidden;
}

#app {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

.flex-1 {
  max-width: 100%;
  overflow-x: hidden; /* Disable horizontal scroll */
}

button, input, label {
  outline: none;
}

.break-words {
  word-break: break-word; /* Ensures long messages break correctly */
}
</style>
