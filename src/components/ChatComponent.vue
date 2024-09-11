<template>
  <div class="flex flex-col h-full bg-gray-100 dark:bg-gray-900 max-w-4xl mx-auto shadow-lg rounded-lg">
    <!-- Chat Window -->
    <div ref="chatWindow" class="flex-grow p-6 overflow-y-auto space-y-4 text-black dark:text-white">
      <div v-for="(message, index) in messages" :key="index" :class="message.isUser ? 'text-right' : 'text-left'">
        <div
          :class="[
            'inline-block px-4 py-2 rounded-lg',
            message.isUser ? 'bg-blue-500 dark:bg-blue-600 text-white' : 'bg-gray-300 dark:bg-gray-700 dark:text-gray-300',
          ]"
        >
          <p v-if="message.text">{{ message.text }}</p>
          
          <div v-if="isImageFile(message.fileName)" class="mt-2">
            <img :src="message.file" alt="Uploaded Image" class="max-w-full h-auto rounded-lg shadow-md"/>
          </div>

          <div v-if="isPdfFile(message.fileName)" class="mt-2">
            <embed :src="message.file" width="100%" height="400px" type="application/pdf" />
          </div>
          
          <div v-if="!isImageFile(message.fileName) && !isPdfFile(message.fileName)" class="mt-2">
            <a :href="message.file" class="text-blue-700 dark:text-blue-400 underline" download>{{ message.fileName }}</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Input Area -->
    <div class="flex p-4 bg-white dark:bg-gray-800 border-t dark:border-gray-700 items-center">
      <input
        v-model="newMessage"
        @keyup.enter="sendMessage"
        type="text"
        placeholder="Type a message..."
        class="flex-grow px-4 py-2 mr-2 border rounded-lg text-black dark:text-white bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-gray-400"
      />
      <input
        ref="fileInput"
        type="file"
        @change="handleFileUpload"
        class="hidden"
      />
      <button
        @click="sendMessage"
        class="px-4 py-2 mr-2 text-white bg-blue-500 dark:bg-blue-600 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
      >
        Send
      </button>
      <button
        @click="$refs.fileInput.click()"
        class="px-4 py-2 text-white bg-gray-500 dark:bg-gray-600 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400"
      >
        Upload File
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [
        { text: 'Hello! How can I help you today?', isUser: false },
      ],
      newMessage: '',
      file: null,
    };
  },
  mounted() {
    this.scrollToBottom();
  },
  updated() {
    this.scrollToBottom();
  },
  methods: {
    sendMessage() {
      if (this.newMessage.trim()) {
        this.messages.push({ text: this.newMessage, isUser: true });
        this.newMessage = '';

        // Simulate a hardcoded response
        setTimeout(() => {
          this.messages.push({ text: 'This is a hardcoded response.', isUser: false });
        }, 1000);
      }

      if (this.file) {
        const fileName = this.file.name;
        const fileUrl = URL.createObjectURL(this.file);
        this.messages.push({
          text: '',
          isUser: true,
          file: fileUrl,
          fileName: fileName,
        });
        this.file = null;
      }
    },
    handleFileUpload(event) {
      this.file = event.target.files[0];
    },
    isPdfFile(fileName) {
      return fileName?.toLowerCase().endsWith('.pdf');
    },
    isImageFile(fileName) {
      return /\.(jpg|jpeg|png|gif)$/.test(fileName?.toLowerCase());
    },
    scrollToBottom() {
      this.$nextTick(() => {
        const chatWindow = this.$refs.chatWindow;
        chatWindow.scrollTop = chatWindow.scrollHeight;
      });
    }
  },
};
</script>

<style scoped>
/* Keep the styles as minimal as needed */
</style>
