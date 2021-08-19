<template>
  <div class="app-container">
    <Sidebar siteName="Bitchest" siteLogo="../../assets/bitchest_logo.png" />
    <ContentContainer/>
  </div>
</template>

<script>
import Sidebar from './Sidebar'
import ContentContainer from './ContentContainer'
export default {
  name: 'Container',
  components: {
    Sidebar,
    ContentContainer,
  }
}
</script>
<style>
.app-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
</style>