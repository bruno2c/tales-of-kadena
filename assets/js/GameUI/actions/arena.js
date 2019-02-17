import axios from 'axios'

export const setStage = (enemies) => ({
    type: 'SET_STAGE',
    enemies
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

        dispatch(setGame(campaign))
        dispatch(setStage(battle.enemies))
    }
}