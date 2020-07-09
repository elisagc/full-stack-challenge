<template>
    <div>
        <Header></Header>
        <template v-if="this.$store.state.isOpen">
            <form class="form">
                <div class="form-group row">
                    <label for="inputTitle">Task Title</label>
                    <input type="text" class="form-control" v-model="title" />
                    <label for="taskDescription">Task Description</label>
                    <textarea
                        class="form-control"
                        v-model="description"
                    ></textarea>

                    <div class="form-box">
                        <div>
                            <select
                                class="custom-select mr-sm-2"
                                v-model="status_id"
                            >
                                <option value="1" selected>Not Started</option>
                                <option value="2">In Progress</option>
                                <option value="3">Finished</option>
                            </select>
                        </div>
                        <div>
                            <button
                                class="btn btn-primary"
                                v-if="editable"
                                v-on:click.prevent="editTask()"
                            >
                                Save changes
                            </button>
                            <button
                                class="btn btn-danger"
                                v-if="editable"
                                v-on:click.prevent="cancelEdition()"
                            >
                                Cancel edition
                            </button>
                            <button
                                class="btn btn-primary"
                                v-if="!editable"
                                v-on:click.prevent="addTask()"
                            >
                                Add new task
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <section class="cont">
            <Container
                @drop="onDropColumn"
                orientation="horizontal"
                behaviour="contain"
            >
                <Draggable
                    v-for="state in status"
                    :key="state.id"
                    v-bind:class="{
                        color1: state.id === 1,
                        color2: state.id === 2,
                        color3: state.id === 3
                    }"
                    class="cont-status"
                >
                    <div md-with-hover>
                        <h1>{{ state.title }}</h1>
                        <Container
                            group-name="1"
                            :get-child-payload="getChildPayload"
                            @drop="onDrop('tasks', $event)"
                        >
                            <Draggable v-for="task in tasks" :key="task.id">
                                <md-card
                                    md-with-hover
                                    v-if="state.id === task.status_id"
                                    class="draggable-item"
                                >
                                    <md-ripple>
                                        <md-card-header>
                                            <div class="md-title">
                                                {{ task.title }}
                                            </div>
                                        </md-card-header>
                                        <md-card-content>
                                            {{ task.description }}
                                        </md-card-content>
                                        <md-card-actions>
                                            <md-button
                                                v-on:click.prevent="
                                                    setDataToEdit(task)
                                                "
                                            >
                                                <md-icon>edit</md-icon>
                                            </md-button>
                                            <md-button
                                                v-on:click.prevent="
                                                    deleteTask(task)
                                                "
                                            >
                                                <md-icon
                                                    >delete_forever</md-icon
                                                >
                                            </md-button>
                                        </md-card-actions>
                                    </md-ripple>
                                </md-card>
                            </Draggable>
                        </Container>
                    </div>
                </Draggable>
            </Container>
        </section>
        <Footer></Footer>
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

.smooth-dnd-container.horizontal {
    display: flex;
    justify-content: space-around;
    width: 100%;
    flex-wrap: wrap;
}
</style>

<script>
import Header from "./Header";
import Footer from "./Footer";
import { Container, Draggable } from "vue-smooth-dnd";
import { applyDrag } from "../../utils/helpers";

export default {
    components: {
        Header,
        Footer,
        Container,
        Draggable
    },
    data: function() {
        return {
            title: "",
            description: "",
            status_id: 1,
            created_at: "",
            updated_at: "",
            id: null,
            editable: false
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
                this.resetData();
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
                    this.resetData();
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        setDataToEdit(task) {
            this.$store.state.isOpen = true;
            this.editable = true;
            this.title = task.title;
            this.description = task.description;
            this.status_id = task.status_id;
            this.updated_at = this.timestamp(new Date());
            this.created_at = task.created_at;
            this.id = task.id;
        },
        editTask() {
            var url = "tasks/" + this.id;
            axios
                .put(url, {
                    title: this.title,
                    description: this.description,
                    status_id: this.status_id,
                    created_at: this.created_at,
                    updated_at: this.updated_at
                })
                .then(response => {
                    this.getTasks();
                    this.resetData();
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        cancelEdition() {
            this.resetData();
        },
        timestamp(date) {
            return date
                .toISOString()
                .slice(0, 19)
                .replace("T", " ");
        },
        resetData() {
            this.editable = false;

            this.title = "";
            this.description = "";
            this.status_id = 1;
            this.created_at = "";
            this.updated_at = "";
        },
        onDropColumn(dropResult) {
            this.status = applyDrag(this.status, dropResult);
        },
        getChildPayload(index) {
            return this.tasks[index];
        },
        onDrop(collection, dropResult) {
            this[collection] = applyDrag(this[collection], dropResult);
        }
    }
};
</script>
