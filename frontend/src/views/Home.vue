<template>
  <div class="home">
    <router-link to="/add-device" class="btn btn-primary mb-2">Add Device</router-link>
    <router-link to="/register" class="btn btn-primary mb-2">Register</router-link>
  </div>
</template>

<style scoped>

.home {
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.home .btn {
  width: 40%;
}

</style>