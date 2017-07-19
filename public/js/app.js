
new Vue ({


    el: '#app',

    data: {
        DisplayTasks: true,
        deletedTasks: 0,
        tasks: [],



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

            axios.delete('api/tasks/', {
                name:this.tasks.name,
            })
            this.tasks.splice(this.tasks.indexOf(task), 1)
            this.deletedTasks++;
        },
        fetch: function () {

            axios.get('api/tasks/', {
                tasks: this.then(response => {
                    this.tasks.push(response.data)

                })
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