<template>
    <div>
        <label for="game_type">Выберите тип игры:</label>
        <select id="game_type" class="custom-select" @change="changeGameTypeView">
            <option selected disabled>Нажмите чтобы выбрать тип игры</option>
            <option value="1">Классическая мафия</option>
        </select>
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
