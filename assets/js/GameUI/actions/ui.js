import {
    UI_OPTION_DOWN,
    UI_OPTION_UP,
    UI_GENERAL_BATTLE,
    UI_GENERAL_ITEMS,
    UI_GENERAL_RUN,
    UI_BATTLE_ATTACK,
    UI_BATTLE_DEFENSE
} from '../constants/UIConstants'

export const changeLevel = (level) => {

    if (level < 1) {
        level = 1;
    }

    if (level > 2) {
        level = 2;
    }

    return {
        type: 'CHANGE_LEVEL',
        level
    }
}

export const changeLevel1Action = (action) => ({
    type: 'CHANGE_LEVEL_1_ACTION',
    action
})

export const changeLevel2Action = (action) => ({
    type: 'CHANGE_LEVEL_2_ACTION',
    action
})

export function changeOption({ currentLevel, currentLevel1Action, currentLevel2Action, direction }) {
    return async dispatch => {
        let option =  '';

        if (currentLevel === 1) {

            if (direction === UI_OPTION_UP) {
                if (currentLevel1Action === UI_GENERAL_BATTLE) {
                    option = UI_GENERAL_RUN;
                }

                if (currentLevel1Action === UI_GENERAL_ITEMS) {
                    option = UI_GENERAL_BATTLE;
                }

                if (currentLevel1Action === UI_GENERAL_RUN) {
                    option = UI_GENERAL_ITEMS;
                }
            }

            if (direction === UI_OPTION_DOWN) {

                if (currentLevel1Action === UI_GENERAL_BATTLE) {
                    option = UI_GENERAL_ITEMS;
                }

                if (currentLevel1Action === UI_GENERAL_ITEMS) {
                    option = UI_GENERAL_RUN;
                }

                if (currentLevel1Action === UI_GENERAL_RUN) {
                    option = UI_GENERAL_BATTLE;
                }

            }

            dispatch(changeLevel1Action(option));
        }


        if (currentLevel === 2) {

            if (currentLevel2Action === UI_BATTLE_ATTACK) {
                option = UI_BATTLE_DEFENSE;
            }

            if (currentLevel2Action === UI_BATTLE_DEFENSE) {
                option = UI_BATTLE_ATTACK;
            }

            dispatch(changeLevel2Action(option));
        }
    }
}