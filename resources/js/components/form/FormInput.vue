<template>
    <label :for="this.name">
      {{this.name}}: <input :type="this.type" :value="this.value" :name="this.name">
    </label>
</template>

<script>
export default {
  name:'FormInput',
  props: {
    name: {
      type: String,
      require: true,
      },
    type: {
      type: String,
      default: 'text'
    },
    value: String|Number,
    
  },
}
</script>

<style>
  label {
    text-transform: capitalize;
  }
</style>