<script >
export default {
  data() {
    return {
      currentTime: ''
    }
  },
  created() {
    this.updateCurrentTime();
    setInterval(this.updateCurrentTime, 1000);
  },
  methods: {
    updateCurrentTime() {
      const now = new Date();
      const hours = now.getHours();
      const minutes = now.getMinutes();
      const formattedHours = hours < 10 ? `0${hours}` : hours;
      const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
      this.currentTime = `${formattedHours}:${formattedMinutes}`;
    }
  }
}
</script>

<template>
  <footer>
        <div class="container-fluid d-flex justify-content-between py-3">
            <div>
                Make by Stefano with Love
            </div>
            <div>
                {{ currentTime }}
            </div>
        </div>
  </footer>
</template>

<style lang="scss">
footer {
    background-color: #F1F4F4;
}
</style>
