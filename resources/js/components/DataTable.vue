<template>
  <div class="table-container">
    <table class="styled-table">
      <thead v-if="headerFields.length > 0">
        <tr class="headers">
          <th v-for="(value, index) in headerFields" :key="`header-${index}`">
              {{ value }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="table-row" v-for="item in this.data" :key="item.id" @click="rowClicked(item.id)">
          <td v-for="(value, index) in item" :key="`cell-${index}`" :class="{hidden: hasToHide(index)}">
            <img v-if="imgExtention !== null && index === 'name'" :src="imgSrcGenerator(value)" :alt="value" width="20" height="20">
            <input v-if="typeof value === 'boolean'" type="checkbox" :name="index" :checked="value" @click="doNothing">
            <span v-else-if="value !== null" >{{ value }}</span>
            <span v-else class="no-data">-</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'DataTable',
  props: {
    headerFields: {
      type: Array,
      require:true
    }, 
    data:{
      type: Array|Object,
      require:true
    }, 
    basePath:{
      type:String,
    }, 
    imgExtention:{
      type:String,
      default: null
    }, 
    showId:{
      type:Boolean,
      default: true
    }
  },
  methods: {
    doNothing: function (e) {
      e.preventDefault();
    },
    rowClicked (index) {
      this.$router.push({path: `/${this.basePath}/${index}`})
    },
    imgSrcGenerator(name) { 
      let imgName = name.replace(" ", "").toLowerCase(); 
      let src = `../../assets/${imgName}.${this.imgExtention}`;
      return src;
    },
    hasToHide(index) {
      return (!this.showId && index === 'id');
    }
  },
}
</script>

<style>
  div.table-container {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
  }
  /* .hidden{
    display: none;
  } */
  .styled-table {
      border-collapse: collapse;
      font-size: 0.9em;
      font-family: sans-serif;
      min-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }
  .styled-table thead tr {
      background-color: #3c4b84;
      color: #ffffff;
      text-align: left;
  }  
  .styled-table th,
  .styled-table td {
      padding: 12px 15px;
      cursor: pointer;
      text-transform: capitalize;
      text-align: left;
  }
  .styled-table td img{
      margin-right: 2%;
  }
  
  .styled-table tbody tr {
      border-bottom: thin solid #dddddd;
  }
  .table-row:hover { 
      box-shadow: inset 0 0 100px 100px rgba(0, 0, 0, 0.3);
  }
  .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
  }
  .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #3c4b84;
  }

</style>