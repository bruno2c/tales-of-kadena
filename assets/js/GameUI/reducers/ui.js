import { UI_GENERAL_BATTLE, UI_BATTLE_ATTACK } from '../constants/UIConstants'

const initialState = {
    currentLevel: 1,
    currentLevel1Action: UI_GENERAL_BATTLE,
    currentLevel2Action: UI_BATTLE_ATTACK
}

export default function game(state = initialState, action) {
    switch (action.type) {
        case 'CHANGE_LEVEL':
            return {
                ...state,
                currentLevel: action.level
            }
        case 'CHANGE_LEVEL_1_ACTION':
            return {
                ...state,
                currentLevel1Action: action.action
            }
        case 'CHANGE_LEVEL_2_ACTION':
            return {
                ...state,
                currentLevel2Action: action.action
            }
        default:
            return state
    }
}