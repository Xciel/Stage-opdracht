
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));


const app = new Vue({
    el: '#app',

    data: {
        DisplayTasks: true,
        deletedTasks: 0,
        tasks: [],
        edit: false,
        done: false,



    },
    mounted () {
        this.fetch()
    },




    methods: {

        AddTask: function(e) {
            e.preventDefault();
            axios.post('api/tasks', {
                name: this.tasks.name,
                done: false
            }).then(response=> console.log(response));
            this.tasks.push({
                name: this.tasks.name,
                done: false,
            })
        },

        deleteTask: function (task) {

            axios.delete(`api/tasks/${task.id}`, {
                name:this.tasks.name,
            })
            this.tasks.splice(this.tasks.indexOf(task), 1)
            this.deletedTasks++;
        },
        fetch: function () {

            axios.get('api/tasks/',).then
            (response => {
                console.log(this.tasks)
                this.tasks = (response.data)
            })
        },

        editTask: function (task) {

            axios.put(`api/tasks/${task.id}`,{name:task.name} )
                .then(response=>{

                    this.edit = false
                    this.fetch()
                })


        }









    },
    computed: {
        checkMarkedTasks: function() {
            let count = 0;
            for (let i = 0; i < this.tasks.length, ++i;){
                if (this.tasks[i].done === true) {
                    count++;
                }
            }
            return count;
        },

        ProgressieTasksCompleted: function () {
            if (this.tasks.length == 0) {
                return 0;
            }else {
                return (this.checkMarkedTasks / this.tasks.length) * 100;
            }
        }


    }
});
