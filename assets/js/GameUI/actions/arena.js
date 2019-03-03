import axios from 'axios'

export const setStage = (battle, turn) => ({
    type: 'SET_STAGE',
    battle,
    turn
})

export const setGame = (game) => ({
    type: 'SET_GAME',
    game
})

export function newCampaign() {
    return axios.get('/campaign/new').then(function (response) {
        return response.data
    })
}

export function attack(battleId, target) {

    let formData = new FormData();
    formData.append('enemySlot', target);

    return axios.post('/battle/'+ battleId +'/attack', formData).then(function (response) {

        if (response.data.code != 200) {
            alert(response.data.message);
        }

        return response.data.battle
    })
    .catch(function (error) {
        console.log(error);
    });
}

export function dispatchAction() {
    return async (dispatch, getState) => {
        let battleHash = getState().arena.hash;
        let battle = await attack(battleHash, getState().ui.currentLevel4Action);
        let turn = await getNextTurn(battle.hash);

        dispatch(setStage(battle, turn))
    }
}

export function getNextTurn(battleId) {
    return axios.get('/battle/' + battleId + '/nextTurn').then(function (response) {

        if (response.data.code != 200) {
            alert(response.data.message);
        }

        return response.data.turn
    })
}

export function newBattle(campaignId) {
    return axios.get('/campaign/' + campaignId + '/battle/new').then(function (response) {

        if (response.data.code != 200) {
            alert(response.data.message);
        }

        return response.data.battle
    })
}

export function fetchEnemies(stage) {
    return axios.get('/stage/' + stage + '/enemies').then(function (response) {
        return response.data
    })
}

export function loadStage() {
    return async dispatch => {
        let campaign = await newCampaign();
        let battle = await newBattle(campaign.id);
        let turn = await getNextTurn(battle.hash);

        dispatch(setGame(campaign))
        dispatch(setStage(battle, turn))
    }
}

export function sendEnemyAct(battleId) {
    return axios.get('/battle/' + battleId + '/enemy/act').then(function (response) {

        if (response.data.code != 200) {
            alert(response.data.message);
        }

        return response.data.battle
    })
}

export function enemyAct() {
    return async (dispatch, getState) => {
        let battleId = getState().arena.hash;
        let battle = await sendEnemyAct(battleId);
        let turn = await getNextTurn(battle.hash);

        dispatch(setStage(battle, turn))
    }
}