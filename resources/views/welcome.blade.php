<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- jquery voor Bootstrap -->
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Vue.js script  -->
    <script src="https://unpkg.com/vue/dist/vue.js"></script>


    <style>

        .TaskDone {
            text-decoration: line-through;
        }

        .progressieBalkLeeg {
            background-color: slategrey;
        }

        .progressieBalkVol {
            width: 80%;
            height: 30px;
            background-color: lawngreen;
        }

        .green {
            background-color: springgreen;
        }

    </style>


    <title>Stage-opdracht</title>
</head>
<body>
<div class="container col-sm-8 col-sm-offset-2">
    <div id="app">
        <h1>Taken lijst</h1>

        <!-- nieuwe task form -->

        <div class="panel panel-default">
            <h2 class="text-center">Voeg nieuwe taak toe</h2>
            <form v-on:submit.prevent="AddTask">
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="tasks.name">
                </div>

                <div class="col-sm-4">
                    <input type="submit" value="Voeg toe" class="btn btn-primary btn-block" @click="AddTask">
                </div>
            </form> <!--Hier zorgen voor DB connectie met action=""-->
            &nbsp;
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="text-center">Voortgang</h3>
            </div>


        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="h3 text-center">Wat moet je nog doen? en wat is al klaar?</div>
            </div>
            <div class="panel-body">
                <div class="col-sm-6">
                    <p>Totaal aantal taken: @{{ tasks.length }}</p>
                    {{--<p>Gemarkeerde taken: @{{ checkMarkedTasks }}</p>--}}
                    <p>Verwijderde taken: @{{ this.deletedTasks }}</p>
                </div>
                <div class="col-sm-6">
                    {{--<h3>@{{ this.DisplayedTaskStatView }}</h3>--}}
                    {{--<h3 style="padding: 10px;" class="green">Makkelijk...</h3>--}}
                </div>
            </div>
        </div>


        <table class="table" v-if="DisplayTasks && tasks.length > 0">
            <thead>
            <th>Check!</th>
            <th>Taak</th>
            <th>Verwijder!</th>
            </thead>

            <tbody>
            <tr v-for="task in tasks">
                <td><input type="checkbox" v-model="task.done"></td>
                <td><span :class="{ TaskDone: task.done }">@{{ task.name }}</span></td>
                <td>
                    <button class="btn btn-danger btn-block" v-on:click="deleteTask(task)">Verwijder</button>
                </td>
            </tr>
            </tbody>
        </table>

        <h3 class="text-center" v-else>Alle taken zijn voltooid of er zijn geen taken meer!</h3>
    </div>
</div>
</body>
<script src="js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</html>