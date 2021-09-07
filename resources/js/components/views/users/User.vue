<template>
<div class="user-container">
    <h1>Modifer :</h1>
    <form action="post" @submit.prevent="putUser">
      <div class="fields-container" >
        <p v-for="(value, index) in this.user" :key="`field-${index}`" >
          <FormulateInput
            :type="getTypeFromIdex(index)"
            :name="index"
            :value="value"
            :label="index"
            error-behavior="live"
          />
          <FormulateInput :field="name">
            <template v-slot="{field}">
              <input v-model="field.value">
            </template>
          </FormulateInput>
        </p>
      </div>
      <button type="submit">Modifier</button>
    </form>
</div>
</template>

<script>
import FormInput from '../../form/FormInput.vue'
import FormTextarea from '../../form/FormTextarea.vue'
export default {
  name: 'User',
    components: {
        FormInput,
        FormTextarea,
    },
    data: function() {
        return {
          user : null,
          url : `/api/user/${this.$route.params.id}`
        }
    },
    methods: {
      loadUser() {
        axios.get(this.url)
        .then(response => {
          this.user = response.data;
          console.log(this.user['firstname']);
        })
        .catch(err => {console.log(err)});
      },
      putUser() {
        console.log(this.user);
        axios.put(this.url, this.user)
        .then()
        // .bind(this)
        .catch(err => {console.log(err)});
      },
      getTypeFromIdex(index) {
        //pb1 = la valeur n'ai pas transmise 
        let type = null;
        switch (index) {
          case 'email':
            type = 'email';
            break;
          case "address":
            type = 'textarea';
            break;
          case index.match(".*_at")?.input: //pb1
            type = 'date';
            break;
          case index.match("is_.*")?.input://pb1
            type = 'checkbox';
            break;
          case index.match("\d")?.input:
            type = 'number';
            break;
        
          default: 
            type = 'text';
            break;
        }
        return type;
      }
      
    },
    mounted() {
      this.loadUser(); 
    },
}
</script>

<style>
div.user-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
form {
  align-self: center;
    background-color: #7b91eb;
    width: 70%;
}
.fields-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items:baseline;
}
</style>