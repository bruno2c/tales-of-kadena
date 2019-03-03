
const initialState = {
    hash: null,
    enemies: {},
    champions: {}
}

export default function arena(state = initialState, action) {
    switch (action.type) {
        case 'SET_STAGE':
            return {
                ...state,
                hash: action.battle.hash,
                enemies: Object.assign({}, action.battle.enemies),
                champions: Object.assign({}, action.battle.champions),
            }
        default:
            return state
    }
}