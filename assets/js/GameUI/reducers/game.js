
const initialState = {
    id: null,
    stage: null
}

export default function game(state = initialState, action) {
    switch (action.type) {
        case 'SET_GAME':
            return {
                ...state,
                id: action.game.id,
                stage: action.game.stage
            }
        default:
            return state
    }
}