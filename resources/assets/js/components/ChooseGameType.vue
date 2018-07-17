<template>
    <div>
        <form method="post" action="/game/create">
            <div class="form-group">
                <label for="game_name">Введите название игры:</label>
                <input type="text" id="game_name" name="game_name" class="form-control"
                       placeholder="Введите название для новой игры" minlength="3" maxlength="30">
            </div>
            <div>
                <label for="game_type">Выберите тип игры:</label>
                <select id="game_type" name="game_type" class="custom-select" @change="changeGameTypeView">
                    <option selected disabled>Нажмите чтобы выбрать тип игры</option>
                    <option value="1">Классическая мафия</option>
                </select>
            </div>
        
            <router-view></router-view>
        </form>
    </div>
</template>

<script>
    export default {
        methods: {
            changeGameTypeView: function (event) {
                this.$router.push('/game/start/' + event.target.value);
            }
        }
    }
</script>
