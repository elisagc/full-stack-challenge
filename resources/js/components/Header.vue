<template>
  <nav class="navbar navbar-dark bg-dark">
    <h1 class="navbar-brand">My Tasks</h1>
    <md-button style="outline:none" v-on:click="setIsOpen()">
      <md-icon style="color:white">add_circle_outline</md-icon>
    </md-button>
  </nav>
</template>

<script>
export default {
  methods: {
    setIsOpen: function() {
      this.$store.state.isOpen = !this.$store.state.isOpen;
    }
  }
};
</script>
