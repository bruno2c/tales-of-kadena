import {
    UI_LEVEL_1_SLOT_1,
    UI_LEVEL_2_BATTLE,
    UI_LEVEL_3_BATTLE_ATTACK,
    UI_LEVEL_4_SLOT_1,
    UI_SIDE_CHAMPIONS,
    UI_LEVEL_SIDE_CHAMPIONS,
    UI_LEVEL_SIDE_ENEMIES
} from '../constants/UIConstants'

const initialState = {
    currentLevel: 1,
    currentSide: UI_SIDE_CHAMPIONS,
    currentLevel1Action: UI_LEVEL_1_SLOT_1,
    currentLevel2Action: UI_LEVEL_2_BATTLE,
    currentLevel3Action: UI_LEVEL_3_BATTLE_ATTACK,
    currentLevel4Action: UI_LEVEL_4_SLOT_1,
    qtyChampions: 0,
    qtyEnemies: 0
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
        case 'CHANGE_LEVEL_3_ACTION':
            return {
                ...state,
                currentLevel3Action: action.action
            }
        case 'CHANGE_LEVEL_4_ACTION':
            return {
                ...state,
                currentLevel4Action: action.action
            }
        case 'SET_STAGE':
            return {
                ...state,
                qtyChampions: action.battle.qtyChampions,
                qtyEnemies: action.battle.qtyEnemies,
                currentSide: action.turn.side,
                currentLevel: 1,
                currentLevel2Action: UI_LEVEL_2_BATTLE,
                currentLevel3Action: UI_LEVEL_3_BATTLE_ATTACK,
                currentLevel1Action: action.turn.side == UI_SIDE_CHAMPIONS ? action.turn.slot : UI_LEVEL_1_SLOT_1,
                currentLevel4Action: action.turn.side == UI_SIDE_CHAMPIONS ? UI_LEVEL_4_SLOT_1 : action.turn.slot
            }
        default:
            return state
    }
}