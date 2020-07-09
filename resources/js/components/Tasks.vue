<template>
  <div>
    <Header></Header>
    <form class="form" action="#" method="get" @submit="addTask" v-if="this.$store.state.isOpen">
      <div class="form-group row">
        <label for="inputTitle">Task Title</label>
        <input type="text" class="form-control" v-model="title" />

        <label for="taskDescription">Task Description</label>
        <textarea class="form-control" v-model="description"></textarea>

        <div class="form-box">
          <div>
            <select class="custom-select mr-sm-2" v-model="status_id">
              <option value="1" selected>Not Started</option>
              <option value="2">In Progress</option>
              <option value="3">Finished</option>
            </select>
          </div>
          <div>
            <button class="btn btn-primary">Add new task</button>
          </div>
        </div>
      </div>
    </form>

    <div class="cont">
      <div class="cont-status" md-with-hover v-for="(state, index) in status" :key="index">
        <h1>{{ state.title }}</h1>
        <div class="cont-tasks" v-for="(task, index) in tasks" :key="index">
          <md-card md-with-hover v-if="state.id === task.status_id">
            <md-ripple>
              <md-card-header>
                <div class="md-title">{{ task.title }}</div>
              </md-card-header>
              <md-card-content>
                {{
                task.description
                }}
              </md-card-content>
              <md-card-actions>
                <md-button>
                  <md-icon>edit</md-icon>
                </md-button>
                <md-button v-on:click.prevent="deleteTask(task)">
                  <md-icon>delete_forever</md-icon>
                </md-button>
              </md-card-actions>
            </md-ripple>
          </md-card>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.md-card {
  width: 350px;
  margin: 10px;
  border-radius: 5px;
}

.md-button {
  outline: none;
}
</style>

<script>
import Header from "./Header";

export default {
  components: {
    Header
  },
  data: function() {
    return {
      title: "",
      description: "",
      status_id: 1,
      created_at: "",
      updated_at: ""
    };
  },
  props: {
    tasks: {
      required: true,
      type: Array
    },
    status: {
      required: true,
      type: Array
    }
  },
  methods: {
    getTasks: function() {
      var url = "api/tasks";
      axios.get(url).then(response => {
        this.tasks = response.data;
      });
    },
    deleteTask: function(task) {
      var url = "tasks/" + task.id;
      axios.delete(url).then(response => {
        this.getTasks();
      });
    },
    addTask: function(e) {
      this.created_at = this.timestamp(new Date());
      this.updated_at = this.timestamp(new Date());
      var url = "tasks";
      axios
        .post(url, {
          title: this.title,
          description: this.description,
          status_id: this.status_id,
          created_at: this.created_at,
          updated_at: this.updated_at
        })
        .then(response => {
          this.getTasks();
          this.title = "";
          this.description = "";
          this.status_id = 1;
          this.created_at = "";
          this.updated_at = "";
        })
        .catch(error => {
          console.log(error.response.data);
        });

      e.preventDefault();
    },
    timestamp(date) {
      return date
        .toISOString()
        .slice(0, 19)
        .replace("T", " ");
    }
  }
};
</script>
