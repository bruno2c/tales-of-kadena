import axios from 'axios'

export const setStage = (enemies) => ({
    type: 'SET_STAGE',
    enemies
})

export function fetchEnemies(stage) {
    return axios.get('/stage/' + stage + '/enemies').then(function (response) {
        return response.data
    })
}

export function loadStage() {
    return async dispatch => {
        let enemies = await fetchEnemies(1);

        dispatch(setStage(enemies))
    }
}