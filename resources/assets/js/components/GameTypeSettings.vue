<template>
    <div>
        <div>
            <label for="game_type_settings_players">Выберите количество игроков:</label>
            <select id="game_type_settings_players" name="game_players" class="custom-select">
                <option selected disabled>Нажмите чтобы выбрать количество игроков</option>
                <option value="1">10</option>
            </select>
        </div>
    
        <div class="mt-1">
            <label for="game_type_settings_mafia">Выберите количество мафии:</label>
            <select id="game_type_settings_mafia" name="game_mafia" class="custom-select">
                <option selected disabled>Нажмите чтобы выбрать количество мафии</option>
                <option value="3">3</option>
            </select>
        </div>
    
        <div class="mt-1">Выберите допустимые игровые роли:</div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="don" class="custom-control-input" id="role1">
            <label class="custom-control-label" for="role1">Дон</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="sheriff" class="custom-control-input" id="role2">
            <label class="custom-control-label" for="role2">Шериф</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-1">Создать новую игру</button>
    </div>
</template>

<script>
    export default {
        //
    }
</script>
