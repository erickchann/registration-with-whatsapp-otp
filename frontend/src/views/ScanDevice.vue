<template>
  <div class="app">
    <div class="container">
      <div class="qr-area">
        <div v-if="!qrUrl" class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <img v-if="qrUrl" :src="qrUrl" />
      </div>

      <button @click="getQr" class="btn btn-info mt-5 mb-2">Refresh Qr</button>
      <button @click="updateStatus" type="button" class="btn btn-primary">Click This Button If Scan Process Is Successfull</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      id: this.$route.params.id,
      qrUrl: '',
    }
  },
  methods: {
    getQr() {
      this.qrUrl = '';

      axios.post(`whatsapp/session/add`, { id: this.id })
        .then(res => {
          this.qrUrl = res.data;
        })
    },
    updateStatus() {
      axios.post(`device/update-status`, { id: this.id })
        .then(res => {
          this.$router.push({ name: 'AddDevice' });
        })
    }
  },
  created() {
    this.getQr();
  },
}
</script>

<style scoped>

.app {
  height: 100vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  display: flex;
  justify-content: center;
  flex-direction: column;
}

.qr-area {
  display: flex;
  justify-content: center;
}

</style>
