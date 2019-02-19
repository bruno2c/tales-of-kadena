
const initialState = {
    generalAction: 'battle',
    lockGeneralAction: false,
    battleAction: 'attack',
}

export default function game(state = initialState, action) {
    switch (action.type) {
        case 'SET_GENERAL_OPTION':
            return {
                ...state,
                generalAction: action.option
            }
        case 'LOCK_GENERAL_OPTION':
            return {
                ...state,
                lockGeneralAction: true
            }
        case 'UNLOCK_GENERAL_OPTION':
            return {
                ...state,
                lockGeneralAction: false
            }
        case 'SET_BATTLE_OPTION':
            return {
                ...state,
                battleAction: action.option
            }
        default:
            return state
    }
}