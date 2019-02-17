
const initialState = {
    enemies: {}
}

export default function arena(state = initialState, action) {
    switch (action.type) {
        case 'SET_STAGE':
            return {
                enemies: Object.assign({}, action.enemies)
            }
        default:
            return state
    }
}