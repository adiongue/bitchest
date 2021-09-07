<template>
  <div>
      <label :for="this.name">{{this.name}}:</label>
      <textarea :name="this.name" :rows="5" :cols="33" v-model="value"></textarea>
  </div>
</template>
<script>
export default {
  name:'FormTextarea',
  props: {
    name: {
      type: String,
      require: true,
      },
    rows: {
      type: Number,
      default: 5
    },
    cols: {
      type: Number,
      default: 33
    },
    value: String,
  },
}
</script>