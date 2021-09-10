<template>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div v-if="this.user !== null">
        <div>
          <h3>Modifier : {{this.user.id}}</h3>
          <hr />
        </div>
        <div class="alert alert-danger" v-if="error">
          {{ error }}
        </div>
        <form @submit.prevent="onUpdate()">
          <input type="hidden" v-model="user.id"/>
            <div class="form-group">
              <label>LastName: </label>
                <input
                  type="text"
                  class="form-control"
                  v-model.trim="user.lastname"
                />
            </div>
            <div class="form-group">
              <label>FirstName: </label>
              <input
                type="text"
                class="form-control"
                v-model.trim="user.firstname"
              />
            </div>
            <div class="form-group">
              <label>Email: </label>
              <input
                type="text"
                class="form-control"
                v-model.trim="user.email"
              />
              <div class="error" v-if="errors.email">
                {{ errors.email }}
              </div>
            </div>
            <div class="form-group">
              <label>Pays: </label>
              <input
                type="text"
                class="form-control"
                v-model.trim="user.country"
              />
              <div class="error" v-if="errors.country">
                {{ errors.country }}
              </div>
            </div>
            <div class="form-group">
              <label>Addresse: </label>
              <textarea
                rows="3"
                class="form-control"
                v-model.trim="user.address">
              </textarea>
              <div class="error" v-if="errors.country">
                {{ errors.country }}
              </div>
            </div>
            <div class=form-group>
              <label class="row">Droits de l'utilisateur: </label>
              <div class="form-check">
                <label clase="form-check-label col-md-4" for="admin">Administateur</label>
                <input
                  type="checkbox"
                  id="admin"
                  class="form-check-input "
                  v-model.trim="user.is_admin"
                />
              </div>
            </div>
            <button type="submit" class="btn btn-primary">
                Modfier
            </button>
            <hr>
            <h2>Détails</h2>
            <div class="form-group">
              <label>Ajouter le: </label>
              <input
                type="text"
                class="form-control"
                :value="formatDate(user.created_at)"
                disabled
              />
              <div class="error" v-if="errors.country">
                {{ errors.country }}
              </div>
            </div>
            <div class="my-3">

            </div>
            <div class="form-group">
              <label>Mis à jour: </label>
              <input
                type="text"
                class="form-control"
                :value="formatDate(user.updated_at)"
                disabled
              />
              <div class="error" v-if="errors.country">
                {{ errors.country }}
              </div>
            </div>

            <div  v-if="user.email_verified_at !== null" class="form-group">
              <label>Mail validé le: </label>
              <input
                type="text"
                class="form-control"
                :value="formatDate(user.email_verified_at)"
                disabled
              />
              <div class="error" v-if="errors.country">
                {{ errors.country }}
              </div>
            </div>
            <p v-else class="invalid"> Email non validé </p>
          </form>
          <button type="button" class="btn btn-danger" @click="deleteUser">Supprimer l'utilisateur</button>
        </div>
        <Loader v-else msg="ça arrive !.."/>
      </div>
  </div>
</template>

<script>
import Loader from '../../Loader.vue'
import axiosInstance from "../../utils/AxiosTokenInstance";
export default {
  components:{
    Loader
  },
  data: function() {
    return {
      user : null,
      url : `/api/user/${this.$route.params.id}`,
      errors: [],
      error: '',
    }
  },
  methods: {
    async loadUser() {
      axiosInstance.get(this.url)
      .then(response => {
        this.user = response.data;
      })
      .catch(err => {console.log(err)});
    },
    onUpdate() {
      console.log(this.user);
      axios.put(this.url, this.user)
      .then()
      .catch(err => {console.log(err)});
    },
    formatDate(date) {
      date = new Date(date);
      let f = new Intl.DateTimeFormat('fr');
      date = f.format(date);

      return date;
    },
    deleteUser() {
      if (confirm("Etes vous sur de vouloir supprimer l'utilisateur ? ")) {
        axios.delete(this.url)
        .then(response => {
          console.log(response);
        })
        .catch(err => {console.log(err)});
      } else {
        console.log('User not delete !');
      }
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
.fields-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items:baseline;
}
.invalid {
  color: #dc3545;
}
</style>
