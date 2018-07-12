<template>
    <div>
        <h1>Классическая мафия</h1>
        <div>
            <label for="game_type_settings_players">Выберите количество игроков:</label>
            <select id="game_type_settings_players" class="custom-select">
                <option selected disabled>Нажмите чтобы выбрать количество игроков</option>
                <option value="1">10</option>
            </select>
        </div>
    
        <div class="mt-1">
            <label for="game_type_settings_mafia">Выберите количество мафии:</label>
            <select id="game_type_settings_mafia" class="custom-select">
                <option selected disabled>Нажмите чтобы выбрать количество мафии</option>
                <option value="3">3</option>
            </select>
        </div>
    
        <div class="mt-1">Выберите допустимые игровые роли:</div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Дон</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck2">
            <label class="custom-control-label" for="customCheck2">Шериф</label>
        </div>
    
        <a class="btn btn-primary btn-block mt-1" href="#" role="button">Создать новую игру</a>
    </div>
</template>

<script>
    export default {
        //
    }
</script>
